<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Avatar</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Ngày tạo</th>
        <th>Chức vụ</th>
        <th>Trạng thái</th>
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
                <td><img src='{!! asset('uploads/images/' . $row->avatar) !!}' class='img-ava'>
                </td>
                <td>{!! $row->email !!}</td>
                <td>{!! $row->phone !!}</td>
                <td>{!! $row->created_at !!}</td>
                <td>{!! $row->slevel !!}</td>
                <td>@if($row->status == 1) Hoạt động @else Khóa @endif</td>
                <td>
                    @if(Auth::guard('admin')->User()->level < $row->level || Auth::guard('admin')->User()->id == $row->id)
                        <a href="{!! url('admin/user/sua-thong-tin/'.$row->id) !!}"
                           class="btn btn-warning">
                            <span class="glyphicon glyphicon-edit"></span>
                            Sửa
                        </a>
                        @if($row->level != 1)
                            <button type='button' class="btn btn-danger btn-del"
                                    frm-id='{{$row->id}}' link='{!! url('admin/user/xoa') !!}'>
                                <span class="glyphicon glyphicon-remove"></span>
                                Xóa
                            </button>
                        @endif
                    @endif
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
            Trong {{ $total }} Người dùng.
        </div>
    @endif
    {!! $list->links() !!}
</div>