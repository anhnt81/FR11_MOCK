$(document).ready(function () {
    var url = $(location).attr('href');
    var ctr = url.split('/');

    if(ctr.length < 5)
    {
        ctr[4] = 'home';
    }
    setCss();
    hoverDropdown(ctr[4]);
    navActive('#' + ctr[4]);

    remove(ctr[4]);
})


/*
 * Setting css for the nav-bar
 */
function setCss()
{
    var heightHeader = 0;

    if($(window).width() < 768){
        $('#nav-home').css('position', 'static');
        $('#nav-home').css('top', 0);
        $('#nav-home').css('padding', '20px');
        $('#nav-home').css('margin', '0 20px');
        $('#content article').css('padding', '0 20px');
        $('#title-site').css('font-size', '1.5em');
    }
    else{
        $('#title-site').css('font-size', '2.4em');

        $('#nav-home').css('display', 'block');
        $('#nav-home').css('position', 'fixed');
        heightHeader = $("header.nav").height();
        $("#nav-home").css("top", heightHeader);

    }

    heightHeader = $("header.nav").height();

    $("body").css("padding-top", heightHeader);
}

function hoverDropdown(ctr)
{
    var parentID;

    $(".dropdown").mouseover(function () {
        parentID = $(this).attr("id");
        if(ctr != parentID)
        {
            $(this).addClass("open");
        }
    });
    $(".dropdown").mouseout(function () {
        parentID = $(this).attr("id");
        if(ctr != parentID)
        {
            $(this).removeClass("open");
        }
    });
}

function navActive(id)
{
    $("#nav-home > ul > li.active").removeClass("active");
    $(id).addClass("active");
    $(id).addClass("open");
}

function previewImage(input, id)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#" + id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function remove(ctr) {
    $('.btn-del').click(function () {
        $('#del-id').val($(this).attr('frm-id'));
        $('#del-id').parent().attr('action', $(this).attr('link'));
        $('#remove-modal').modal('show');
    });
}