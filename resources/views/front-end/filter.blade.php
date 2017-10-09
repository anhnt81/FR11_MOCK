<div style='text-align: right'>
    <button class='btn btn-primary' id='btn-filter-prd'><span class='glyphicon glyphicon-filter'></span> &nbsp; Lọc sản phẩm</button>
</div>
<div id='filter' style='display: none'>
    <form role='form' class='filter-frm'>
        <div class='form-group'>
            <label>Thương hiệu</label>
            <div>
                <input type='radio' name='brand' value='0' class='form-val'> Tất cả
                @foreach($listBr as $item)
                    <input type='radio' name='brand' value='{{$item->id}}'> {{$item->name}}
                @endforeach
            </div>
        </div>
        <hr>
        <div class='form-group'>
            <label>Giá</label>
            <div class='form-control-static'>
                <input class='form-control form-val' type='number' name='from'
                       placeholder='000000000 VNĐ' style='width:45%;float: left;'>
                <div style='width:10%;text-align: center;float:left;'> - </div>
                <input class='form-control form-val' type='number' name='to'
                       placeholder='000000000 VNĐ' style='width:45%; float: right'>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#btn-filter-prd').click(function () {
            $('#filter').slideToggle('slow');
        });
    })
</script>