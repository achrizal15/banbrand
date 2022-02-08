//token from meta tag
const token = $("meta[name='csrf-token']").attr("content");
//create datatables function
const createTable = () => {
  const table = $(".dataTable");
  if (table.length > 0) {
    table.DataTable({
      "paging": true,
      "lengthChange": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
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
              window.location.reload();
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
$(document).ready(function () {
  pageApproval();
  createTable()
});