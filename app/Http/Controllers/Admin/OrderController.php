<?php

namespace App\Http\Controllers\Admin;

use App\BillDetail;
use App\Bills;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\Helper;

class OrderController extends Controller
{
    private $__order;
    private $__orderDetail;
    private $__cus;
    private $__prd;

    public function __construct()
    {
        $this->__order = new Bills();
        $this->__orderDetail = new BillDetail();
        $this->__cus = new Customer();
        $this->__prd = new Product();
    }

    public function index()
    {
        $list   = $this->__order->orderBy('updated_at', 'desc')->paginate('5');
        $status = Helper::orderStatusArr();

        for ($i = 0; $i < count($list); $i++){
            $list[$i]->st = Helper::valOfArr(Helper::orderStatusArr(), $list[$i]->status);
        }

        return view('back-end.order.index', compact('list', 'status'));
    }

    public function filter(Request $r)
    {
        $status = Helper::orderStatusArr();
        $data['key'] = $r->search;
        $data['sort'] = $r->sort;
        $data['type'] = $r->type_sort;
        $data['status'] = $r->status;
        $data['from'] = ($r->from == '') ? 0 : $r->from;
        $data['to'] = ($r->to == '') ? 999999999999 : $r->to;

        $temp = empty($r->status) ? '<>' : '=';

        $list = $this->__order->where('cid', 'LIKE', '%' . $data['key'] . '%')
            ->where('status', $temp, $data['status'])
            ->where('total', '>=', $data['from'])
            ->where('total', '<=', $data['to'])
            ->orderBy($data['sort'], $data['type'])
            ->paginate(5)
            ->withPath("?search={$data['key']}&sort={$data['sort']}&type_sort={$data['type']}&status={$data['status']}".
                    "&from={$data['from']}&to={$data['to']}");

        for ($i = 0; $i < count($list); $i++){
            $list[$i]->st = Helper::valOfArr(Helper::orderStatusArr(), $list[$i]->status);
        }

        return view('back-end.order.index', compact('list', 'status', 'data'));
    }

    public function viewDetail($id)
    {
        $total = 0;
        $order = $this->__order->find($id);
        $order->s_status = Helper::valOfArr(Helper::orderStatusArr(), $order->status);
        $cus = $this->__cus->find($order->id);
        $cus->s_gender = Helper::valOfArr(Helper::genderArr(), $cus->gender);
        $detail = $order->orderDetail;

        foreach ($detail as $item) {
            $total += $item->total;
//            $ava[] = explode(',', $item->product->images)[0];
        }

        return view('back-end.order.detail', compact('order', 'cus', 'detail', 'total'));
    }

    public function update($id)
    {
        $order = $this->__order->find($id);
        $status = Helper::orderStatusArr();

        return view('back-end.order.update', compact('order', 'status'));
    }

    public function postUpdate(Request $r, $id)
    {
        $order = $this->__order->find($id);
        $order->status = $r->status;
        $order->note = $r->note;

        $order->save();

        return redirect()->route('listOrder');
    }
}
