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
const loader = (type = "visible") => {
  if (type == "hidden") {
    setTimeout(() => {
      $(".loader").css("visibility", "hidden");
    }, 1000);
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
const pageAprroved = () => {
  $(document).on("submit", "#seller-banned-form", function (e) {
    e.preventDefault();
    const url = $(this).attr("action");
    //get value from this form
    const is_ban = $("#seller-banned-form input[name=is_ban]").val();
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
$(document).ready(function () {
  deleteItem();
  pageApproval();
  pageAprroved()
  createTable();
  console.clear();
});