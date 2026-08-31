<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\CartService;
use App\Services\CreditCardService;
use App\Services\BilletService;
use App\Services\OrderStatusService;
use App\Services\CouponService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDone;

class OrderService
{
    protected $orderRepository;
    protected $cartService;
    protected $orderStatusService;
    protected $couponService;

    //Payment Methods
    protected $creditCard = 1;
    protected $eft = 2;
    protected $boleto = 3;
    protected $pix = 4;

    //Order Status
    protected $pendingPayment = 1;
    protected $canceled = 4;
    protected $paid = 5;
    protected $refunded = 6;
    protected $expired = 11;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CartService $cartService,
        OrderStatusService $orderStatusService,
        CouponService $couponService,
    )
    {
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
        $this->orderStatusService = $orderStatusService;
        $this->couponService = $couponService;
    }

    /**
     * Select all Orders
     * @return array
    */
    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    /**
     * Select all Orders By Contact ID
     * @return array
    */
    public function getAllOrdersByContactId($contactId, $queryParams = null)
    {
        return $this->orderRepository->getAllOrdersByContactId($contactId, $queryParams);
    }

     /**
     * Get Order by  ID
     * @param int $id
     * @return object
    */
    public function getOrderById(int $id)
    {
        return $this->orderRepository->getOrderById($id);
    }

     /**
     * Get Order by ID and ContactId
     * @param int $id
     * @return object
    */
    public function getOrderByIdAndContactId(int $id, int $contactId)
    {
        return $this->orderRepository->getOrderByIdAndContactId($id, $contactId);
    }

    /**
     * Get total sales amount
     * @return float
    */
    public function getTotalSalesAmount()
    {
        return $this->orderRepository->getTotalSalesAmount();
    }

    /**
     * Create a new order
     * @param array $data
     * @return object
    */
    public function makeOrder(array $data)
    {
        $carts = $this->cartService->getProductsFromCart();

        if ($carts > 0) {
            $collection = collect($carts);
            $data['value'] = $collection->sum(function ($item) {
                return $item['quantity'] * $item['price'];
            });
        }

        $data["payment_method"] = $this->getPaymentMethod($data["payment_method_id"]);


        if ($data["payment_method_id"] == $this->creditCard) {
            $payerName = $data['creditCard_holder_name'];
            $payerEmail = $data['creditCard_holder_email'];
            $completePhone = preg_replace('/[^0-9]/','',$data['creditCard_holder_area_code'] . $data['creditCard_holder_phone']);
            $payerCpf = preg_replace('/[^0-9]/','', $data['creditCard_holder_cpf']);
            $payerBirthDate = $data['creditCard_holder_birth_date'];
            $creditCardToken = $data['creditCard_token'];

        } else {
            $payerName = auth()->user()->name;
            $payerEmail = auth()->user()->email;
            $completePhone = preg_replace('/[^0-9]/','',auth()->user()->mobile);
            $payerCpf = preg_replace('/[^0-9]/','', auth()->user()->cpf);
            $payerBirthDate = auth()->user()->date_birth;
        }

        $discountAmount = 0;
        if (!empty(session('coupon'))) {
            $discountAmount = session("coupon.discount_amount");
        }

        $data["contact_id"] = auth()->id();
        $data["order_status_id"] = $this->pendingPayment;
        $data['value_discount'] = $discountAmount;
        $data['value_total'] = ($data['value'] + $data['value_shipping']) - $data['value_discount'];
        $data["installments"] = isset($data["installment_quantity"]) ? $data["installment_quantity"] : 1;

        $order = DB::transaction(function() use ($data, $carts) {

            $order = $this->orderRepository->createOrder($data);

            foreach ($carts as $productId => $item) {
                $data = [
                    "product_id" => $productId,
                    "value_unit" => $item["price"],
                    "value_total" => $item["quantity"] * $item["price"],
                    "quantity" => $item["quantity"],
                    "gift" => $item["gift"]
                ];

                $orderItem = $order->orderItems()->create($data);

                $orderItem->product->decrement('current_stock', $item["quantity"]);

            }

            return $order;
        });

        if (!empty(session('coupon'))) {
            $couponHistory = $this->couponService->addLog($order->id);
        }

        $i = 0;
        foreach ($carts as $productId => $item) {
            $itemsToPayment[$i]['name']  = $item['name'];
            $itemsToPayment[$i]['amount']  = $item['quantity'];
            $itemsToPayment[$i]['value']   = $item['price'];
            $i++;
        }

        if  ($order->payment_method_id == $this->creditCard || $order->payment_method_id == $this->boleto) {
            $shippings = [
                0 => [
                    "name" => $order->type_shipping,
                    "value" => number_format($order->value_shipping,2),
                ],
            ];

            $discount = [
                "type" => 'currency',
                "value" => number_format($order->value_discount,2),
            ];

            $contactAddress = $order->address()->first();

            $billingAddress = [
                'street' => $contactAddress->address,
                'number' => $contactAddress->number,
                'neighborhood'=> $contactAddress->neighborhood,
                'zipcode' => $contactAddress->cep,
                'city' => $contactAddress->city->name,
                'complement'=> $contactAddress->complement,
                'state' => $contactAddress->state->uf,
            ];

            $data = [
                'cpf' => $payerCpf,
                'name' => $payerName,
                'email' => $payerEmail,
                'phone' => $completePhone,
                'items' => $itemsToPayment,
                'shippings' => $shippings,
                'discount' => $discount,
                'order_id' => $order->id,
                'installments' => $order->installments,
                'billing_address' => $billingAddress,
            ];
        }

        if ($order->payment_method_id == $this->creditCard) {

            $data['payment_token'] = $creditCardToken;

            $statusPayment = (new CreditCardService)->createCharge($data);
        }

        if ($order->payment_method_id == $this->boleto) {

            $statusPayment = (new BilletService)->createCharge($data);

            $data['gateway'] = 'gerencianet';
            $data['contact_id']      = $order->contact_id;
            $data['transaction_id']  = $statusPayment['charge_id'];
            $data['amount']          = $order->value_total;
            $data['shipping_amount'] = $order->value_shipping;
            $data['extras']          = $order->value_discount;
            $data['payment_method']  = 'Boleto';
            $data['status']          = $statusPayment['status'];
            $data['payment_link']    = $statusPayment['payment_link'];
            $order->transaction()->create($data);
        }

        if ($order->payment_method_id == $this->pix) {

            $data = [
                'cpf' => $payerCpf,
                'name' => $payerName,
                'amount' => $order->value_total,
                'order_id' => $order->id,
            ];

            $statusPayment = (new PixService)->createCharge($data);

            $data['txid']  = $statusPayment['txid'];
            $data['qrcode_image'] = $statusPayment['qrCodeImage'];
            $data['qrcode'] = $statusPayment['pixCopyPaste'];
            $data['due_date'] = $statusPayment['dueDate'];
            $order->orderPix()->create($data);
        }

        $orderStatus = $this->orderStatusService->setOrderStatusId($statusPayment['status']);

        $order->order_status_id = $orderStatus['order_status_id'];
        $order->save();

        if  (!empty($orderStatus) && $orderStatus['order_status_id'] != $this->pendingPayment) {
            $orderStatus['comment'] =  "<p>{$orderStatus['title']}</<p><p>{$orderStatus['msg']}</p>";
            $orderStatus['client_notified'] = 'S';
            $orderStatus['client_comment'] = "S";
            $order->orderLogs()->create($orderStatus);
        }

        Mail::to($order->customer->email)
            ->bcc(env("SITE_EMAIL_DEV"))
            ->send(new OrderDone($order));

        session()->forget('redirect');
        session()->forget('cart');
        session()->forget('cep');
        session()->forget('coupon');

        return $order;
    }


    /**
     * Update tracking code shipping
     * @return float
    */
    public function updateTrackingCodeOrder(int $id, array $data)
    {
        $order = $this->orderRepository->getOrderById($id);

        if (!$order) {
            return response()->json(['message' => 'Order Not Found'], 404);
        }

        $this->orderRepository->updateOrder($order, $data);
        return response()->json(['message' => 'Module Updated'], 200);
    }

     /**
     * Delete a order
     * @param int $id
     * @return json response
    */
    public function destroyOrder(int $id)
    {
        $order = $this->orderRepository->getOrderById($id);

        if (!$order) {
            return response()->json(['message' => 'Order Not Found'], 404);
        }

        $order->orderItems()->delete();
        $order->orderLogs()->delete();

        $this->orderRepository->destroyOrder($order);

        return response()->json(['message' => 'Order Deleted'], 200);
    }

    private function getPaymentMethod($id)
    {
        switch ($id) {
            case $this->creditCard:
                return 'creditCard';
            case $this->boleto:
                return 'boleto';
            case $this->pix:
                return 'pix';
        }
    }

}
