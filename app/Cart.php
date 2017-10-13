<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addCart($item, $id, $qty)
    {
        $price_unit_or_promotion = $item->unit_price;
        if ($item->promotion_price != 0) {
            $price_unit_or_promotion = $item->promotion_price;
        }
        $giohang = ['qty' => 0, 'price' => $price_unit_or_promotion, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $giohang = $this->items[$id];
            }
        }
        $giohang['qty'] += $qty;
        $giohang['total_qty'] = $item->qty;
        $giohang['price'] = $price_unit_or_promotion * $giohang['qty'];
        $giohang['aprice'] = $price_unit_or_promotion;
        $this->items[$id] = $giohang;
        $this->totalQty += $qty;
        $this->totalPrice += $price_unit_or_promotion * $qty;
    }

    //xóa 1
    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
