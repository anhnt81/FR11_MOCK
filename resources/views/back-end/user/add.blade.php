@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý người dùng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/user') !!}">Người dùng</a></li>
    <li>Thêm mới</li>
@endsection

@section('content')
    <!-- main content -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm người dùng</h3>
        </div>
        <div class="panel-body">
            <form method="post" role="form" id='addUserFrm'>
                {{ csrf_field() }}
                <div class="form-group">
                    @if($errors->has('email'))
                        <div class='alert alert-danger'>{{ $errors->first('email') }}</div>
                    @endif
                    <label for="email">E-mail (<span class='required'>*</span>) </label>
                    <input id="email" name="email" class="form-control" type="email"
                           value="{!!old('email')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('name'))
                        <div class='alert alert-danger'>{{ $errors->first('name') }}</div>
                    @endif
                    <label for="name">Tên</label>
                    <input id="name" name="name" class="form-control" type="text"
                           value="{!!old('name')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('pass'))
                        <div class='alert alert-danger'>{{ $errors->first('pass') }}</div>
                    @endif
                    <label for="pass">Mật khẩu (<span class='required'>*</span>) </label>
                    <input id="pass" name="pass" class="form-control" type="password"
                           value="{!!old('pass')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('repass'))
                        <div class='alert alert-danger'>{{ $errors->first('repass') }}</div>
                    @endif
                    <label for="repass">Nhập lại Mật khẩu (<span class='required'>*</span>) </label>
                    <input id="repass" name="repass" class="form-control" type="password"
                           value="{!!old('repass')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('phone'))
                        <div class='alert alert-danger'>{{ $errors->first('phone') }}</div>
                    @endif
                    <label for="phone">Số điện thoại (<span class='required'>*</span>) </label>
                    <input id="phone" name="phone" class="form-control" type="text"
                           value="{!!old('phone')!!}">
                </div>

                @if(Auth::User()->level == 1)
                    <div class="form-group">
                        <label for="level">Loại thành viên</label>
                        <select name='level' id='level' class='form-control'>
                            @foreach($level as $key => $value)
                                @if(Auth::User()->level < $key)
                                <option value='{!!$key!!}' @if(old('level') == $key) selected @endif>
                                    {!! $value !!}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <button type='submit' class="btn btn-primary">Tạo mới</button>
                    <a href="{!! url('admin/user') !!}" class="btn btn-default">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>

    <!-- validate form -->
    <script>
        $(document).ready(function () {
            $('#addUserFrm').submit(function () {
                $('.err').remove();

                var phone = $('#phone').val();
                var email = $('#email').val();
                var pass = $('#pass').val();
                var repass = $('#repass').val();
                var err = 0;

                if(pass.length < 8 || pass.length > 16) {
                    $('#pass').before("<div class='alert alert-danger err'>Mật khẩu phải chứa từ 8 - 16 ký tự</div>");
                    err = 1;
                }
                if(!/(^01[0-9]{9}$)|(^0(9|8)[0-9]{8}$)/.test(phone)) {
                    $('#phone').before("<div class='alert alert-danger err'>Số điện thoại không hợp lệ</div>");
                    err = 1;
                }
                if(repass != pass) {
                    $('#repass').before("<div class='alert alert-danger err'>Mật khẩu nhập lại không khớp</div>");
                    err = 1;
                }
                if(!/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(email)) {
                    $('#email').before("<div class='alert alert-danger err'>Email không hợp lệ</div>");
                    err = 1;
                }

                if(err == 0) {
                    return true;
                }

                return false;
            });
        });
    </script>
@endsection
