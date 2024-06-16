<?php
namespace App\Services;

use App\Repositories\Transaction\TransactionRepositoryInterface;


class TransactionService
{
    private $transaction_repo;

    public function __construct(TransactionRepositoryInterface $transaction_repo)
    {
        $this->transaction_repo = $transaction_repo;
    }

}
