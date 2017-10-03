<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
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
        $list = $this->__cmt->orderBy('created_at')->paginate('5');

        return view('back-end.cmt.index', compact('list'));
    }

    public function filter(Request $r)
    {
        $data['key'] = $r->search;
        $data['field'] = 'content';
        $data['sort'] = $r->sort;
        $data['type'] = $r->type_sort;
        $data['status'] = $r->status;

        $temp = ($r->status == -1) ? '<>' : '=';

        $list = $this->__cmt->where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->where('status', $temp, $data['status'])
            ->orderBy($data['sort'], $data['type'])
            ->paginate(5)
            ->withPath("?search={$data['key']}&sort={$data['sort']}&type_sort={$data['type']}&status={$data['status']}");

        return view('back-end.customer.index', compact('list', 'data'));
    }

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

        return redirect()->back();
    }
}
