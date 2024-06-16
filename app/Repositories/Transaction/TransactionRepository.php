<?php
namespace App\Repositories\Transaction;

use App\Models\Transaction;
use App\Repositories\BaseRepository;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function getModel()
    {
        return Transaction::class;
    }

    public function getIdFromInsert($data)
    {
        $transaction = $this->model->create($data);
        return $transaction->id;
    }

    public function getAllWithConditions(Request $request)
    {
        $transactions = $this->model::with('orders');
        if ($request->checkout_search_value) {
            $transactions->where('fullname', 'like', '%' . $request->checkout_search_value . '%');
        }
        if ($request->filter_checkout_status) {
            $transactions->where('status', $request->filter_checkout_status);
        }
        $transactions = $transactions->paginate(8)->appends($request->all());
        ;
        return $transactions;
    }

    public function setStatusTransaction($id, $status)
    {
        return $this->model->where('id', $id)->update(["status" => $status]);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function countTransactionByCurrentMonth()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        return $this->model->whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
    }

    public function countTransactionStatusByMonth($status, $month, $year)
    {


        return $this->model->where('status', $status)->whereYear('created_at', $year)->whereMonth('created_at', $month)->count();

    }


}
