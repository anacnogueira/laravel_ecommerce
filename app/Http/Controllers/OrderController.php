<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\ShippingService;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    protected $orderService;
    protected $shippingService;

    public function __construct(OrderService $orderService, ShippingService $shippingService)
    {
        $this->orderService = $orderService;
        $this->shippingService = $shippingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = null;
        $queryParams = [];

        if ($request->route('filter') !== null) {
            $filters = explode(":", $request->route('filter'));
            $type = $filters[1];
        }

        $sort = $request->query('sort');
        $direction = $request->query('direction') ?? 'asc';

        $title = $this->defineTitleFilter($type);
        $customerId = Auth::id();

        $queryParams = [
            "paginate" => 10,
            "filter" => $type,
            "sort" => $sort,
            "direction" => $direction
        ];

        //Conditions
        switch($type) {
            case "abertos":
                $queryParams['conditions'] = [
                    ["column" => "order_status_id", "operator" => "!=", "value" => 9]
                ];
                break;
            case "entregues":
                $queryParams['conditions'] = [
                    ["column" => "order_status_id", "operator" => "=", "value" => 9]
                ];
                break;
            case "data":
                $dateFrom = $request->query("date_from");
                $dateTo = $request->query("date_to");

                if ($dateFrom && !$dateTo) {
                    $queryParams['conditions'] = [
                        ["column" => "orders.created", "operator" => ">=", "value" => $dateFrom]
                    ];
                }

                if (!$dateFrom && $dateTo) {
                    $queryParams['conditions'] = [
                        ["column" => "orders.created", "operator" => "<=", "value" => $dateTo]
                    ];
                }

                if ($dateFrom  && $dateTo) {
                    $queryParams['conditions'] = [
                        ["column" => "orders.created", "operator" => "between", "value" => [$dateFrom, $dateTo]]
                    ];
                }
                break;
            case "numero":
                if ($request->query("order_id")) {
                    $queryParams['conditions'] = [
                        ["column" => "orders.id", "operator" => "=", "value" => ltrim($request->query("order_id"), 0)]
                    ];
                }
                break;
        }

        $orders = $this->orderService->getAllOrdersByContactId($customerId, $queryParams);
        $direction = $direction == 'desc' ? 'asc' : 'desc';

        return view('orders.index', compact('orders','title', 'type', 'direction'));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Detalhe do pedido $id";
        $customerId = Auth::id();

        $order = $this->orderService->getOrderByIdAndContactId($id, $customerId);
        $order->shipping = $this->shippingService->getServiceDescription($order->type_shipping);

        return view('orders.show', compact('title','order'));
    }

    private function defineTitleFilter($filter)
    {
        switch ($filter) {
            case 'ultimos':
                $title = "Últimos pedidos";
                break;
            case 'abertos':
                $title = "Pedidos Abertos";
                break;
            case 'entregues':
                $title = "Pedidos Entregues";
                break;
            case "numero":
                $title = "Pedidos por número";
                break;
            case "data":
                $title = "Pedidos por data";
                break;
            default:
                $title = "Todos os pedidos";
        }

        return $title;
    }
}
