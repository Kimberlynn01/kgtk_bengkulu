let container = $('.nav-menu');
$(() => {
    if (sessionStorage.getItem('menu_data') !== null && sessionStorage.getItem('base_url') === BASE_URL && sessionStorage.getItem('role_name') === ROLE_NAME) {
        let data = JSON.parse(sessionStorage.getItem('menu_data'));

        generate(data);


    } else {
        loadMenu();
    }
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
    container.append(`<li class="back-btn">
    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
</li>`);

    for (const group of data) {
        let { name, menus } = group;

        container.append(` <li class="sidebar-main-title">
                                    <div>
                                        <h6>${name} </h6>
                                    </div>
                                </li>`);
        generateMenu(menus, container, true);
    }
}

const generateMenu = (data, container, is_parent = true) => {
    for (const menu of data) {
        let { name, link: route, icon, childs, encode_id } = menu;
        if (is_parent) {
            if (childs.length > 0) {
                let label = $('<span>', {
                    key: 't-' + name,
                    text: name
                });

                let menu_icon = $('<i>', {
                    class: icon
                });

                let a = $('<a>', {
                    href: "javascript: void(0);",
                    class: 'has-arrow waves-effect',
                    html: [menu_icon, label]
                });

                let sub = $('<ul>', {
                    class: 'sub-menu sub-' + encode_id,
                    'aria-expanded': false,
                });

                container.append($('<li>', {
                    html: [a, sub],
                }).prop('outerHTML'));

                generateMenu(childs, $('.sub-' + encode_id), false);
            } else {
                let label = $('<span>', {
                    text: name,
                    key: 't-' + name,
                    class: 'ps-2'
                });

                let menu_icon = $('<i>', {
                    class: icon
                });

                let a = $('<a>', {
                    href: BASE_URL + route,
                    html: [menu_icon, label],
                    class: 'nav-link menu-title link-nav'
                });

                container.append($('<li>', {
                    html: [a],
                }).prop('outerHTML'));
            }
        } else {
            let li = $('<li>', {
                html: $('<a>', {
                    href: BASE_URL + route,
                    text: name
                })
            })

            container.append(li.prop('outerHTML'));
        }

    }
}