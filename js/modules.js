$("#menu_home").click(function () {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#top").offset().top
    }, 2000);
});

$("#menu_pm").click(function () {
    $('#menu_pm').addClass('clicked');
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#scroll_pm").offset().top
    }, 2000);
});

$("#menu_cloud").click(function () {
    $('#menu_cloud').addClass('clicked');
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#scroll_cloud").offset().top
    }, 2000);
});

$("#menu_mail").click(function () {
    $('#menu_mail').addClass('clicked');
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#scroll_mail").offset().top
    }, 2000);
});

document.addEventListener("scroll", function () {

    if (window.pageYOffset > 600 && $('#menu_pm').hasClass('clicked')) {
        document.getElementById('management').style.display = "block";
    }  else {
        document.getElementById('management').style.display = "none";
    } if (window.pageYOffset > 1700 && $('#menu_cloud').hasClass('clicked')) {
        document.getElementById('ownCloud').style.display = "block";
    } else {
        document.getElementById('ownCloud').style.display = "none";
    }
    if (window.pageYOffset > 2800 && $('#menu_mail').hasClass('clicked')) {
        document.getElementById('mail').style.display = "block";
    } else {
        document.getElementById('mail').style.display = "none";
    }
    
});
