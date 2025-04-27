function setActiveHoriSelector() {
    var tabsNewAnim = $('#navbarSupportedContent');
    var activeItemNewAnim = tabsNewAnim.find('.active');
    var horiSelector = $(".hori-selector");

    if (activeItemNewAnim.length) {
        var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
        var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
        var itemPosNewAnimTop = activeItemNewAnim.position().top;
        var itemPosNewAnimLeft = activeItemNewAnim.position().left;

        horiSelector.css({
            top: itemPosNewAnimTop + "px",
            left: itemPosNewAnimLeft + "px",
            height: activeWidthNewAnimHeight + "px",
            width: activeWidthNewAnimWidth + "px"
        });
    }
}

$(document).ready(function () {
    setTimeout(setActiveHoriSelector, 100); // Ensure DOM is fully rendered

    // Activate tab click behavior
    $("#navbarSupportedContent").on("click", "li", function (e) {
        $('#navbarSupportedContent ul li').removeClass("active");
        $(this).addClass('active');
        setActiveHoriSelector();
    });

    // Navbar color change on scroll
    const navbar = document.querySelector('.navbar-mainbg');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Add active class based on current page
    var path = window.location.pathname.split("/").pop();

    // Account for home page with empty path
    if (path == '') {
        path = 'dashboard';
    }

    var target = $('#navbarSupportedContent ul li a[href="' + path + '"]');
    target.parent().addClass('active');
});

$(window).on('resize', function () {
    setTimeout(setActiveHoriSelector, 500);
});

$(".navbar-toggler").click(function () {
    $(".navbar-collapse").slideToggle(300);
    setTimeout(setActiveHoriSelector);
});

// Optional: You can use this if you want more precise control
// $(window).on('load',function () {
//     var current = location.pathname;
//     console.log(current);
//     $('#navbarSupportedContent ul li a').each(function(){
//         var $this = $(this);
//         if($this.attr('href').indexOf(current) !== -1){
//             $this.parent().addClass('active');
//             $this.parents('.menu-submenu').addClass('show-dropdown');
//             $this.parents('.menu-submenu').parent().addClass('active');
//         }else{
//             $this.parent().removeClass('active');
//         }
//     })
// });
