<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Requests\admin\UpdateCustomerRequest;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Request;

class CustomerController extends Controller
{
    private $__cus;

    public function __construct()
    {
        $this->__cus = new Customer();
    }

    public function index()
    {
        $data['per'] = 7;
        $data['key'] = '';
        $data['field'] = 'name';
        $data['sort'] = 'id';
        $data['type'] = 'desc';

        if(Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['field'] = $_POST['field_search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
        }

        $list = $this->__cus->where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->orderBy($data['sort'], $data['type'])
            ->paginate($data['per']);

        $total = $this->__cus->where($data['field'], 'LIKE', '%' . $data['key'] . '%')->count();
        $start = $list->perPage() * ($list->currentPage() - 1) + 1;
        $end = $list->perPage() * ($list->currentPage() - 1) + $list->perPage();

        if($end > $total) {
            $end = $total;
        }

        if(Request::ajax()) {
            return view('back-end.customer.list', compact('list', 'start', 'end', 'total'));
        }
        return view('back-end.customer.index', compact('list', 'start', 'end', 'total', 'data'));
    }

    public function update($id)
    {
        $cus = $this->__cus->where('id', $id)->first();

        return view('back-end.customer.update', compact('cus'));
    }

    public function postUpdate(UpdateCustomerRequest $r, $id)
    {
        $this->__cus->where('id', $id)
            ->update([
                'name'    => $r->name,
                'email'   => $r->email,
                'phone'   => $r->phone,
                'address' => $r->address,
                'gender'  => $r->gender
            ]);

        return redirect()->route('listCus')->with('success', 'Sửa thành công!');
    }
}
