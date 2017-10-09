<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Request;
use App\Http\Controllers\Controller;

class CmtController extends Controller
{
    private $__cmt;

    public function __construct()
    {
        $this->__cmt = new Comment();
    }

    public function index()
    {
        $data['per'] = 7;
        $data['key'] = '';
        $data['sort'] = 'id';
        $data['type'] = 'desc';
        $data['status'] = -1;

        if(Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
            $data['status'] = $_POST['status'];
        }

        $temp = ($data['status'] < 0) ? '<>' : '=';

        $list = $this->__cmt->where('content', 'LIKE', '%' . $data['key'] . '%')
            ->where('status', $temp, $data['status'])
            ->orderBy($data['sort'], $data['type'])
            ->paginate($data['per']);

//        $list = $this->__cmt->orderBy('created_at')->paginate('5');
        $total = $this->__cmt->where('content', 'LIKE', '%' . $data['key'] . '%')
            ->where('status', $temp, $data['status'])
            ->count();

        $start = $list->perPage() * ($list->currentPage() - 1) + 1;
        $end = $list->perPage() * ($list->currentPage() - 1) + $list->perPage();

        if($end > $total)
            $end = $total;

        if(Request::ajax()) {
            return view('back-end.cmt.list', compact('list', 'start', 'end', 'total', 'level'));
        }

        return view('back-end.cmt.index', compact('list', 'start', 'end', 'total', 'data'));
    }

//    public function filter(Request $r)
//    {
//        $data['key'] = $r->search;
//        $data['field'] = 'content';
//        $data['sort'] = $r->sort;
//        $data['type'] = $r->type_sort;
//        $data['status'] = $r->status;
//
//        $temp = ($r->status == -1) ? '<>' : '=';
//
//        $list = $this->__cmt->where($data['field'], 'LIKE', '%' . $data['key'] . '%')
//            ->where('status', $temp, $data['status'])
//            ->orderBy($data['sort'], $data['type'])
//            ->paginate(5)
//            ->withPath("?search={$data['key']}&sort={$data['sort']}&type_sort={$data['type']}&status={$data['status']}");
//
//        return view('back-end.customer.index', compact('list', 'data'));
//    }

    public function changeStatus($id)
    {
        $cmt = $this->__cmt->find($id);

        if($cmt->status == 1){
            $cmt->status = 0;
        }
        else{
            $cmt->status = 1;
        }

        $cmt->save();

        return redirect()->back()->with('success', 'Đã thay đổi!');
    }
}
