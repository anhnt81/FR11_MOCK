<html>
<head>
    <style>
        #header_pi{
            text-align: center;
            color: #00a651;
            margin-top: 20px;
        }
        body{
            margin: 0 auto;
            background-color: #f8f8f8;
        }
        #info{
            margin-left: 50px;
        }
    </style>
</head>
<body id="contactPen">
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-10" id="header_pi">
                <h1>Fresh Garden</h1></br>
            </div>
            <div class="col-md-1">

            </div>
            <div class="login-panel panel panel-default" style="text-align: center">
                <div class="panel-heading" style="padding: 10px 15px;background-color: #f5f5f5;" id="title_login">
                    <h3 class="panel-title">Thông Tin Cá Nhân Khách Hàng</h3>
                </div>
            </div>
            <div id="info">
                <h4>Tên khách hàng : {{ $list['name'] }} </h4>
                @if($list['gender'] == 1)
                <h4>Giới tính : Nam </h4>
                @else
                <h4>Giới tính : Nữ </h4>
                @endif
                <h4>Email khách hàng : {{ $list['email'] }}</h4>
                <h4>Địa chỉ khách hàng : {{ $list['address'] }}</h4>
                <h4>SĐT khách hàng : {{ $list['phone'] }}</h4>
                <h4>Tin nhắn : {{ $list['note'] }}</h4>
            </div>


        </div>

    </div>
</header>
</body>
</html>