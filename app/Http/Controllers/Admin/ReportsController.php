<?php

namespace App\Http\Controllers\Admin;

use App\BillDetail;
use App\Bills;
use App\Http\Helper\Helper;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    private $__orderDetail;

    public function __construct()
    {
        $this->__orderDetail = new BillDetail();
    }

    public function index()
    {
        $list = $this->__orderDetail->all();

        $data = $this->getParam($list);

        return view('back-end.reports.index', compact('data'));
    }

    public function getByPeriod(Request $r)
    {
        $data = [];
        $from = $r->fromDate;
        $to = $r->toDate . ' 23:59:59';

        $list = $this->__orderDetail->whereBetween('created_at', [$from, $to])->get();

        if($list->count() > 0) {
            $data = $this->getParam($list);
        }

        return view('back-end.reports.content', compact('data'));
    }

    public function getParam($list)
    {
        $best = [];
        $arr = [];

        foreach ($list as $key => $item) {
            $arr[$key]['pid'] = $item->product->name;
            $arr[$key]['bid'] = $item->product->brand->name;
            $arr[$key]['cid'] = $item->product->category->name;
            $arr[$key]['qty'] = $item->qty;

            $best = array_merge_recursive($best, $arr[$key]);
        }

        $result['prdOrder'] = array_count_values($best['pid']);
        $result['brOrder'] = array_count_values($best['bid']);
        $result['catOrder'] = array_count_values($best['cid']);

        arsort($result['prdOrder']);
        arsort($result['brOrder']);
        arsort($result['catOrder']);

        $result['prdQty'] = Helper::sumQtyOrder($result['prdOrder'], $arr, 'pid');
        $result['brQty'] = Helper::sumQtyOrder($result['brOrder'], $arr, 'bid');
        $result['catQty'] = Helper::sumQtyOrder($result['catOrder'], $arr, 'cid');

        if(count($result['prdOrder']) > 5) {
            $result['prdOrder'] = array_slice($result['prdOrder'], 0, 5);
        }
        if(count($result['brOrder']) > 10) {
            $result['brOrder']['Khác'] = 0;
            $temp = 0;
            foreach ($result['brOrder'] as $key => $value) {
                $temp++;
                if($temp >= 10) {
                    $result['brOrder']['Khác'] += $value;
                }
            }
            $result['brOrder'] = array_slice($result['brOrder'], 0, 10);
        }
        if(count($result['catOrder']) > 10) {
            $result['catOrder']['Khác'] = 0;
            $temp = 0;
            foreach ($result['catOrder'] as $key => $value) {
                $temp++;
                if($temp >= 10) {
                    $result['catOrder']['Khác'] += $value;
                }
            }
            $result['catOrder'] = array_slice($result['catOrder'], 0, 10);
        }
        return $result;
    }

}
