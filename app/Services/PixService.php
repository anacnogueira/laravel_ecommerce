<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Efi\Exception\EfiException;
use Efi\EfiPay;

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
            "client_id" => env("EFI_CLIENT_ID"),
            "client_secret" =>  env("EFI_CLIENT_SECRET"),
            "pix_cert" => Storage::disk('private')->path('certificates/'. env("EFI_CERT")),
            "sandbox" => env("EFI_SANDBOX"),
            "debug" => false,
            "timeout" => 30
        ];

        $this->status = [
            'not_found' => ['status' => 'not_found','type' => 'error'],
            'pending'   => ['status' => 'pending_payment', 'type' => 'warning'],
            'expired'   => ['status' => 'expired','type' => 'error'],
            'paid'      => ['status' => 'paid','type' => 'success'],
        ];

    }

    public function createCharge($infoPix)
    {
        $response = [];

        $body = [
            'calendario' => [
                'expiracao' => intval(env('EFI_PIX_EXPIRATION'))
            ],
            'devedor' => [
                'cpf' => preg_replace("/[^0-9]/","", $infoPix['cpf']),
                'nome' => $infoPix['name'],
            ],
            'valor' => [
                'original' => strval(number_format($infoPix['amount'],2,'.',',')),
            ],
            'chave' => env("EFI_PIXKEY"),
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
                        'dueDate' => $dueDate,
                        'status' => 'new'
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
            "chave" => env("EFI_PIXKEY")
        ];

        $body = [
            "webhookUrl" => "https://mayacosmeticos.com.br/api/pix/webhook"
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

    public function listWebhook($params)
    {
        try {
            $api = new EfiPay($this->options);
            $response = $api->pixListWebhook($params);

            print_r("<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>");
        } catch (EfiException $e) {
            print_r($e->code . "<br>");
            print_r($e->error . "<br>");
            print_r($e->errorDescription) . "<br>";
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

    public function saveOrderPix($pix, $order)
    {
        $order->where("id", function($query) use($pix){
            $query->select("order_id")
                ->from("order_pixes")
                ->where("txid",$pix["txid"]);
        })
        ->with(['orderPix','contact', 'orderStatus'])
        ->first();

        if ($order) {

            $order->order_status_id = $this->setStatus($pix, $order);
            $order->save();

            if ($pix["endToEndId"]) {
                $order->orderPix->e2eid = $pix["endToEndId"];
                $order->orderPix->save();
            }

           $this->sendEmailStatus($order);
        }
    }

    private function setStatus($pix, $order)
    {
        if (!isset($pix["devolucoes"])) {
            return $this->PAID;
        } else {
            if ($pix["devolucoes"][0]["status"] == "EM_PROCESSAMENTO") {
                return $this->PENDINGREFUND;
            } else if($pix["devolucoes"][0]["status"] == "DEVOLVIDO") {
                return $this->REFUNDED;
            }
        }
    }

    private function sendEmailStatus($order)
    {
        Mail::to($order->contact)
            ->bcc("anacnogueira@gmail.com")
            ->send(new OrderStatusChanged($order));
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
