<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Efi\Exception\EfiException;
use Efi\EfiPay;
use App\Models\Order;
use App\Models\OrderPix;
use App\Mail\OrderStatusChanged;

class PixService
{
    protected $options = [];
    protected $status = [];
    protected $order = [];
    protected $orderPix;
    protected $PAID = 5;
    protected $REFUNDED = 8;
    protected $PENDINGREFUND = 14;

    public function __construct()
    {
        $this->options = [
            "client_id" => env("PIX_PSP_CLIENT_ID"),
            "client_secret" =>  env("PIX_PSP_CLIENT_SECRET"),
            "pix_cert" => Storage::path('public/certificates/'. env("PIX_PSP_CERT")),
            "sandbox" => env("PIX_PSP_SANDBOX"),
            "debug" => false,
            "timeout" => 0
        ];

        $this->status = [
            'not_found' => ['status' => 'not_found','type' => 'error'],
            'pending'   => ['status' => 'pending_payment', 'type' => 'warning'],
            'expired'   => ['status' => 'expired','type' => 'error'],
            'paid'      => ['status' => 'paid','type' => 'success'],
        ];

        $this->orderPix = new OrderPix();
        $this->order    = new Order();
    }

    public function createCharge($infoPix)
    {
        $response = [];

        $body = [
            'calendario' => [
                'expiracao' => intval(env('PIX_EXPIRATION'))
            ],
            'devedor' => [
                'cpf' => preg_replace("/[^0-9]/","", $infoPix['devedor']['cpf']),
                'nome' => $infoPix['devedor']['name'],
            ],
            'valor' => [
                'original' => strval(number_format($infoPix['valor']['original'],2,'.',',')),
            ],
            'chave' => env("PIX_PSP_PIXKEY"),
            'solicitacaoPagador' => "Pagamento do pedido {$infoPix['order_id']}",
        ];

        try {
            $api = new EfiPay($this->options);
            $pix = $api->pixCreateImmediateCharge($params = [], $body);

            if ($pix["txid"]) {
                $params["id"] = $pix['loc']['id'];

                try {
                    $qrcode = $api->pixGenerateQRCode($params);

                    $timeService = new TimeService();
                    $created = $timeService->setDateToCorrectTimezone($pix['calendario']['criacao']);
                    $dueDate = $timeService->addSecondsToDate($created, $pix['calendario']['expiracao']);

                    $response = [
                        'txid' => $pix["txid"],
                        'pixCopyPaste' => $qrcode['qrcode'],
                        'qrCodeImage' => $qrcode['imagemQrcode'],
                        'dueDate' => $dueDate
                    ];

                    return $response;
                } catch (EfiException $e) {
                    return $this->setExcectionMessageError($e->code, $e->error, $e->errorDescription);
                }
            }
        } catch (\Exception $e) {
            return $this->setExcectionMessageError($e->getCode(), $e->getMessage());
        }
    }

    public function consultCharge($txid)
    {
        $params['txid'] = $txid;

        try {
            $api = new EfiPay($this->options);
            $pix = $api->pixDetailCharge($params);
            $timeService = new TimeService();

            $now = date_format($timeService->getNow(), "Y-m-d H:i:s");
            $created = $timeService->setDateToCorrectTimezone($pix['calendario']['criacao']);
            $dueDate = $timeService->addSecondsToDate($created, $pix['calendario']['expiracao']);

            // Pago
            if ($pix["status"] === "CONCLUIDA") {
                return $this->status["paid"];
            }

            // Expirado
            if ($dueDate < $now) {
                return $this->status["expired"];
            }

            // Não Pago
            if ($pix["status"] === "ATIVA") {
                return $this->status["pending"];
            }

        } catch (EfiException $e) {
            //return $this->setExcectionMessageError($e->code, $e->error, $e->errorDescription);
            return $this->status["not_found"];
        } catch (Exception $e) {
            //return $this->setExcectionMessageError($e->getCode(), $e->getMessage());
            return $this->status["not_found"];
        }
    }

    public function listCharges($params)
    {
        try {
            $api = new EfiPay($this->options);
            $reponse = $api->pixListCharges($params);
            return $reponse;
        } catch (EfiException $e) {
            return $this->setExcectionMessageError($e->code, $e->error, $e->errorDescription);
        } catch (Exception $e) {
            return $this->setExcectionMessageError($e->getCode(), $e->getMessage());
        }
    }

    public function configWebhook()
    {
        // To DO: Validar Funcionamento
        $this->options["headers"] = [
            "x-skip-mtls-checking" => "true",
        ];

        $params = [
            "chave" => env("PIX_PSP_PIXKEY")
        ];

        $body = [
            "webhookUrl" => "https://mayacosmeticos.com.br/backend/api/pix/webhook"
        ];

        try {
            $api = new EfiPay($this->options);
            $response = $api->pixConfigWebhook($params, $body);

            print_r("<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>");

        } catch (EfiException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function develution($e2eId, $id, $value)
    {
        $params = [
            'e2eId' => $e2eId,
            'id' => $id,
        ];

        $body = [
            'valor' => strval(number_format($value, 2, '.',',')),
        ];

        try {
            $api = new EfiPay($this->options);
        $response = $api->pixDevolution($params, $body);

        return $response;
        } catch (EfiException $e) {
            return $this->setExcectionMessageError($e->code, $e->error, $e->errorDescription);
        } catch (Exception $e) {
            return $this->setExcectionMessageError($e->getCode(), $e->getMessage());
        }        
    }

    public function saveOrderPix($pix)
    {
        $order = $this->order->where("id", function($query) use($pix){
            $query->select("order_id")
                ->from("order_pixes")
                ->where("txid",$pix["txid"]);
        })
        ->with(['orderPix','contact', 'orderStatus'])
        ->first();

        if ($order) {

            $order->order_status_id = $this->setStatus($pix);
            $order->save();

            if ($pix["endToEndId"]) {
                $order->orderPix->e2eid = $pix["endToEndId"];
                $order->orderPix->save();          
            }

           $this->sendEmailStatus($order);
        }
    }

    private function setStatus($pix)
    {
        if (!isset($pix["devolucoes"])) {
            return $this->PAID;
        } else {
            if ($pix["devolucoes"][0]["status"] == "EM_PROCESSAMENTO") {
                return $this->PENDINGREFUND;
            } else if($pix["devolucoes"][0]["status"] == "DEVOLVIDO") {
                $orderPix->order->order_status_id = $this->REFUNDED;
            }
        }
    }

    private function sendEmailStatus($data)
    {
        Mail::to($data->contact)
            ->bcc("anacnogueira@gmail.com")
            ->send(new OrderStatusChanged($data));           
    }

    private function setExcectionMessageError($code, $message, $log = [])
    {
        //To do: Transformar em Log

        return [
            'error' => [
                "code" => $code,
                "description" => $message
            ]
        ];

    }
}