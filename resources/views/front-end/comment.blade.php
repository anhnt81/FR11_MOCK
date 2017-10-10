{{--<div class='container'>--}}
<div style='margin-top: 50px'>
    <button class='btn btn-primary' id='click-rate'>Ẩn\Hiện khung đánh giá</button>
    <div id='rate-frm' class='panel panel-default'>
        <div class='panel-heading'>
            <h6>Đánh giá & nhận xét cho sản phẩm : {{$product->name}}</h6>
        </div>
        <div class='panel-body'>
            <form role='form'>
                <!-- rating start -->
                <div class='form-group'>
                    <label for='rating'>Đánh giá của bạn:</label>
                    <div id="myrate" class='rating rating-big' rate='{{$rate['myrate']}}'></div>
                </div>

                <div class='form-group'>
                    <label for='cmt-content'>Nhận xét của bạn :</label>
                    <textarea name='content' rows='5' id='cmt-content' class='form-control'>{{$rate['mycmt']}}</textarea>
                </div>
                <div class='form-group' style='text-align: right'>
                    <input type='hidden' name='rate' id='inp-rate'>
                    <input type='hidden' name='pid' id='inp-pid' value='{{$product->id}}'>
                    <input type='hidden' name='uid' id='inp-uid' value='@if(Auth::check()) {{Auth::user()->id}} @endif'>
                    <button type='button' id='btn-rate' class='btn btn-warning'>Gửi đánh giá</button>
                </div>
            </form>
        </div>
    </div>
    <div id='list-cmt'>
        @include('front-end.cmd-detail')
    </div>
</div>
{{--</div>--}}
<div id='call-login-modal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>

            <div class='modal-body alert-warning'>
                Hãy đăng nhập hoặc đăng ký để đánh giá sản phẩm này!!
            </div>
            <div class='modal-footer'>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $('#btn-rate').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'addcmt',
                type: 'post',
                data: {
                    pid: $('#inp-pid').val(),
                    uid: $('#inp-uid').val(),
                    rate: $('#inp-rate').val(),
                    content: $('#cmt-content').val()
                },
                success: function (responce) {
                    $('#rate-frm').slideUp('fast');
                    $('#list-cmt').html(responce);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });
        $('#click-rate').click(function () {
            @if(Auth::check())
            $('#rate-frm').slideToggle();
            @else
            $('#call-login-modal').modal('show');
            @endif
        });
        $("#myrate").starrr({
            rating : $('#myrate').attr('rate'),
            change: function (e, value) {
                $('#inp-rate').val(value);
                console.log($(this).attr('rate'));
            }
        });

        var rateCmt = $('.rate-cmt');
        var rate;
        for (var i = 0; i < rateCmt.length; i++) {
            rate = $(rateCmt[i]).attr('rate');
            $(rateCmt[i]).starrr({
                rating: rate,
                readOnly: true
            });
        }

        $('.rating a').removeAttr('href');
    })
</script>