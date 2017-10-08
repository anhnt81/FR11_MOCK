<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @if(count($list) < 1)
        <tr>
            <td colspan="7">Chưa có dữ liệu</td>
        </tr>
    @else
        @foreach($list as $br)
            <tr>
                <td>{{$br->id}}</td>
                <td>{{$br->name}}</td>
                <td><a href="{{ url('admin/brand/editBrand/'.$br->id) }}" class="btn btn-warning">Edit</a></td>
                <td><a href="{{ url('admin/brand/deleteBrand/'.$br->id) }}" class="btn btn-danger">Delete</a></td>
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
            Trong {{ $total }} Thương hiệu.
        </div>
    @endif
    {!! $list->links() !!}
</div>