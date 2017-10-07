<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>Order</th>
        <th>Name</th>
        <th>Description</th>
        <th>Images</th>
        <th>Original</th>
        <th>Saled</th>
        <th>Promotion End</th>
        <th>Quantity</th>
        <th>Action</th>
        <th>Status</th>
        <td></td>
    </tr>
    </thead>
    <tbody>
    @if(count($products) < 1)

        <tr>
            <td colspan="7">Chưa có dữ liệu</td>
        </tr>
    @else
        <?php
        $page = app('request')->input('page');
        $i = 0;
        if($page > 1){
            $i = ($page - 1)*5;
        }
        ?>
        @foreach($products as $row)
            <tr>
                <td align="center">{{++$i}}</td>
                <td width="100px;">{!! $row->name !!}</td>
                <td width="300px;">{!! $row->description !!}</td>
                <td>
                    @foreach($images[$row->id] as $item)
                        <img style="max-height: 60px;max-width: 60px" src="{{asset('images/front-end/product/'.$item)}}" />
                    @endforeach
                </td>
                <td>{!! $row->unit_price !!}</td>
                <td>{!! $row->promotion_price !!}</td>
                @if(empty($row->datetime_promotion))
                    <td align="center">Not Sale</td>
                @else
                    <td align="center">{!! $row->datetime_promotion !!}</td>
                @endif
                <td align="center">{!! $row->qty !!}</td>
                @if($row->new == 0)
                    <td align="center">Old Product</td>
                @else
                    <td align="center">New Product</td>
                @endif
                @if($row->status == 0)
                    <td align="center">Not Active</td>
                @else
                    <td align="center">Active</td>
                @endif
                <td>
                    <a href="{!! url('admin/product/edit/'.$row->id) !!}"
                       class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit"></span>
                        Edit
                    </a>
                    <button type='button' class="btn btn-danger btn-del"
                            frm-id='{{$row->id}}' link='{!! url('admin/product/del/'.$row->id) !!}'>
                        <span class="glyphicon glyphicon-remove"></span>
                        Delete
                    </button>
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
            Trong {{ $total }} Sản phẩm.
        </div>
    @endif
    {!! $products->links() !!}
</div>