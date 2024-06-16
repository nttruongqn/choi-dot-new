<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $status_class_list = [
        TransactionStatus::PROCESSING => [
            'class' => "badge bg-warning"
        ],
        TransactionStatus::COMPLETED => [
            'class' => "badge bg-success"
        ],
        TransactionStatus::CANCEL => [
            'class' => "badge bg-danger"
        ],
    ];

    public function getStatusClass()
    {
        return array_get($this->status_class_list, $this->status, '[]');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
