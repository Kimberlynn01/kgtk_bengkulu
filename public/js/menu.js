let container = $('.nav-menu');
$(() => {
    if (sessionStorage.getItem('menu_data') !== null && sessionStorage.getItem('base_url') === BASE_URL && sessionStorage.getItem('role_name') === ROLE_NAME) {
        let data = JSON.parse(sessionStorage.getItem('menu_data'));

        generate(data);


    } else {
        loadMenu();
    }

    setTimeout(() => {
        setMenuActive();
    }, 300);
})
const loadMenu = async () => {
    $.get(BASE_URL + 'menus').done(({ data }) => {

        generate(data);

        sessionStorage.setItem('menu_data', JSON.stringify(data));
        sessionStorage.setItem('base_url', BASE_URL);
        sessionStorage.setItem('role_name', ROLE_NAME);


    }).fail((res) => {
        showErrorToastr('Oops', 'Terjadi kesalahaan saat mengakses daftar menu!');
    })
}

const generate = (data) => {
    container.empty();
    container.append(`
        <li class="back-btn">
            <div class="mobile-back text-end">
                <span>Back</span>
                <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
            </div>
        </li>`);

    for (const group of data) {
        let { name, menus } = group;

        container.append(` <li class="sidebar-main-title">
                                    <div>
                                        <h6>${name} </h6>
                                    </div>
                                </li>`);
        generateMenu(menus, container);
    }

    $(".toggle-nav").click(function () {
        $('.nav-menu').css("left", "0px");
    });
    $(".mobile-back").click(function () {
        $('.nav-menu').css("left", "-410px");
    });

    $(".page-wrapper").attr("class", "page-wrapper " + localStorage.getItem("page-wrapper"));
    $(".page-body-wrapper").attr("class", "page-body-wrapper " + localStorage.getItem("page-body-wrapper"));

    if (localStorage.getItem("page-wrapper") === null) {
        $(".page-wrapper").addClass("compact-wrapper");
    }

    // left sidebar and horizotal menu
    if ($('#pageWrapper').hasClass('compact-wrapper')) {
        jQuery('.submenu-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.submenu-title').click(function () {
            jQuery('.submenu-title').removeClass('active');
            jQuery('.submenu-title').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.submenu-content').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                jQuery(this).addClass('active');
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                jQuery(this).next().slideDown('normal');
            } else {
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            }
        });
        jQuery('.submenu-content').hide();

        jQuery('.menu-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.menu-title').click(function () {
            jQuery('.menu-title').removeClass('active');
            jQuery('.menu-title').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.menu-content').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                jQuery(this).addClass('active');
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                jQuery(this).next().slideDown('normal');
            } else {
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            }
        });
        jQuery('.menu-content').hide();
    } else if ($('#pageWrapper').hasClass('horizontal-wrapper')) {
        var contentwidth = jQuery(window).width();
        if ((contentwidth) < '992') {
            $('#pageWrapper').removeClass('horizontal-wrapper').addClass('compact-wrapper');
            $('.page-body-wrapper').removeClass('horizontal-menu').addClass('sidebar-icon');
            jQuery('.submenu-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.submenu-title').click(function () {
                jQuery('.submenu-title').removeClass('active');
                jQuery('.submenu-title').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
                jQuery('.submenu-content').slideUp('normal');
                if (jQuery(this).next().is(':hidden') == true) {
                    jQuery(this).addClass('active');
                    jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                    jQuery(this).next().slideDown('normal');
                } else {
                    jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
                }
            });
            jQuery('.submenu-content').hide();

            jQuery('.menu-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.menu-title').click(function () {
                jQuery('.menu-title').removeClass('active');
                jQuery('.menu-title').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
                jQuery('.menu-content').slideUp('normal');
                if (jQuery(this).next().is(':hidden') == true) {
                    jQuery(this).addClass('active');
                    jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                    jQuery(this).next().slideDown('normal');
                } else {
                    jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
                }
            });
            jQuery('.menu-content').hide();
        }
    }

    // toggle sidebar


    $('.toggle-sidebar').click(function () {
        $('.main-nav').toggleClass('close_icon');
        $('.page-main-header').toggleClass('close_icon');
    });



    //responsive sidebar
    var $window = $(window);
    var widthwindow = $window.width();
    (function ($) {
        "use strict";
        if (widthwindow + 17 <= 993) {
            $('.toggle-sidebar').attr('checked', false);
            $('.main-nav').addClass("close_icon");
            $('.page-main-header').addClass("close_icon");
        }
    })(jQuery);


    $(window).resize(function () {
        var widthwindaw = $window.width();

        if (widthwindaw + 17 <= 991) {
            $('.toggle-sidebar').attr('checked', false);
            $('.main-nav').addClass("close_icon");
            $('.page-main-header').addClass("close_icon");
        } else {
            $('.toggle-sidebar').attr('checked', false);
            $('.main-nav').removeClass("close_icon");
            $('.page-main-header').removeClass("close_icon");
        }

        if (widthwindow >= 768) {
            $('.toggle-sidebar').click(function () {
                $('.main-nav').toggleClass('close_icon');
                $('.page-main-header').toggleClass('close_icon');
            });
        }
    });

    // horizontal arrowss
    var view = $("#mainnav");
    var move = "500px";
    var leftsideLimit = -500


    // get wrapper width
    var getMenuWrapperSize = function () {
        return $('.sidebar-wrapper').innerWidth();
    }
    var menuWrapperSize = getMenuWrapperSize();

    if ((menuWrapperSize) >= '1660') {
        var sliderLimit = -3000

    } else if ((menuWrapperSize) >= '1440') {
        var sliderLimit = -3600
    } else {
        var sliderLimit = -4200
    }

    $("#left-arrow").addClass("disabled");
    $("#right-arrow").click(function () {
        var currentPosition = parseInt(view.css("marginLeft"));
        if (currentPosition >= sliderLimit) {
            $("#left-arrow").removeClass("disabled");
            view.stop(false, true).animate({
                marginLeft: "-=" + move
            }, {
                duration: 400
            })
            if (currentPosition == sliderLimit) {
                $(this).addClass("disabled");
                console.log("sliderLimit", sliderLimit);
            }
        }
    });

    $("#left-arrow").click(function () {
        var currentPosition = parseInt(view.css("marginLeft"));
        if (currentPosition < 0) {
            view.stop(false, true).animate({
                marginLeft: "+=" + move
            }, {
                duration: 400
            })
            $("#right-arrow").removeClass("disabled");
            $("#left-arrow").removeClass("disabled");
            if (currentPosition >= leftsideLimit) {
                $(this).addClass("disabled");
            }
        }

    });

    // page active
    $(".main-navbar").find("a").removeClass("active");
    $(".main-navbar").find("li").removeClass("active");

    var current = window.location.pathname
    $(".main-navbar ul>li a").filter(function () {

        var link = $(this).attr("href");
        if (link) {
            if (current.indexOf(link) != -1) {
                $(this).parents().children('a').addClass('active');
                $(this).parents().parents().children('ul').css('display', 'block');
                $(this).addClass('active');
                $(this).parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                $(this).parent().parent().parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                return false;
            }
        }
    });

    // $('.custom-scrollbar').animate({
    //     scrollTop: $('a.nav-link.menu-title.active').offset().top - 500
    // }, 1000);
}

const generateMenu = (data, container) => {
    for (const menu of data) {
        let { name, link: route, icon, childs, slug_name } = menu;


        if (childs.length > 0) {
            let childData = generateSubMenu(childs, slug_name)

            let li = $('<li>', {
                class: 'dropdown',
                html: [$('<a>', {
                    id: 'menu-' + slug_name,
                    class: 'nav-link menu-title' + (ACTIVE_SLUG == slug_name ? ' active' : ''),
                    href: route == null ? 'javascript:void(0)' : BASE_URL + route,
                    html: `<i class="${icon}"></i> <span>${name}</span>`
                }),
                    childData
                ]
            });

            container.append(li.prop('outerHTML'));

        } else {
            let li = $('<li>', {
                class: "dropdown",
                html: $('<a>', {
                    id: 'menu-' + slug_name,
                    class: 'nav-link menu-title link-nav ' + (ACTIVE_SLUG == slug_name ? 'active' : ''),
                    href: BASE_URL + route,
                    html: `<i class="${icon}"></i> <span>${name}</span>`
                })
            })

            container.append(li.prop('outerHTML'));
        }
    }

}
const generateSubMenu = (data, parent_slug_name) => {
    return $('<ul>', {
        class: 'nav-submenu menu-content',
        html: () => {
            let lis = '';
            for (const { name, link, slug_name } of data) {
                lis += (`<li><a id="menu-${slug_name}" href="${BASE_URL + link}" ${(ACTIVE_SLUG == parent_slug_name) ? 'class="active"' : ''}>${name}</a></li>`);
            }

            return lis;
        }
    }).prop('outerHTML');
}

const setMenuActive = () => {
    let currentSlug = ACTIVE_SLUG;
    $('#menu-' + currentSlug).addClass('active');
}