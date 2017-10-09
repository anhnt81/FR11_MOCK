<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helper\Helper;
use App\Http\Requests\admin\AddUserRequest;
use App\Http\Requests\admin\UpdateUserRequest;
use App\User;
use Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    //
   public function listBrand(){
   		return view("brand.list");
   }
    private  $__user;

    public function __construct()
    {
        $this->__user = new User();
    }

    public function index()
    {
        $data['per'] = 7;
        $data['key'] = '';
        $data['field'] = 'name';
        $data['sort'] = 'id';
        $data['type'] = 'desc';
        $data['status'] = '';
        $data['level'] = '';

        if(Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['field'] = $_POST['field_search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
            $data['status'] = $_POST['status'];
            $data['level'] = $_POST['level'];
        }

        $opStatus = empty($data['status']) ? '<>' : '=';
        $opLevel = empty($data['level']) ? '<>' : '=';

        $list = $this->__user->where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->where('level', $opLevel, $data['level'])
            ->where('status', $opStatus, $data['status'])
            ->orderBy($data['sort'], $data['type'])
            ->paginate($data['per']);

        $total = $this->__user->where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->where('level', $opLevel, $data['level'])
            ->where('status', $opStatus, $data['status'])
            ->count();

        $start = $list->perPage() * ($list->currentPage() - 1) + 1;
        $end = $list->perPage() * ($list->currentPage() - 1) + $list->perPage();

        if($end > $total) {
            $end = $total;
        }

        $level = Helper::levelArr();

        for ($i = 0; $i < count($list); $i++){
            $list[$i]->slevel = Helper::valOfArr($level, $list[$i]->level);
        }

        if(Request::ajax()) {
            return view('back-end.user.list', compact('list', 'start', 'end', 'total', 'level'));
        }

        return view('back-end.user.index', compact('list', 'level', 'start', 'end', 'total', 'data'));
    }

//    public function filter(Request $r)
//    {
//        $data['key'] = $r->search;
//        $data['field'] = $r->field_search;
//        $data['sort'] = $r->sort;
//        $data['type'] = $r->type_sort;
//        $data['status'] = $r->status;
//        $data['level'] = $r->level;
//
//        $opStatus = empty($data['status']) ? '<>' : '=';
//        $opLevel = empty($data['level']) ? '<>' : '=';
//
//        $list = $this->__user->where($data['field'], 'LIKE', '%' . $data['key'] . '%')
//            ->where('level', $opLevel, $data['level'])
//            ->where('status', $opStatus, $data['status'])
//            ->orderBy($data['sort'], $data['type'])
//            ->paginate(5)
//            ->withPath("?search={$data['key']}&field_search={$data['field']}&sort={$data['sort']}&type_sort={$data['type']}".
//                "&status={$data['status']}&level={$data['level']}");
//
//        $level = Helper::levelArr();
//        for ($i = 0; $i < count($list); $i++){
//            $list[$i]->slevel = Helper::valOfArr($level, $list[$i]->level);
//        }
//
//        return view('back-end.user.index', compact('list', 'data', 'level'));
//    }

    public function add()
    {
        $level = Helper::levelArr();

        return view('back-end.user.add', compact('level'));
    }

    public function postAdd(AddUserRequest $r)
    {
        $this->__user->email = $r->email;
        $this->__user->avatar = 'avatar.png';
        $this->__user->password = bcrypt($r->password);
        $this->__user->status = 1;
        $this->__user->phone = $r->phone;

        if(empty($r->name)){
            $this->__user->name = 'NONAME';
        }
        else{
            $this->__user->name = $r->name;
        }

        if(empty($r->level)){
            $this->__user->level = 4;
        }

        $this->__user->save();

        return redirect()->route('listUser')->with('success', 'Thêm thành công!');
    }

    public function update($id)
    {
        $user = $this->__user->where('id', $id)->first();

        if(Auth::guard('admin')->User()->level == 1 || Auth::guard('admin')->User()->id == $id
            || Auth::guard('admin')->User()->level < $user->level) {
            $level = Helper::levelArr();

            return view('back-end.user.update', compact('user', 'level'));
        }
        else {
            return redirect()->route('listUser')->with('error', 'Bạn không được phép sửa thành viên này!');
        }
    }

    public function postUpdate(UpdateUserRequest $r, $id)
    {
        $user = $this->__user->find($id);

        $user->email = $r->email;
        $user->name = $r->name;

        if($user->level != 1) {
            $user->level = $r->level;
            $user->status = $r->status;
        }
        if(!empty($r->pass)){
            $user->password = bcrypt($r->pass);
        }
        $user->phone = $r->phone;
        if($r->hasFile('avatar')) {
            $ava = $r->file('avatar');
            $user->avatar = 'u-ava-' . $id . '.' . $ava->getClientOriginalExtension();

            $ava->move('uploads/images/', $user->avatar);
        }

        $user->save();

        return redirect()->route('listUser')->with('success', 'Sửa thành công!');
    }

    public function delete(\Illuminate\Http\Request $r)
    {
        $this->__user->find($r->id)
            ->delete();

        return redirect()->route('listUser')->with('success', 'Xóa thành công!');
    }
}
