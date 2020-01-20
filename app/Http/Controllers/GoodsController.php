<?php

namespace App\Http\Controllers;

use App\Model\Good;
use App\Repository\GoodsRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class GoodsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var GoodsRepositoryInterface */
    private $goodsRepository;

    public function __construct(GoodsRepositoryInterface $goodsRepository)
    {
        $this->goodsRepository = $goodsRepository;
    }

    public function index(Request $request): Response
    {
        $headers = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8',
        ];
        $content = json_encode(
            array_map(
                static function(Good $good) {
                    return $good->jsonSerialize();
                },
                $this->goodsRepository->getAll()
            )
        );
        return response($content, 200, $headers);
    }
}
