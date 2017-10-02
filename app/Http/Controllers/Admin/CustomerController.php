<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Requests\admin\UpdateCustomerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    private $__cus;

    public function __construct()
    {
        $this->__cus = new Customer();
    }

    public function index()
    {
        $list = $this->__cus->paginate(7);

        return view('back-end.customer.index', compact('list'));
    }

    public function filter(Request $r)
    {
        $data['key'] = $r->search;
        $data['field'] = $r->field_search;
        $data['sort'] = $r->sort;
        $data['type'] = $r->type_sort;

        $list = $this->__cus->where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->orderBy($data['sort'], $data['type'])
            ->paginate(7);

        return view('back-end.customer.index', compact('list'))->with('data', $data);
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

        return redirect()->route('listCus');
    }
}
