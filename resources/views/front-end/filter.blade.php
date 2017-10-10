<div style='text-align: right'>
    <button class='btn btn-primary' id='btn-filter-prd'><span class='glyphicon glyphicon-filter'></span> &nbsp; Lọc sản phẩm</button>
</div>
<div id='filter' style='display: none'>
    <form role='form' class='filter-frm'>
        <div class='form-group'>
            <label>Thương hiệu</label>
            <div>
                <input type='radio' name='brand' value='0' class='form-val'
                       @if(empty($filter['brand']) || $filter['brand'] == 0) checked @endif> Tất cả
                @foreach($listBr as $item)
                    <input type='radio' name='brand' value='{{$item->id}}' class='form-val'
                           @if(isset($filter['brand']) && $filter['brand'] == $item->id) checked @endif> {{$item->name}}
                @endforeach
            </div>
        </div>
        <hr>
        <div class='form-group'>
            <label>Giá</label>
            <div class='form-control-static'>
                <input class='form-control form-val' type='number' name='from'
                       value='00000000000000' style='width:45%;float: left;'>
                <div style='width:10%;text-align: center;float:left;'> - </div>
                <input class='form-control form-val' type='number' name='to'
                       value='99999999999999' style='width:45%; float: right'>
            </div>
        </div>
        <hr>
        <div class='form-group'>
            <label>Sắp xếp</label>
            <div>
                <input type='radio' name='sort' value='price' class='form-val'
                    @if(isset($filter['sort']) && $filter['sort'] =='price') checked @endif> Giá
                <input type='radio' name='sort' value='name' class='form-val'
                       @if(isset($filter['sort']) && $filter['sort'] =='name') checked @endif> Tên
                <input type='radio' name='sort' value='updated_at' class='form-val'
                       @if(empty($filter['sort']) || $filter['sort'] =='updated_at') checked @endif> Ngày cập nhật
            </div>
            <hr>
            <div>
                <input type='radio' name='type' value='asc' class='form-val'
                       @if(isset($filter['type']) && $filter['type'] =='asc') checked @endif> Tăng dần
                <input type='radio' name='type' value='desc' class='form-val'
                       @if(empty($filter['type']) || $filter['type'] =='desc') checked @endif> Giảm dần
            </div>
        </div>
    </form>
</div>
