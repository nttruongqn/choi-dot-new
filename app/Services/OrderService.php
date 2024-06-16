<?php
namespace App\Services;

use App\Repositories\Order\OrderRepositoryInterface;


class OrderService
{
    private $order_repo;

    public function __construct(OrderRepositoryInterface $order_repo)
    {
        $this->order_repo = $order_repo;
    }

}
