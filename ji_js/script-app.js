$(document).ready(function () {
    $('table.navbar tr.button td.notspace').hover(function () {
        $(this).css('cursor', 'pointer');
        if ($(this).attr('class') != 'notspace current') {
            $(this).css({'backgroundColor': 'rgb(245,245,245)','transition': '0.5s all'});
            var $num = $(this).attr('id')[7];
            var $stripid = '#strip-' + $num;
            $($stripid).css({'backgroundColor': 'rgb(255,205,0)','transition': '0.5s all'});
        }
    }, function () {
        $(this).css('cursor', 'default');
        if ($(this).attr('class') != 'notspace current') {
            $(this).css('backgroundColor', 'white');
            var $num = $(this).attr('id')[7];
            var $stripid = '#strip-' + $num;
            $($stripid).css('backgroundColor', 'rgb(245,245,245)');
        }
    });
    $('table.navbar tr.button td.notspace').click(function (event) {
        event.preventDefault();
        location.href = $(this).find('a').attr('href');
    });

    $('#personal-information').hide();

    $('#plus').hover(function () {
        $(this).css('cursor', 'pointer');
    }, function () {
        $(this).css('cursor', 'default');
    });

    $('#plus').click(function () {
        $('#personal-information').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        if ($(this).attr('src') == 'images/plus.png') {
            $(this).attr('src', 'images/minus.png')
        }
        else {
            $(this).attr('src', 'images/plus.png')
        }
    });
});