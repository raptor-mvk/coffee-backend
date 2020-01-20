<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\GoodsRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdersService
{
    /** @var GoodsRepositoryInterface */
    private $goodsRepository;

    public function __construct(GoodsRepositoryInterface $goodsRepository)
    {
        $this->goodsRepository = $goodsRepository;
    }

    /**
     * @param array $goods
     * @return float
     */
    public function getOrderSum(array $goods): float
    {
        $result = 0;
        foreach ($goods as $id => $quantity) {
            if ($quantity < 0) {
                throw new BadRequestHttpException('Quantity must be positive');
            }
            $good = $this->goodsRepository->get($id);
            if ($good === null) {
                throw new NotFoundHttpException("Good with ID $id not found");
            }
            $result += $good->getPrice() * $quantity;
        }
        return $result;
    }
}
