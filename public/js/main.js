(function ($) {
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
}(jQuery));

const options = {
    /** Config datepicker */
    dt: {
        processing: '<div class="spinner-border text-primary m-2 p-2" role="status"><span class="sr-only">Loading...</span></div> <br> Memuat Data',
        paginate: {
            first: '<<',
            previous: '<',
            next: '>',
            last: '>>'
        },
        lengthMenu: 'Menampilkan _MENU_ data',
        search: 'Pencarian: ',
        info: 'Menampilkan _START_ ke _END_ dari _TOTAL_ data',
        infoEmpty: 'Kosong',
        infoFiltered: '(Tersaring dari _MAX_ data)',
        emptyTable: 'Data kosong'
    },
    /** Config datepicker */
    date: {
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        // orientation: 'bottom'
    },
    year: {
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
        // orientation: 'bottom'
    },
    sampleImage: 'WHlHZUsxZ0VpdGNlNm5kamx4WTdUc3h4YTdHQjFheGFyVU5BTzVOd2VEWXZmTWF1WkJuMnpkZDdFbWtyN0VCN1o0WWFDNjJEcU1IWjZndkEwTFBTREE9PQ=='
};

const getAccessStatus = (name) => {
    return (parseInt($("input[name=" + name + "]").val())) ? true : false;
}

const getMeta = (meta_name) => {
    var meta = $(`meta[name=${meta_name}]`);

    return meta.attr('content');
}

const url = (str) => {
    return getMeta('base-url') + str;
}

const makeId = (length) => {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}

const number_format = (val) => {
    if (val != null) {
        val = val.toString().replace(/,/g, ''); //remove existing commas first
        var valSplit = val.split('.'); //then separate decimals

        while (/(\d+)(\d{3})/.test(valSplit[0].toString())) {
            valSplit[0] = valSplit[0].toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }

        if (valSplit.length == 2) { //if there were decimals
            val = valSplit[0] + "." + valSplit[1]; //add decimals back
        } else {
            val = valSplit[0];
        }

        return val;
    } else {
        return '-';
    }
}

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": 300,
    "hideDuration": 1000,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

const showSuccessToastr = (title, mssg = null) => {
    toastr.success(mssg, title);
}

const showErrorToastr = (title, mssg = null) => {
    toastr.error(mssg, title);
}

const capitalizeFirstLetter = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

const checkAccess = (access_name) => {
    let value = parseInt(getMeta(`${access_name}_access`));

    if (value) return true;

    return false;
}

function showMessage(message, type, footer = null, callback = null) {
    let title;

    switch (type) {
        case 'success':
            title = 'Sukses';
            return Swal.fire({
                html: message,
                icon: 'success',
                footer: footer,
                willClose: callback,
            });
            break;
        case 'error':
            title = 'Oops..!';
            return Swal.fire({
                html: message,
                icon: 'error',
                footer: footer,
                willClose: callback,
            });
            break;
        case 'loader':
            return Swal.fire({
                title: '',
                html: message || 'Sedang memproses....',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            break;
        default:
            title = 'Informasi';
            return Swal.fire({
                html: message,
                icon: 'info',
                footer: footer
            });
            break;
    }
}

const swalProcessing = (msg) => {
    return showMessage(msg, 'loader');
}


const generateErrorMessage = (form, res, is_update = false) => {
    for (const key in res.errors) {

        if (Object.hasOwnProperty.call(res.errors, key)) {
            const element = res.errors[key];

            let error_container = $('.error-' + key);
            if (is_update) {
                error_container = $('.error-update-' + key);
            }

            if (element.length > 0) {
                form.find('#' + key).removeClass('is-valid').addClass('is-invalid');

                error_container.empty().append(element);
            } else {
                error_container.empty();
                form.find('#' + key).removeClass('is-invalid').addClass('is-valid');
            }
        }
    }
}

const clearErrorMessage = (form) => {
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.is-valid').removeClass('is-valid');
    form.find('.error').empty();
}

// const current_route = getMeta('current_url');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(() => {
    $('[data-toggle="tooltip"]').tooltip()

    window.permissions = {};
    $('.permission_status').each((i, el) => {
        let name = $(el).attr('name');
        let val = (parseInt($(el).val()) == 1) ? true : false;

        permissions[name] = val;
    })

    $('.rupiah').inputFilter(function (value) {
        return /^[\d].*$/.test(value);
    }).on('keyup', function () {
        var val = $(this).val().replace(/[^0-9]+/g, '');
        $(this).val(number_format(val, false));
    });


    $('.decimal-only').inputFilter(function (value) {
        return /^\d*\.?\d*$/.test(value);
    });

    $('.number-only').inputFilter(function (value) {
        return /^\d*$/.test(value);
    });

    $('.max-16').on('input', function () {
        if ($(this).val().length > 16) {
            $(this).val($(this).val().slice(0, 16)); // Limit to 16 digits
        }
    });

    $('.year-only').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true,
    })

    $('.datepicker').datepicker(options.date)
})

window.BASE_URL = getMeta('base-url');
window.asset_url = getMeta('asset-url');
window.ROLE_NAME = getMeta('role-name');