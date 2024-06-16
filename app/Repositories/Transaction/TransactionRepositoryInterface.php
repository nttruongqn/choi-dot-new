<?php
namespace App\Repositories\Transaction;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface TransactionRepositoryInterface extends RepositoryInterface
{
    public function getIdFromInsert($data);

    public function getAllWithConditions(Request $request);

    public function setStatusTransaction($id, $status);

    public function getById($id);

    public function countTransactionByCurrentMonth();

    public function countTransactionStatusByMonth($status, $month, $year);

}
