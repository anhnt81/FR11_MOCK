<?php

namespace App\Http\Controllers\Admin;

use App\BillDetail;
use App\Bills;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $__order;
    private $__orderDetail;
    private $__status;

    public function __construct()
    {
        $this->__order = new Bills();
        $this->__orderDetail = new BillDetail();
        $this->__status = array(
            1 => 'Đang xử lý',
            2 => 'Shiper đã nhận hàng',
            3 => 'Đã giao hàng',
            4 => 'Hoàn thành',
            5 => 'Trả hàng',
            6 => 'Không giao được hàng'
        );
    }

    public function index()
    {
        $list = $this->__order->orderBy('updated_at', 'desc')->paginate('5');
        $status =$this->__status;

        for ($i = 0; $i < count($list); $i++){
            $list[$i]->st = $this->toStringStatus($list[$i]->status);
        }

        return view('back-end.order.index', compact('list', 'status'));
    }

    public function filter(Request $r)
    {

    }

    public function viewDetail($id)
    {

    }

    public function toStringStatus($status)
    {
        foreach ($this->__status as $key => $item)
        {
            if($key == $status)
                return $item;
        }
    }
}
