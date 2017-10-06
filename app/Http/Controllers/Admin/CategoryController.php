<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\admin\AddCatRequest;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $__cat;

    public function __construct()
    {
        $this->__cat = new Category();
    }

    public function index()
    {
        $data['per'] = 7;
        $data['key'] = '';
        $data['sort'] = 'id';
        $data['type'] = 'desc';

        if(Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
        }

        $list = $this->__cat->where('name', 'LIKE', '%' . $data['key'] . '%')
            ->orderBy($data['sort'], $data['type'])
            ->paginate($data['per']);

        $total = $this->__cat->where('name', 'LIKE', '%' . $data['key'] . '%')->count();
        $start = $list->perPage() * ($list->currentPage() - 1) + 1;
        $end = $list->perPage() * ($list->currentPage() - 1) + $list->perPage();

        if($end > $total) {
            $end = $total;
        }

        if(Request::ajax()) {
            return view('back-end.category.list', compact('list', 'start', 'end', 'total', 'data'));
        }
        return view('back-end.category.index', compact('list', 'start', 'end', 'total', 'data'));
    }

//    public function filter(Request $r)
//    {
//        $data['key'] = $r->search;
//        $data['sort'] = $r->sort;
//        $data['type'] = $r->type_sort;
//
//        $list = $this->__cat->where('name', 'LIKE', '%' . $data['key'] . '%')
//            ->orderBy($data['sort'], $data['type'])
//            ->paginate(5)
//            ->withPath("?search={$data['key']}&sort={$data['sort']}&type_sort={$data['type']}");
//
//        return view('back-end.category.index', compact('list'))->with('data', $data);
//    }

    public function add()
    {
        $list = $list = Category::all();

        return view('back-end.category.add', compact('list'));
    }

    public function postAdd(AddCatRequest $r)
    {
        $this->__cat->name = $r->name;
        $this->__cat->parentId = $r->parentId;

        $this->__cat->save();

        return redirect()->route('listCat')->with('success', 'Thêm thành công!');
    }

    public function update($id)
    {
        $cat = $this->__cat->where('id', $id)->first();
        $list = Category::all();

        return view('back-end.category.update', compact('cat', 'list'));
    }

    public function postUpdate(AddCatRequest $r, $id)
    {
        $this->__cat->where('id', $id)
            ->update([
                'name'     => $r->name,
                'parentId' => $r->parentId
            ]);

        return redirect()->route('listCat')->with('success', 'Sửa thành công!');
    }

    public function delete(Request $r)
    {
//        $this->__cat->find($r->id)
//            ->delete();

        return redirect()->route('listCat')->with('success', 'Xóa thành công!');
    }
}
