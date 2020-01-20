<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Good;

interface GoodsRepositoryInterface
{
    /**
     * @param Good $good
     */
    public function store(Good $good): void;

    /**
     * @param int $id
     * @return Good|null
     */
    public function get(int $id): ?Good;

    /**
     * @return Good[]
     */
    public function getAll(): array;
}
