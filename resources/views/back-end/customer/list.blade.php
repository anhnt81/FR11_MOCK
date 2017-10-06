<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giới tính</th>
        <th>Số điện thoại</th>
        <th>E-mail</th>
        <th>Địa chỉ giao hàng</th>
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
                <td>{!! $row->name !!}</td>
                <td>
                    @if($row->gender == 1) Nam
                    @elseif($row->gender == 2) Nữ
                    @else Khác
                    @endif
                </td>
                <td>{!! $row->phone !!}</td>
                <td>{!! $row->email !!}</td>
                <td>{!! $row->address !!}</td>
                <td>
                    <a href="{!! url('admin/customer/sua-thong-tin/'.$row->id) !!}"
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
<div style='padding: 0 40px;'>
    @if($total > 0)
        <div style='float:left;'>
            Hiển thị : {{ $start }} <span class='glyphicon glyphicon-arrow-right'></span> {{ $end }}
            Trong {{ $total }} Khách hàng.
        </div>
    @endif
    {!! $list->links() !!}
</div>