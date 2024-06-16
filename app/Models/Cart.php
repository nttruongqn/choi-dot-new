<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class Cart extends Model
{
    public $items = null;
    public $total_quantity = 0;
    public $total_price = 0;

    // use HasFactory;

    public function __construct($old_cart)
    {
        if ($old_cart) {
            $this->items = $old_cart->items;
            $this->total_quantity = $old_cart->total_quantity;
            $this->total_price = $old_cart->total_price;
        }
    }

    public function add($item, $id)
    {
        if ($item->is_sale) {
            $price = $item->price - ($item->price * $item->sale / 100);
        } else {
            $price = $item->price;
        }

        $stored_item = [
            'quantity' => 0,
            'price' => $price,
            'item' => $item
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $stored_item = $this->items[$id];
            }
        }

        $stored_item['quantity']++;
        $stored_item['price'] = $stored_item['quantity'] * $price;
        $this->items[$id] = $stored_item;
        $this->total_quantity++;
        $this->total_price += $price;
    }

    public function remove($id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->total_quantity = $this->total_quantity - $this->items[$id]['quantity'];
                $this->total_price = $this->total_price - $this->items[$id]['price'];
                unset($this->items[$id]);
            }

            if (count($this->items) == 0) {
                $this->total_quantity = 0;
                $this->total_price = 0;
                unset($this->items);
                return 2;
            }
            return 1;
        } else {
            return 0;
        }
    }

    public function updateCart($item, $id, $new_quantity)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->total_quantity = ($this->total_quantity - $this->items[$id]['quantity']) + $new_quantity;
                $this->total_price = ($this->total_price - $this->items[$id]['price']) + ($new_quantity * $item->price);
                $this->items[$id]['quantity'] = $new_quantity;
                $this->items[$id]['price'] = $new_quantity * $item->price;
            }
            return true;
        } else {
            return false;
        }
    }
}
