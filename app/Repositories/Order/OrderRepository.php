<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }
    public function getByTransactionId($transactionId)
    {
        return $this->model->with('product', 'transaction')->where("transaction_id", $transactionId)->get();
    }
}
