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

    /*
     * @param $a1
     * @param $a2
     * @param $k
     * @return $result
     */
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

    /*
     * Recursive list of categories id
     * @param $objCat : Category object should get the ID list
     * @param @listCat : All category object
     * @return $list : list Id
     */
    public static function getid($objCat, $listCat)
    {
        $list[] = $objCat->id;
        foreach ($listCat as $key => $value) {
            if ($value->parentId == $objCat->id) {
                $list[] = Self::getid($value, $listCat);
            }
        }
        return $list;
    }

    /*
     * Recursive list of categories : html
     * @param $categories : All Category object should get the ID list
     * @param $parentId : Id category parent
     * @return $list : list Id
     */
    public static function multiMenu($categories, $parentId = 0)
    {
        $child = array();
        foreach ($categories as $key => $item) {
            if ($item['parentId'] == $parentId) {
                $child[] = $item;
                unset($categories[$key]);
            }
        }

        if ($child) {
            echo "<ul class='sub-menu'>";
            foreach ($child as $key => $item) {

                echo "<li><a href='chuyen-muc/{$item->id}'>{$item->name} ".
                        "<span> ({$item->totalPrd})</span></a>";

                Self::multiMenu($categories, $item->id);

                echo '</li>';
            }
            echo '</ul>';
        }
    }
}