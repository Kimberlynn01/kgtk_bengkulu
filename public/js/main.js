(function ($) {
    // Input filter utility
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
})(jQuery);

const App = {
    options: {
        dt: {
            processing: `
                <div class="spinner-border text-primary m-2 p-2" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <br> Memuat Data`,
            paginate: { first: '<<', previous: '<', next: '>', last: '>>' },
            lengthMenu: 'Menampilkan _MENU_ data',
            search: 'Pencarian: ',
            info: 'Menampilkan _START_ ke _END_ dari _TOTAL_ data',
            infoEmpty: 'Kosong',
            infoFiltered: '(Tersaring dari _MAX_ data)',
            emptyTable: 'Data kosong',
        },
        date: { format: 'yyyy-mm-dd', todayHighlight: true, autoclose: true },
        year: { format: "yyyy", viewMode: "years", minViewMode: "years" },
        sampleImage: 'WHlHZUsxZ0VpdGNlNm5kamx4WTdUc3h4YTdHQjFheGFyVU5BTzVOd2VEWXZmTWF1WkJuMnpkZDdFbWtyN0VCN1o0WWFDNjJEcU1IWjZndkEwTFBTREE9PQ==',
    },

    utils: {
        getMeta: (name) => $(`meta[name=${name}]`).attr('content') || '',
        url: (path) => `${App.utils.getMeta('base-url')}${path}`,
        makeId: (length) => Array.from({ length }, () =>
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'.charAt(Math.floor(Math.random() * 62))
        ).join(''),
        numberFormat: (val) => {
            if (!val) return '-';
            val = val.toString().replace(/,/g, ''); // Remove commas
            const [intPart, decimalPart] = val.split('.');
            const formattedInt = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return decimalPart ? `${formattedInt}.${decimalPart}` : formattedInt;
        },
        capitalizeFirstLetter: (str) => str.charAt(0).toUpperCase() + str.slice(1),
    },

    toastrConfig: {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        showDuration: 300,
        hideDuration: 1000,
        timeOut: 5000,
        extendedTimeOut: 1000,
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    },

    showToastr: {
        success: (title, message = null) => toastr.success(message, title),
        error: (title, message = null) => toastr.error(message, title),
    },

    swalMessage: (message, type, footer = null, callback = null) => {
        const types = {
            success: { icon: 'success', title: 'Sukses' },
            error: { icon: 'error', title: 'Oops..!' },
            loader: {
                icon: null,
                title: '',
                html: message || 'Sedang memproses....',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                timerProgressBar: true,
                didOpen: () => Swal.showLoading(),
            },
            default: { icon: 'info', title: 'Informasi' },
        };

        return Swal.fire({ ...types[type || 'default'], html: message, footer, willClose: callback });
    },

    swalConfirmation: ({ title, question: html, footer, callback, icon = 'warning', flipButtonColor = true }) => {
        let buttonColor = flipButtonColor ? {
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
        } : {
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        };

        return Swal.fire({
            title,
            html,
            footer,
            icon,
            showCancelButton: true,
            ...buttonColor,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                callback()
            }
        })
    },

    handleErrors: {
        generate: (form, res, isUpdate = false) => {
            for (const [key, errors] of Object.entries(res.errors)) {
                const errorContainer = isUpdate ? $(`.error-update-${key}`) : $(`.error-${key}`);
                const input = form.find(`#${key}`);
                if (errors.length > 0) {
                    input.removeClass('is-valid').addClass('is-invalid');
                    errorContainer.html(errors);
                } else {
                    input.removeClass('is-invalid').addClass('is-valid');
                    errorContainer.empty();
                }
            }
        },
        clear: (form) => {
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.is-valid').removeClass('is-valid');
            form.find('.error').empty();
        },
    },
};

$(() => {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Input filters
    $('.rupiah').inputFilter((value) => /^[\d].*$/.test(value)).on('keyup', function () {
        const val = $(this).val().replace(/[^0-9]+/g, '');
        $(this).val(App.utils.numberFormat(val));
    });

    $('.decimal-only').inputFilter((value) => /^\d*\.?\d*$/.test(value));
    $('.number-only').inputFilter((value) => /^\d*$/.test(value));
    $('.max-16').on('input', function () {
        if (this.value.length > 16) this.value = this.value.slice(0, 16);
    });

    // Datepickers
    $('.year-only').datepicker(App.options.year);
    $('.datepicker').datepicker(App.options.date);

    // Permissions
    window.permissions = {};
    $('.permission_status').each((i, el) => {
        let name = $(el).attr('name');
        let val = (parseInt($(el).val()) == 1) ? true : false;

        permissions[name] = val;
    })

    // Cache global variables
    window.BASE_URL = App.utils.getMeta('base-url');
    window.asset_url = App.utils.getMeta('asset-url');
    window.ROLE_NAME = App.utils.getMeta('role-name');
    window.ACTIVE_SLUG = App.utils.getMeta('active-slug');
});

// const current_route = getMeta('current_url');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});