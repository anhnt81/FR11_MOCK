@extends('front-end.layouts.master')

@section('title')
    Liên hệ
@endsection
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Liên Hệ</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('homePage')}}">Home</a> / <span>Liên Hệ</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="beta-map">

        <div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3405635357103!2d105.81493231430795!3d21.0190549934869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab64d4099b05%3A0x66ec5668d059e5ff!2sSmartOSC+E-commerce+Agency!5e0!3m2!1svi!2s!4v1507625466804" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">

            <div class="space50">&nbsp;</div>
            <div class="row">
                <div class="col-sm-8">
                    <h2>Contact Form</h2>
                    <div class="space20">&nbsp;</div>
                    <p>SmartOSC Ltd là một trong những công ty đi đầu về lĩnh vực thương mại điện tử ở Việt Nam, với hơn 5 năm kinh nghiệm làm việc với các đối tác nước ngoài về thương mại điện tử. Tại SmartOSC, chúng tôi luôn chú trọng phát triển một môi trường làm việc thoải mái, thúc đẩy tính sáng tạo và cống hiến.</p>
                    <div class="space20">&nbsp;</div>
                    <form action="{{route('post-contact')}}" method="post" class="contact-form" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-block">
                            <input name="name" type="text" placeholder="Your Name (required)">
                        </div>
                        <div class="form-block">
                            <input name="email" type="email" placeholder="Your Email (required)">
                        </div>
                        <div class="form-block">
                            <input name="telephone" type="text" placeholder="Số điện thoại">
                        </div>
                        <div class="form-block">
                            <textarea name="message" placeholder="Your Message"></textarea>
                        </div>
                        <div class="form-block">
                            <button type="submit" class="beta-btn primary">Send Message <i class="fa fa-chevron-right"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <h2>Contact Information</h2>
                    <div class="space20">&nbsp;</div>

                    <h6 class="contact-title">Address</h6></br>
                    <p>
                        SmartOSC - A Smart Open Solution Company
                        Tầng 18, Tóa nhà Handico, Mễ Trì, Hà Nội, Phone: +84988886789
                    </p>
                    <div class="widget">
                        <h3>Follow</h3>
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-page" data-href="https://www.facebook.com/SmartOSC/?ref=br_rs" data-tabs="timeline" data-width="350" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/neuduocsongthemlannuatoivanseyeuarsenal/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/neuduocsongthemlannuatoivanseyeuarsenal/">Nếu Được Sống Thêm Lần Nữa Tôi Vẫn Sẽ Yêu Arsenal</a></blockquote></div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- #content -->
    </div> <!-- .container -->
    <div id='contact-modal' class='modal fade' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-body alert-success'>
                    Cảm ơn bạn đã ghé thăm cửa hàng. Chúng tôi sẽ liên hệ với bạn vào thời gian sớm nhất !
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

 
@endsection