<?php

namespace App\Services;

use App\Repositories\Contracts\OrderStatusRepositoryInterface;

class OrderStatusService
{
    protected $orderStatusRepository;

    protected $pendingPayment = 1;
    protected $canceled = 4;
    protected $paid = 5;
    protected $refunded = 6;
    protected $expired = 11;

    public function __construct(OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * Select all orderstatusds
     * @return array
    */
    public function getAllOrderStatuses()
    {
        return $this->orderStatusRepository->getAllOrderStatuses();
    }

     /**
     * Create a new orderstatusd
     * @param array $data
     * @return object
    */
    public function makeOrderStatus(array $data)
    {
        $orderStatus = $this->orderStatusRepository->createOrderStatus($data);

        return $orderStatus;
    }

    /**
     * Get OrderStatusd by  ID
     * @param int $id
     * @return object
    */
    public function getOrderStatusById(int $id)
    {
        return $this->orderStatusRepository->getOrderStatusById($id);
    }

    /**
     * Update a orderstatusd
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateOrderStatus(int $id, array $data)
    {

        $orderStatus = $this->orderStatusRepository->getOrderStatusById($id);

        if (!$orderStatus) {
            return response()->json(['message' => 'Order Status Not Found'], 404);
        }

        $this->orderStatusRepository->updateOrderStatus($orderStatus, $data);
        return response()->json(['message' => 'Payment Method Updated'], 200);
    }

    /**
     * Delete a orderstatusd
     * @param int $id
     * @return json response
    */
    public function destroyOrderStatus(int $id)
    {
        $orderStatus = $this->orderStatusRepository->getOrderStatusById($id);

        if (!$orderStatus) {
            return response()->json(['message' => 'Order Status Not Found'], 404);
        }

        $this->orderStatusRepository->destroyOrderStatus($orderStatus);

        return response()->json(['message' => 'Order Status Deleted'], 200);
    }

    public function getAllOrderStatusesToSelect()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione o status";

        return $this->getAllOrderStatuses()
            ->sortBy('name')
            ->prepend($select);
    }

    public function setOrderStatusId(string $status)
    {
        $orderLog = [];
        switch($status) {
            case 'new':
            case 'waiting':
            case 'approved':
                $orderLog['order_status_id'] = $this->pendingPayment;
                break;
            case 'paid':
            case 'settled':
                $orderLog['title'] = "Pagamento Realizado com Sucesso";
                $orderLog['msg'] = "Seu pedido será preparado e logo sairá para entrega";
                $orderLog['order_status_id'] = $this->paid;
                break;
            case 'canceled':
            case 'unpaid':
                $orderLog['title'] = "Pagamento não realizado";
                $orderLog['msg'] = "Seu pedido foi cancelado";
                $orderLog['order_status_id'] = $this->canceled;
                break;
            case 'refunded':
                $orderLog['title'] = "Pagamento devolvido";
                $orderLog['msg'] = "O pagamento do seu pedido foi devolvido";
                $orderLog['order_status_id'] = $this->refunded;
                break;
            case 'expired':
                $orderLog['title'] = "Tempo para pagamento expirado";
                $orderLog['msg'] = "Seu pedido foi cancelado por falta de pagamaneto";
                $orderLog['order_status_id'] = $this->expired;
                break;
            default:
                throw new \Exception('Status desconhecido');
        }

        return $orderLog;

    }
}
