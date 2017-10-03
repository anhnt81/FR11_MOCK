<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 02-10-2017
 * Time: 10:05 CH
 */

namespace App\Http\Helper;


class Helper
{
    public static function genderArr()
    {
        return array(
            1 => 'Nam',
            2 => 'Nữ',
            3 => 'Khác'
        );
    }

    public static function orderStatusArr()
    {
        return array(
            1 => 'Đang xử lý',
            2 => 'Shiper đã nhận hàng',
            3 => 'Đã giao hàng',
            4 => 'Không giao được hàng',
            5 => 'Trả hàng',
            6 => 'Hoàn thành',
            7 => 'Đóng'
        );
    }

    public static function valOfArr($arr = array(), $k)
    {
        foreach ($arr as $key => $value) {
            if ($k == $key)
                return $value;
        }
    }
}