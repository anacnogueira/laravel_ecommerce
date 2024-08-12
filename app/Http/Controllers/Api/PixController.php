<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PixGenerateChargeRequest;
use App\Services\TimeService;
use App\Services\PixService;
use App\Models\PixEvent;

class PixController extends Controller
{
    protected $pixEvent;

    public function __construct(PixEvent $pixEvent)
    {
        $this->pixEvent = $pixEvent;
    }

    public function generateCharge(PixGenerateChargeRequest $request)
    {
        $pixService = new PixService();

        $data = [
            'devedor' => [
                'cpf' => $request->input('cpf'),
                'name' => $request->input('name'),
            ],
            'valor' => [
                'original' => $request->input('amount')
            ],
            'order_id' => $request->input('order_id')
        ];

         return $pixService->createCharge($data);
    }

    public function consultCharge($txid)
    {
        $pixService = new PixService();
        return $pixService->consultCharge($txid);
    }

    public function listCharges()
    {
        $pixService = new PixService();
        $timeService = new TimeService();

        $startDate =  $timeService->setDateToRFC3339(date_create($timeService->removeSecondsToNow(10800)));
        $endDate    = $timeService->setDateToRFC3339($timeService->getNow());

        $params = [
            "inicio" => $startDate,
            "fim"    => $endDate
        ];
        $response =  $pixService->listCharges($params);
    }

    public function webhook()
    {
        return "OK";
    }

    public function configWebhook()
    {
        $pixService = new PixService();
        return $pixService->configWebhook();
    }

    public function listWebhook()
    {
        $pixService = new PixService();

        $params = [
            "inicio" => "2023-08-01T00:00:00Z",
            "fim" => "2024-08-11T23:59:59Z"
        ];

        return $pixService->listWebhook($params);
    }

    public function pix(Request $request)
    {
        $pixService = new PixService();

        $string = json_decode(json_encode($request->all()), true);

        $fileName = "notification-pix-".date("Y-m-d-h-i-s").".log";
        Storage::disk('local')->put($fileName, json_encode($request->input()));


        foreach($request["pix"] as $pix) {
            $this->pixEvent->create([
                "e2eid" => $pix["endToEndId"],
                "txid" => $pix["txid"],
                "event" => json_encode($pix)
            ]);
            
            $pixService->saveOrderPix($pix);            
        }
    }

    public function devolution($e2eid, $id, Request $request)
    {
        $pixService = new PixService();
        return $pixService->devolution($e2eid, $id, $request["value"]);   
    }
}
