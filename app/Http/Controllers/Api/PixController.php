<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderLogService;
use App\Services\PixService;

class PixController extends Controller
{
    protected $pending_payment = 1;
    protected $canceled = 4;
    protected $paid = 5;
    protected $refunded = 6;
    protected $expired = 11;
    protected $orderLogService;

    public function __construct(OrderLogService $orderLogService)
    {
        $this->orderLogService = $orderLogService;
    }

    public function confirmPayment(Order $order)
    {
        $txid = $order->orderPix->txid;

        $response = (new PixService)->consultCharge($txid);

        $status = 0;
        switch ($response["status"]) {
            case 'not_found':
                $type = "error";
                $title = "Erro";
                $msg = "Pix não encontrado";
                break;
            case 'pending_payment':
                $type = "error";
                $title = "Atenção";
                $msg = "Não foi possível confirmar o pagamento";
                break;
            case 'expired':
                $type = "error";
                $title = "Atenção";
                $msg = "O tempo para pagamento do pix excedeu 30 minutos";
                $status = $this->expired;
                break;
            case 'paid':
                $type = "success";
                $title = "Pagamento Realizado com Sucesso";
                $msg = "Seu pedido será preparado e logo sairá para entrega";
                $status = $this->paid;

                $data["order_status_id"] = $status;
                $data["comment"] = "<p>{$title}</<p><p>{$msg}</p>";
                $data["client_notified"] = 'S';
                $data["client_comment"] = "S";
                $data["email"] = $order->customer->email;

                $this->orderLogService->makeOrderLog($order->id, $data);

                break;
            default:
                $type = "error";
                $title = "Atenção";
                $msg = "Status Desconhecido";
                break;
        }

        if (!empty($status)) {
            $order->order_status_id = $status;
            $order->save();
        }

        return  [
            "type" => $type,
            "title" => $title,
            "text" => $msg
        ];
    }
}
