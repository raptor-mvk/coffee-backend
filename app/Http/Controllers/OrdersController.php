<?php

namespace App\Http\Controllers;

use App\Service\OrdersService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var OrdersService */
    private $ordersService;

    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    public function order(Request $request): Response
    {
        $headers = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8',
        ];
        $data = json_decode($request->getContent(), true);
        $result = $this->ordersService->getOrderSum($data ?? []);
        return response($result, 200, $headers);
    }
}
