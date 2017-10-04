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
                    <a href="index.html">Home</a> / <span>Liên Hệ</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="beta-map">

        <div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14910.775279518912!2d105.74049561749385!3d20.884387825284175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31344d1b7a8c9b77%3A0x63f7c3538e53c269!2zVGhhbmggQ2FvLCBUaGFuaCBPYWksIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1501235651768" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">

            <div class="space50">&nbsp;</div>
            <div class="row">
                <div class="col-sm-8">
                    <h2>Contact Form</h2>
                    <div class="space20">&nbsp;</div>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit ani m id est laborum.</p>
                    <div class="space20">&nbsp;</div>
                    <form action="#" method="post" class="contact-form">
                        <div class="form-block">
                            <input name="your-name" type="text" placeholder="Your Name (required)">
                        </div>
                        <div class="form-block">
                            <input name="your-email" type="email" placeholder="Your Email (required)">
                        </div>
                        <div class="form-block">
                            <input name="your-subject" type="text" placeholder="Subject">
                        </div>
                        <div class="form-block">
                            <textarea name="your-message" placeholder="Your Message"></textarea>
                        </div>
                        <div class="form-block">
                            <button type="submit" class="beta-btn primary">Send Message <i class="fa fa-chevron-right"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <h2>Contact Information</h2>
                    <div class="space20">&nbsp;</div>

                    <h6 class="contact-title">Address</h6>
                    <p>
                        Suite 127 / 267 – 277 Brussel St,<br>
                        62 Croydon, NYC <br>
                        Newyork
                    </p>
                    <div class="space20">&nbsp;</div>
                    <h6 class="contact-title">Business Enquiries</h6>
                    <p>
                        Doloremque laudantium, totam rem aperiam, <br>
                        inventore veritatio beatae. <br>
                        <a href="mailto:biz@betadesign.com">biz@betadesign.com</a>
                    </p>
                    <div class="space20">&nbsp;</div>
                    <h6 class="contact-title">Employment</h6>
                    <p>
                        We’re always looking for talented persons to <br>
                        join our team. <br>
                        <a href="hr@betadesign.com">hr@betadesign.com</a>
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
                        <div class="fb-page" data-href="https://www.facebook.com/neuduocsongthemlannuatoivanseyeuarsenal/" data-tabs="timeline" data-width="350" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/neuduocsongthemlannuatoivanseyeuarsenal/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/neuduocsongthemlannuatoivanseyeuarsenal/">Nếu Được Sống Thêm Lần Nữa Tôi Vẫn Sẽ Yêu Arsenal</a></blockquote></div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- #content -->
    </div> <!-- .container -->
@endsection