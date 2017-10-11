$(document).ready(function () {
    $(window).scroll(function(){
        if($(this).scrollTop()>150){
            $("#up_to_top").show();
            $(".header-bottom").addClass('fixNav')
        }else{
            $(".header-bottom").removeClass('fixNav')
            $("#up_to_top").hide();
        }}
    );

    $("#up_to_top").click(function(){
        $("html,body").animate({
            scrollTop:0
        },777);
    });

    $('#btn-filter-prd').click(function () {
        $('#filter').slideToggle('slow');
    });

    $('.filter-frm').change(function () {
        var input = $(this).find('.form-val');
        var data = new FormData();

        for (var i = 0; i < input.length; i++) {
            if ($(input[i]).attr("type") == 'radio' || $(input[i]).attr("type") == 'checkbox') {
                if ($(input[i]).is(':checked')) {
                    data.append($(input[i]).attr("name"), $(input[i]).val());
                }
            }
            else {
                data.append($(input[i]).attr("name"), $(input[i]).val());
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'loc-san-pham',
            type: 'post',
            contentType: false,
            processData: false,
            cache: false,
            data: data,
            success: function (responce) {
                $('#list-product').html(responce);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    inputNumber();
});

function inputNumber()
{
    $('.input-number').keypress(function (e) {
        var keyCode = (e.which) ? e.which : window.event.keyCode;

        if(keyCode < 48 || keyCode > 57) {
            if(keyCode == 48 || keyCode == 8) {
                return ;
            }
            return false;
        }
    });

    $('.input-number').change(function () {
        var value = parseInt($(this).val());
        var max = parseInt($(this).attr('maxval'));
        if(value > max) {
            $(this).val(max);
        }
        else if (value < 1) {
            $(this).val(1);
        }
    });
}