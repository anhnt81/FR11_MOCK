$(document).ready(function () {
    var ctr = getCtrName();

    setCss();

    hoverDropdown(ctr);

    navActive('#' + ctr);

    remove(ctr);

    eventsFilter(ctr);

    // $('.input-daterange input').each(function() {
    //     $(this).datepicker('clearDates');
    // });
    $(function () {
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd"
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        var dpk = $('.datepicker');
        $(dpk[0]).datepicker('setDate', '1990-01-01');
        $(dpk[1]).datepicker('setDate', getTomorowDate());
    });
})

/*
 * Get controller name from url
 * @return ctr : controller name
 */
function getCtrName()
{
    var url = $(location).attr('href');
    var ctr = url.split('/');

    if (ctr.length < 5) {
        ctr = 'home';
    }
    else {
        ctr = ctr[4];
        if (ctr.indexOf('?') != -1) {
            ctr = ctr.split('?');
            ctr = ctr[0];
        }
        else if (ctr.indexOf('#') != -1) {
            ctr = ctr.split('#');
            ctr = ctr[0];
        }
    }

    return ctr;
}

/*
 * Setting css for the nav-bar
 */
function setCss()
{
    var heightHeader = 0;

    if ($(window).width() < 768) {
        $('#nav-home').css('position', 'static');
        $('#nav-home').css('top', 0);
        $('#nav-home').css('padding', '20px');
        $('#nav-home').css('margin', '0 20px');
        $('#title-site').css('font-size', '1.5em');
    }
    else {
        $('#title-site').css('font-size', '2.4em');

        $('#nav-home').css('display', 'block');
        $('#nav-home').css('position', 'fixed');

        heightHeader = $("header.nav").height();
        $("#nav-home").css("top", heightHeader);

    }

    heightHeader = $("header.nav").height();

    $("body").css("padding-top", heightHeader);
}

/*
 * Event hover for dropdown menu
 * @param ctr : controller name
 * @return void
 */
function hoverDropdown(ctr)
{
    var parentID;

    $(".dropdown").mouseover(function () {
        parentID = $(this).attr("id");
        if (ctr != parentID) {
            $(this).addClass("open");
        }
    });
    $(".dropdown").mouseout(function () {
        parentID = $(this).attr("id");
        if (ctr != parentID) {
            $(this).removeClass("open");
        }
    });
}

/*
 * change active for header nav-bar
 * @param id
 * @return void
 */
function navActive(id)
{
    $("#nav-home > ul > li.active").removeClass("active");
    $(id).addClass("active");
    $(id).addClass("open");
}

function previewImage(input, id)
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#" + id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/*
 * show modal while click button delete
 * @param ctr : controller name
 * @return void
 */
function remove(ctr)
{
    $('.btn-del').click(function () {
        $('#del-id').val($(this).attr('frm-id'));
        $('#del-id').parent().attr('action', $(this).attr('link'));
        $('#remove-modal').modal('show');
    });
}

/*
 * Ajax filter
 * @param page : page number
 * @param link : url send request
 * @return void
 */
function ajaxFilter(page, ctr)
{
    var input = $(".form-val");

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

    //console.log(dt);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: ctr + '?page=' + page,
        type: 'post',
        contentType: false,
        processData: false,
        cache: false,
        data: data,
        success: function (responce) {
            //console.log(data);
            $('#list-data').html(responce);
            remove(ctr);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

/*
 * Events send ajax filter
 */
function eventsFilter(ctr)
{
    $('#btn-filter').click(function () {
        ajaxFilter(1, ctr);
    });

    $('#per').change(function () {
        ajaxFilter(1, ctr);
    });

    $(window).on('hashchange', function () {
        page = window.location.hash.replace('#', '');
        ajaxFilter(page, ctr);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        //ajaxPaginate(page, ctr);
        location.hash = page;
    });
}

/*
 * @return date : date of tomorow
 */
function getTomorowDate()
{
    var date = new Date();
    var dd = date.getDate()+1;
    var mm = date.getMonth()+1;
    var yyyy = date.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    date = yyyy + '-' + mm + '-' + dd;

    return date;
}

function setChart(colume, value)
{
    var lineChartData = {
        labels: colume,
        datasets: [
            {
                label: "7 days dataset",
                fillColor: "rgba(48, 164, 255, 0.2)",
                strokeColor: "rgba(48, 164, 255, 1)",
                pointColor: "rgba(48, 164, 255, 1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(48, 164, 255, 1)",
                data: value
            }
        ]

    }

    var chart = document.getElementById("week-chart").getContext("2d");
    new Chart(chart).Line(lineChartData, {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc"
    });
}