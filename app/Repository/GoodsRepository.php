<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Good;

class GoodsRepository implements GoodsRepositoryInterface
{
    /** @var Good[] */
    private $goodList;

    public function __construct()
    {
        $this->goodList = [];
    }

    /**
     * @param Good $good
     */
    public function store(Good $good): void
    {
        $this->goodList[$good->getId()] = $good;
    }

    /**
     * @param int $id
     * @return Good|null
     */
    public function get(int $id): ?Good
    {
        return $this->goodList[$id] ?? null;
    }

    /**
     * @return Good[]
     */
    public function getAll(): array
    {
        return array_values($this->goodList);
    }
}
