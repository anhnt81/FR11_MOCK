<?php

namespace App\Http\Controllers\Admin;

use App\BillDetail;
use App\Bills;
use App\Customer;
use App\Product;
use Request;
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
        $status = Helper::orderStatusArr();
        $data['per'] = 5;
        $data['key'] = '';
        $data['sort'] = 'id';
        $data['type'] = 'desc';
        $data['status'] = '';
        $data['from'] = 0;
        $data['to'] =  999999999999;
        $data['fromDate'] = '1990-01-01';
        $data['toDate'] = Date('Y-m-d', time() + 84600);

        if(Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
            $data['status'] = $_POST['status'];
            $data['toDate'] = $_POST['toDate'] . ' 23:59:59';
            $data['from'] = $_POST['fromDate'];
            $data['from'] = (empty($_POST['from'])) ? $data['from'] : $_POST['from'];
            $data['to'] = ((empty($_POST['to'])) ? $data['to'] : $_POST['to']);
        }

        $temp = empty($data['status']) ? '<>' : '=';

        $list = $this->__order->where('cid', 'LIKE', '%' . $data['key'] . '%')
            ->where('status', $temp, $data['status'])
            ->where('total', '>=', $data['from'])
            ->where('total', '<=', $data['to'])
            ->where('created_at', '>=', $data['fromDate'])
            ->where('created_at', '<=', $data['toDate'])
            ->orderBy($data['sort'], $data['type'])
            ->paginate($data['per']);

        $total = $this->__order->where('cid', 'LIKE', '%' . $data['key'] . '%')
            ->where('status', $temp, $data['status'])
            ->where('total', '>=', $data['from'])
            ->where('total', '<=', $data['to'])
            ->where('created_at', '>=', $data['fromDate'])
            ->where('created_at', '<=', $data['toDate'])
            ->count();

        $start = $list->perPage() * ($list->currentPage() - 1) + 1;
        $end = $list->perPage() * ($list->currentPage() - 1) + $list->perPage();

        if($end > $total) {
            $end = $total;
        }

        for ($i = 0; $i < count($list); $i++){
            $list[$i]->st = Helper::valOfArr(Helper::orderStatusArr(), $list[$i]->status);
        }

        if(Request::ajax()) {
            return view('back-end.order.list', compact('list', 'start', 'end', 'total', 'status'));
        }

        return view('back-end.order.index', compact('list', 'status', 'start', 'end', 'total', 'data'));
    }

//    public function filter(Request $r)
//    {
//        $status = Helper::orderStatusArr();
//        $data['key'] = $r->search;
//        $data['sort'] = $r->sort;
//        $data['type'] = $r->type_sort;
//        $data['status'] = $r->status;
//        $data['from'] = ($r->from == '') ? 0 : $r->from;
//        $data['to'] = ($r->to == '') ? 999999999999 : $r->to;
//
//        $temp = empty($r->status) ? '<>' : '=';
//
//        $list = $this->__order->where('cid', 'LIKE', '%' . $data['key'] . '%')
//            ->where('status', $temp, $data['status'])
//            ->where('total', '>=', $data['from'])
//            ->where('total', '<=', $data['to'])
//            ->orderBy($data['sort'], $data['type'])
//            ->paginate(5)
//            ->withPath("?search={$data['key']}&sort={$data['sort']}&type_sort={$data['type']}&status={$data['status']}".
//                    "&from={$data['from']}&to={$data['to']}");
//
//        for ($i = 0; $i < count($list); $i++){
//            $list[$i]->st = Helper::valOfArr(Helper::orderStatusArr(), $list[$i]->status);
//        }
//
//        return view('back-end.order.index', compact('list', 'status', 'data'));
//    }

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

    public function postUpdate(\Illuminate\Http\Request $r, $id)
    {
        $order = $this->__order->find($id);
        $order->status = $r->status;
        $order->note = $r->note;

        $order->save();

        return redirect()->route('listOrder');
    }
}
