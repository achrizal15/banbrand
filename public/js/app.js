//token from meta tag
const token = $("meta[name='csrf-token']").attr("content");
const rateStars = function () {
    $("div#rateYo").each(function (e) {
        let readOnly = $(this).data("readonly");
        let value = $(this).data("value") ? $(this).data("value") : 5;
        // console.log(readOnly);
        $(this).rateYo({
            starWidth: "15px",
            readOnly: readOnly,
            rating: value,
        });
    });
};
//funtion date to time ago

const carouselHandler = function () {
    $(".owl-carousel").each(function (e) {
        $(this).owlCarousel({
            stagePadding: 50,
            loop: false,
            margin: 10,
            merge: true,
            nav: true,
            dots: false,
            navText: [
                "<div class='nav-button owl-prev text-center'>‹</div>",
                "<div class='nav-button owl-next'>›</div>",
            ],
            responsive: {
                0: {
                    margin: 100,
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
                1200: {
                    items: 4,
                },
            },
        });
    });
};

const stepWizzard = function () {
    // SmartWizard initialize
    $("#smartwizard").smartWizard({
        theme: "arrows",
        enableURLhash: false,
        loader: "show",
        anchorSettings: {
            anchorClickable: false, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // Add done state on navigation
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: false, // Enable/Disable the done steps navigation
        },
    });
    // Initialize the leaveStep event
    $("#smartwizard").on(
        "leaveStep",
        function (
            e,
            anchorObject,
            currentStepIndex,
            nextStepIndex,
            stepDirection
        ) {
            let form = $("form#form-register-seller");
            if (stepDirection == "forward" && form.length != 0) {
                if (
                    $("#form-register-seller")
                        .parsley()
                        .validate({
                            group: "block-" + nextStepIndex,
                        }) == false
                ) {
                    return false;
                }
            }
        }
    );
};
//function input number only
const inputNumberOnly = () => {
    $(".input-number-only").on("keydown", function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if (
            $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)
        ) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if (
            (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
            (e.keyCode < 96 || e.keyCode > 105)
        ) {
            e.preventDefault();
        }
    });
};

const registerPage = () => {
    let form_register_seller = $("form#form-register-seller");
    if (form_register_seller.length > 0) {
        $.ajax({
            type: "get",
            url: "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/35.json",
            dataType: "json",
            success: function (result) {
                result.forEach((kota) => {
                    var newOption = new Option(
                        kota.name,
                        kota.name + "|" + kota.id,
                        false,
                        false
                    );
                    form_register_seller
                        .find("select[name='kota'")
                        .append(newOption)
                        .trigger("change");
                });
            },
        });
        $(document).on("change", "#select-kota", function () {
            if ($(this).val() == null) {
                return false;
            }
            let id_kecamatan = $(this).val().split("|")[1];
            $.ajax({
                type: "get",
                url:
                    "http://www.emsifa.com/api-wilayah-indonesia/api/districts/" +
                    id_kecamatan +
                    ".json",
                dataType: "json",
                success: function (response) {
                    form_register_seller
                        .find("select[name='kecamatan'")
                        .html(new Option("Pilih Satu", "", true, true));
                    form_register_seller
                        .find("select[name='kelurahan'")
                        .html(new Option("Pilih Satu", "", true, true));
                    response.forEach((kecamatan) => {
                        let newOption = new Option(
                            kecamatan.name,
                            kecamatan.name + "|" + kecamatan.id,
                            false,
                            false
                        );
                        form_register_seller
                            .find("select[name='kecamatan'")
                            .append(newOption)
                            .trigger("change");
                    });
                },
            });
        });
        $(document).on("change", "#select-kecamatan", function () {
            if ($(this).val() == "") {
                return false;
            }
            let id_kelurahan = $(this).val().split("|")[1];
            $.ajax({
                type: "get",
                url:
                    "http://www.emsifa.com/api-wilayah-indonesia/api/villages/" +
                    id_kelurahan +
                    ".json",
                dataType: "json",
                success: function (response) {
                    form_register_seller
                        .find("select[name='kelurahan'")
                        .html(new Option("Pilih Satu", "", true, true));
                    response.forEach((kelurahan) => {
                        let newOption = new Option(
                            kelurahan.name,
                            kelurahan.name + "|" + kelurahan.id,
                            false,
                            false
                        );
                        form_register_seller
                            .find("select[name='kelurahan'")
                            .append(newOption)
                            .trigger("change");
                    });
                },
            });
        });
    }
};
const initUploadFileDropify = () => {
    let options = {
        messages: {
            default: "Drag or Click",
            remove: "Remove",
        },
    };
    $(document).on("click", "button.dropify-clear", function () {
        $("#dropify-thumnail-edit").val("");
    });
    $(document).on("change", "input.dropify", function () {
        if ($("#dropify-thumnail-edit").length == 0) return false;
        $("#dropify-thumnail-edit").val($(this).val());
    });

    if ($(".upload-avatar").length > 0) {
        options = {
            messages: {
                default: "",
                replace: "",
                remove: "Remove",
                error: "Ooops, something wrong happended.",
            },
            tpl: {
                wrap: '<div class="dropify-wrapper circle-image"></div>',
                loader: '<div class="dropify-loader"></div>',
                message:
                    '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
                preview:
                    '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
                filename:
                    '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                clearButton:
                    '<button type="button" hidden class="dropify-clear">{{ remove }}</button>',
                errorLine: '<p class="dropify-error">{{ error }}</p>',
                errorsContainer:
                    '<div class="dropify-errors-container"><ul></ul></div>',
            },
        };
    }
    if ($(".upload-multiple").length > 0) {
        options = {
            messages: {
                default: "",
                replace: "",
                remove: "",
                error: "",
            },
            tpl: {
                wrap: '<div class="dropify-wrapper images-multiple-upload"></div>',
                loader: '<div class="dropify-loader"></div>',
                message:
                    '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
                preview:
                    '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
                filename:
                    '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                clearButton:
                    '<button type="button" hidden class="dropify-clear">{{ remove }}</button>',
                errorLine: '<p class="dropify-error">{{ error }}</p>',
                errorsContainer:
                    '<div class="dropify-errors-container"><ul></ul></div>',
            },
        };
    }
    $(".dropify").dropify(options);
};

//create datatables function
const createTable = () => {
    const table = $(".dataTable");
    if (table.length > 0) {
        table.DataTable({
            order: [],
            paging: true,
            lengthChange: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    }
};
//function delete item from datatable
const deleteItem = () => {
    const FORM_DELETE_ITEM = $("form#form-delete-item");
    if (FORM_DELETE_ITEM.length > 0) {
        FORM_DELETE_ITEM.on("submit", function (e) {
            e.preventDefault();
            const url = $(this).attr("action");
            const remove = $(this).data("remove");
            const refresh = $(this).data("refresh");
            const row = $(this).parents("tr");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: `Yes, delete it!`,
            }).then((result) => {
                if (result.isConfirmed) {
                    loader("visible");
                    $.ajax({
                        type: "post",
                        url: url,
                        data: { _token: token, _method: "DELETE" },
                        dataType: "json",
                        success: function (response) {
                            loader("hidden");
                            $(document).Toasts("create", {
                                class: "bg-success m-2",
                                title: "Success",
                                body: response.message,
                            });
                            if (remove) {
                                row.remove();
                                if (refresh == true) window.location.reload();
                            }
                        },
                        error: function (error) {
                            $(document).Toasts("create", {
                                class: "bg-danger m-2",
                                title: "Error",
                                body:
                                    error.statusText +
                                    " " +
                                    error.responseJSON.message +
                                    " </br> Please refresh the page.",
                            });
                            loader("hidden");
                        },
                    });
                }
            });
        });
    }
};

//function loader show/hidden
const loader = (type = "visible", timeOut = 1200) => {
    if (type == "hidden") {
        setTimeout(() => {
            $(".loader").css("visibility", "hidden");
        }, timeOut);
    } else {
        $(".loader").css("visibility", "visible");
    }
};
//class toast
class ToastMessage {
    constructor(message, type = "success") {
        this.message = message;
        this.type = type;
    }
    init() {
        return `<div class="toast align-items-end show text-white show bg-${this.type} border-0 ml-3" role="alert"
          aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
              <div class="toast-body">
                ${this.message}
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                  aria-label="Close"></button>
          </div>
      </div>`;
    }
    show() {
        $("#toast-container").append(this.init());
    }
}
const toastOption = {
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: true,
    onclick: null,
    showDuration: "300",
    hideDuration: "5000",
    timeOut: "10000",
    extendedTimeOut: "5000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};
//function page approval
const pageApproval = () => {
    if ($("#approval-btn").length > 0) {
        //document btn on click
        $(document).on("click", "#approval-btn", function () {
            const id = $(this).data("id");
            const type = $(this).data("type");
            const url = $(this).data("url");
            //swal alert
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: `Yes, ${type} it!`,
            }).then((result) => {
                if (result.isConfirmed) {
                    loader("visible");
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            _token: token,
                            id: id,
                            _method: "PUT",
                            approval: type,
                        },
                        dataType: "json",
                        success: function (response) {
                            $(document).Toasts("create", {
                                class: "bg-success m-2",
                                title: "Success",
                                body: "Successfully " + type + "d",
                            });
                            loader("hidden");
                            window.location =
                                "/admin/sellers?condition=approval";
                        },
                        error: function (error) {
                            $(document).Toasts("create", {
                                class: "bg-danger m-2",
                                title: "Error",
                                body: error.statusText,
                            });
                            loader("hidden");
                        },
                    });
                }
            });
        });
    }
};
//ajax form dynamic
const formAjax = () => {
    const FORM = $(".form-ajax");
    if (FORM.length > 0) {
        FORM.submit(function (e) {
            e.preventDefault();
            const url = $(this).attr("action");
            const method = $(this).attr("method");
            const data = new FormData($(this)[0]);
            //has class needs-validation
            if ($(this).hasClass("needs-validation")) {
                $(this).parsley().validate();
                if (!$(this).parsley().isValid()) {
                    return false;
                }
            }
            loader();
            $.ajax({
                type: method,
                url: url,
                data: data,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    toastr["success"](response.message);
                    toastr.options = toastOption;
                    loader("hidden");
                    window.location = response.url;
                },
                error: function (error) {
                    let err_message = "";
                    const FIELD_ERROR = error.responseJSON.errors;
                    for (const key in FIELD_ERROR) {
                        if (FIELD_ERROR.hasOwnProperty(key)) {
                            const element = FIELD_ERROR[key];
                            err_message +=
                                '<i class="fa-solid fa-circle-small"></i> ' +
                                element[0] +
                                "</br>";
                        }
                    }
                    toastr["error"](
                        err_message != "" ? err_message : error.statusText
                    );
                    toastr.options = toastOption;
                    loader("hidden");
                },
            });
        });
    }
};

const pageAprroved = () => {
    $(document).on("submit", "#seller-banned-form", function (e) {
        e.preventDefault();
        const url = $(this).attr("action");
        //get value from this form
        const is_ban = $(this).find("input[name=is_ban]").val();
        let type = is_ban == 1 ? "ban" : "unban";
        //sweet alert
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to " + type + " this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                loader("visible");
                $.ajax({
                    type: "post",
                    url: url,
                    data: { _token: token, is_ban: is_ban, _method: "DELETE" },
                    dataType: "json",
                    success: function (response) {
                        $(document).Toasts("create", {
                            class: "bg-success m-2",
                            title: "Success",
                            body: response.message,
                        });
                        loader("hidden");
                        window.location.reload();
                    },
                    error: function (error) {
                        $(document).Toasts("create", {
                            class: "bg-danger m-2",
                            title: "Error",
                            body:
                                error.statusText +
                                " " +
                                error.responseJSON.message +
                                " </br> Please refresh the page.",
                        });
                        loader("hidden");
                    },
                });
            }
        });
    });
};

const switchBootstrap = () => {
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch("state", $(this).prop("checked"));
    });
};
const summernoteHandler = function () {
    if ($("#summernote").length > 0) {
        $("#summernote").summernote({
            placeholder: "Tuliskan sesuatu",
            tabsize: 2,
            height: 120,
            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["fontsize", ["fontsize"]],
                // ['insert', ['link', 'picture', 'video']],
                // ['view', ['fullscreen', 'codeview']]
            ],
        });
        $("#summernote").summernote("justifyFull");
    }
};

const categoryPage = function () {
    if ($("#table-category").length > 0) {
        $(document).on("click", "#btn-deskripsi-category", function () {
            let kategori = $(this).data("category");
            $("#deskripsiModal #deskripsiModalLabel").text(kategori.nama);
            $("#deskripsiModal .modal-body").html(kategori.deskripsi);
        });
    }
};
const initSelect2 = function () {
    if ($(".select2").length > 0) {
        $(".select2").select2();
    }
};
const PagePriceProduk = () => {
    $(document).on("click", "#delete-multi-upload", function () {
        $(this).parent().remove();
        const id = $(this).data("id");
        if (id != null) {
            $.ajax({
                type: "post",
                url: `/sellers/product/galery/${id}`,
                data: { _token: token, _method: "delete" },
            });
        }
    });
    $(document).on("click", ".add-multiple-images", function () {
        $(this).parent().append(`<div class="upload-group">
                        <button type="button" id="delete-multi-upload" class="close">x</button>
                        <input type="file" class="dropify upload-multiple"
                        name="galerys[]" placeholder="x" data-placeholder="x"/>
                        </div>`);
        $(".dropify").dropify({
            messages: {
                default: "",
                replace: "",
                remove: "",
                error: "",
            },
            tpl: {
                wrap: '<div class="dropify-wrapper images-multiple-upload"></div>',
                loader: '<div class="dropify-loader"></div>',
                message:
                    '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
                preview:
                    '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
                filename:
                    '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                clearButton:
                    '<button type="button" hidden class="dropify-clear">{{ remove }}</button>',
                errorLine: '<p class="dropify-error">{{ error }}</p>',
                errorsContainer:
                    '<div class="dropify-errors-container"><ul></ul></div>',
            },
        });
    });
};
//function convert rupiah
const convertToRupiah = (angka) => {
    let rupiah = "";
    let angkarev = angka.toString().split("").reverse().join("");
    for (let i = 0; i < angkarev.length; i++) {
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
    }
    return (
        "Rp. " +
        rupiah
            .split("", rupiah.length - 1)
            .reverse()
            .join("")
    );
};
//cowntdown timer update div
const countDownTimer = () => {
    const countdown = $("#countdown");
    if ($("#countdown").length <= 0) return false;
    const time = countdown.data("time");
    countdown.countdown(time, function (param) {
        $(this).html(param.strftime("%H jam %M menit %S detik"));
    });
};

const CheckoutPage = () => {
    const form = $("#form-checkout-page");
    if (form.length <= 0) return false;
    $(document).on("change", "input[name='pengiriman']", function () {
        $('#qty').val(1);
        const harga = $("input[name='harga']").val();
        const ongkir = $("input[name='ongkir']").val();
        const kode = $("input[name='kodetransfer']").val();
        if ($(this).val() == "TAKE") {
            $("#label-ongkir").text("Rp 0");
            $("#label-total").text(
                convertToRupiah(parseInt(harga) + parseInt(kode))
            );
            $("input[name='total']").val(parseInt(harga) + parseInt(kode));
        } else {
            $("#label-ongkir").text("Rp 10.000");
            $("#label-total").text(
                convertToRupiah(
                    parseInt(harga) + parseInt(kode) + parseInt(ongkir)
                )
            );
            $("input[name='total']").val(
                parseInt(harga) + parseInt(kode) + parseInt(ongkir)
            );
        }
    });
    $(document).on("change keyup", "#qty", function () {
        const jumlah_qty = $(this).val();
        if (jumlah_qty == "0") {
            $(this).val(1);
        }
        const harga_per_item = $("input[name='harga']").val();
        const ongkir = $('input[name="ongkir"]').val();
        const kode_transfer = $('input[name="kodetransfer"]').val();
        const total =
            parseInt(harga_per_item) * parseInt(jumlah_qty) +
            parseInt(ongkir) +
            parseInt(kode_transfer);
        $("#label-total").html(convertToRupiah(jumlah_qty == "" ? 0 : total));
        $("input[name='total']").val(total);
    });
};
const VerifPage = () => {
    const table = $("#table-verif");
    if (table.length <= 0) return false;
    $(document).on("click", "#btn-view-bukti", function () {
        const data = $(this).data("checkout");
        const gambar = $(this).data("gambar");
        const href = $(this).data("route");
        $("#verifModalLabel").text(data.no_transaksi);
        $("#no_rekening").val(data.no_rekening);
        $("#total_bayar").val(convertToRupiah(data.total));
        $("#bukti").attr("src", gambar);
        $("#bukti-id").val(data.id);
        $("#btn-bukti").attr("href", href);
    });
    $(document).on("click", "#btn-bukti", function (e) {
        e.preventDefault();
        const status = $(this).data("status");
        const href = $(this).attr("href");
        let pesan =
            "Jika anda mengkonfirmasi pembayaran, maka transaksi akan segera dilanjutkan ke proses selanjutnya.";
        if (status == "tolak") {
            pesan =
                "Jika anda menolak pembayaran, maka transaksi akan segera dibatalkan dan akan dihapus permanen.";
        }

        Swal.fire({
            title: "Are you sure?",
            text: pesan,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: status.toUpperCase(),
        }).then((result) => {
            if (result.value) {
                window.location.href = `${href}?status=${status}`;
            }
        });
    });
};
$(document).ready(function () {
    VerifPage();
    countDownTimer();
    CheckoutPage();
    PagePriceProduk();
    initSelect2();
    categoryPage();
    summernoteHandler();
    switchBootstrap();
    formAjax();
    deleteItem();
    pageApproval();
    pageAprroved();
    createTable();
    inputNumberOnly();
    registerPage();
    initUploadFileDropify();
    stepWizzard();
    carouselHandler();
    rateStars();
});
