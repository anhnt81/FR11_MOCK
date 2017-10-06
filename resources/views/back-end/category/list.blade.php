<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Chuyên mục cha</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    @if(count($list) < 1)
        <tr>
            <td colspan="4">Chưa có dữ liệu</td>
        </tr>
    @else
        @foreach($list as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->name !!}</td>
                <td>@if(!empty($row->child->name)) {!! $row->child->name !!} @endif</td>
                <td>
                    <a href="{!! url('admin/category/sua-thong-tin/'.$row->id) !!}"
                       class="btn btn-warning" style='margin-right:10px;float:left;'>
                        <span class="glyphicon glyphicon-edit"></span>
                        Sửa
                    </a>
                    <button type='button' class="btn btn-danger btn-del"
                            frm-id='{{$row->id}}' link='{!! url('admin/category/xoa') !!}'>
                        <span class="glyphicon glyphicon-remove"></span>
                        Xóa
                    </button>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<!-- pagination -->
<hr>
<div style='padding: 0 40px;'>
    @if($total > 0)
        <div style='float:left;'>
            Hiển thị : {{ $start }} <span class='glyphicon glyphicon-arrow-right'></span> {{ $end }}
            Trong {{ $total }} Chuyên mục.
        </div>
    @endif
    {!! $list->links() !!}
</div>