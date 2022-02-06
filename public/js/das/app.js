//create datatables function
const createTable = () => {
  const table = $(".dataTable");
  if(table.length > 0){
  table.DataTable({
    "paging": true,
    "lengthChange": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  })}
}

$(document).ready(function () {
createTable()
});