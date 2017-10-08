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

    public static function levelArr()
    {
        return array(
            1 => 'Boss',
            2 => 'Admin',
            3 => 'Người dùng vip',
            4 => 'Người dùng thường'
        );
    }

    public static function valOfArr($arr = array(), $k)
    {
        foreach ($arr as $key => $value) {
            if ($k == $key)
                return $value;
        }
    }

    public static function sumQtyOrder($a1, $a2, $k)
    {
        foreach ($a1 as $key => $item) {
            $result[$key] = 0;
            for ($i = 0; $i < count($a2); $i++) {
                if ($a2[$i][$k] == $key) {
                    $result[$key] += $a2[$i]['qty'];
                }
            }
        }

        return $result;
    }
}