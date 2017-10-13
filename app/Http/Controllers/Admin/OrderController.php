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
        $data['toDate'] = Date('Y-m-d');

        if(Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
            $data['status'] = $_POST['status'];
            $data['toDate'] = $_POST['toDate'];
            $data['from'] = $_POST['fromDate'];
            $data['from'] = (empty($_POST['from'])) ? $data['from'] : $_POST['from'];
            $data['to'] = ((empty($_POST['to'])) ? $data['to'] : $_POST['to']);
        }
        $data['toDate'] .=  ' 23:59:59';

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

    public function viewDetail($id)
    {
        $total = 0;
        $order = $this->__order->find($id);
        $order->s_status = Helper::valOfArr(Helper::orderStatusArr(), $order->status);
        $cus = $this->__cus->find($order->cid);
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

        return redirect()->route('listOrder')->with('success', 'Sửa thành công!');
    }

    public function getWeekOrder()
    {
        $orders = array();
        $orders['date'][0] = date('Y-m-d');
        for ($i = 1; $i < 7; $i++) {
            $orders['date'][$i] = strtotime(date("Y-m-d", strtotime($orders['date'][$i-1])) . " -1 day");
            $orders['date'][$i] = strftime("%Y-%m-%d",$orders['date'][$i]);
        }

        for ($i = 0; $i < 7; $i++) {
            $orders['value'][$i] = $this->__order->whereBetween('created_at',
                [$orders['date'][$i], $orders['date'][$i].' 23:59:59'])->count();
        }

        die(json_encode($orders));
    }
}
