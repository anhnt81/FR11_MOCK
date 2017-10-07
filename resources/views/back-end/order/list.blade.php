<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Khách hàng</th>
        <th>Tổng tiền</th>
        <th>Ghi chú</th>
        <th>Tình trạng</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    @if(count($list) < 1)
        <tr>
            <td colspan="7">Chưa có dữ liệu</td>
        </tr>
    @else
        @foreach($list as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->customer->name !!}</td>
                <td>{!! $row->total !!}</td>
                <td>{!! $row->note !!}</td>
                <td>{!! $row->st !!}</td>
                <td>{!! $row->created_at !!}</td>
                <td>
                    <a href="{!! url('admin/order/chi-tiet/'.$row->id) !!}"
                       class="btn btn-default">
                        <span class="glyphicon glyphicon-eye-open"></span>
                        Xem chi tiết
                    </a>
                    <a href="{!! url('admin/order/sua-thong-tin/'.$row->id) !!}"
                       class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit"></span>
                        Sửa
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<!-- pagination -->
<hr>
<div style="text-align: center">
    @if($total > 0)
        <div style='float:left;'>
            Hiển thị : {{ $start }} <span class='glyphicon glyphicon-arrow-right'></span> {{ $end }}
            Trong {{ $total }} Người dùng.
        </div>
    @endif
    {!! $list->links() !!}
</div>