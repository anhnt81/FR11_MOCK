<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Người đăng</th>
        <th>Sản phẩm</th>
        <th>Nội dung</th>
        <th>Tình trạng</th>
        <th>Ngày đăng</th>
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
                <td>{!! $row->user->name !!}</td>
                <td>{!! $row->product->name !!}</td>
                <td>{!! $row->content !!}</td>
                <td>@if($row->status == 0) Khóa @else Hiển thị @endif</td>
                <td>{!! $row->created_at !!}</td>
                <td>
                    <a href="{!! url('admin/comment/sua-thong-tin/'.$row->id) !!}"
                       class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit"></span>
                        @if($row->status == 0) Mở @else Khóa @endif
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
            Trong {{ $total }} Bình luận.
        </div>
    @endif
    {!! $list->links() !!}
</div>