//token from meta tag
const token = $("meta[name='csrf-token']").attr("content");
//create datatables function
const createTable = () => {
  const table = $(".dataTable");
  if (table.length > 0) {
    table.DataTable({
      "order": [],
      "paging": true,
      "lengthChange": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    })
  }
}
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
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Yes, delete it!`
      }).then((result) => {
        if (result.isConfirmed) {
          loader("visible");
          $.ajax({
            type: "post",
            url: url,
            data: { "_token": token, "_method": "DELETE" },
            dataType: "json",
            success: function (response) {
              loader("hidden");
              $(document).Toasts('create', {
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
              $(document).Toasts('create', {
                class: "bg-danger m-2",
                title: "Error",
                body: error.statusText + " " + error.responseJSON.message + " </br> Please refresh the page.",
              })
              loader("hidden");
            }
          });
        }
      })
    })
  }
}

//function loader show/hidden
const loader = (type = "visible",timeOut=1200) => {
  if (type == "hidden") {
    setTimeout(() => {
      $(".loader").css("visibility", "hidden");
    }, timeOut);
  } else {
    $(".loader").css("visibility", "visible");
  }
}
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
      </div>`
  }
  show() {
    $("#toast-container").append(this.init());
  }
}
const toastOption = {
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "5000",
  "timeOut": "10000",
  "extendedTimeOut": "5000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
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
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Yes, ${type} it!`
      }).then((result) => {
        if (result.isConfirmed) {
          loader("visible");
          $.ajax({
            type: "post",
            url: url,
            data: { "_token": token, "id": id, "_method": "PUT", "approval": type },
            dataType: "json",
            success: function (response) {
              $(document).Toasts('create', {
                class: "bg-success m-2",
                title: "Success",
                body: "Successfully " + type + "d",
              })
              loader("hidden");
              window.location = "/admin/sellers?condition=approval"
            },
            error: function (error) {
              $(document).Toasts('create', {
                class: "bg-danger m-2",
                title: "Error",
                body: error.statusText
              })
              loader("hidden");
            }
          });
        }
      })
    })
  }
}
//ajax form dynamic
const formAjax = () => {
  const FORM = $(".form-ajax");
  if (FORM.length > 0) {
    FORM.submit(function (e) {
      e.preventDefault();
      const url = $(this).attr("action");
      const method = $(this).attr("method");
      const data = new FormData($(this)[0]);
      if ($(this).parsley().validate()) {
        loader();
        $.ajax({
          type: method,
          url: url,
          data: data,
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (response) {
            toastr["success"]( response.message)
            toastr.options = toastOption;
            loader("hidden");
            window.location = response.url
          },
          error: function (error) {
            let err_message = ""
            const FIELD_ERROR = error.responseJSON.errors;
            for (const key in FIELD_ERROR) {
              if (FIELD_ERROR.hasOwnProperty(key)) {
                const element = FIELD_ERROR[key];
                err_message += '<i class="fa-solid fa-circle-small"></i> ' + element[0] + "</br>"
              }
            }
            toastr["error"](err_message)
            toastr.options = toastOption;
            loader("hidden");
          }
        });
      }

    })
  }
}
const pageAprroved = () => {
  $(document).on("submit", "#seller-banned-form", function (e) {
    e.preventDefault();
    const url = $(this).attr("action");
    //get value from this form
    const is_ban = $(this).find("input[name=is_ban]").val();
    let type = is_ban == 1 ? "unban" : "ban";
    //sweet alert
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to " + type + " this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    }).then((result) => {
      if (result.isConfirmed) {
        loader("visible");
        $.ajax({
          type: "post",
          url: url,
          data: { "_token": token, "is_ban": is_ban, "_method": "DELETE" },
          dataType: "json",
          success: function (response) {
            $(document).Toasts('create', {
              class: "bg-success m-2",
              title: "Success",
              body: response.message,
            })
            loader("hidden");
            window.location.reload();
          },
          error: function (error) {
            $(document).Toasts('create', {
              class: "bg-danger m-2",
              title: "Error",
              body: error.statusText + " " + error.responseJSON.message + " </br> Please refresh the page.",
            })
            loader("hidden");
          }
        });
      }
    })
  })
}
const needValidation = () => {
  const form = $('.needs-validation')
  if (form.length > 0) {
    form.parsley()
  }
}
const switchBootstrap = () => {
  $("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
}

$(document).ready(function () {
  switchBootstrap()
  formAjax()
  needValidation()
  deleteItem();
  pageApproval();
  pageAprroved()
  createTable();
  console.clear();
});
