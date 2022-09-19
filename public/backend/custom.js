var Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000
});
// Function For DataTable
function datatable(id) {
  $(id)
    .DataTable({
      scrollX: true,
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      retrieve: true,
      paging: true,
      buttons: ["copy", "excel", "pdf", "print", "colvis"]
    })
    .buttons()
    .container()
    .appendTo(id + "_wrapper .col-md-6:eq(0)");
}

// Function Delete Data
function deleteData(url, fetchFunction) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then(result => {
    if (result.isConfirmed) {
      $.ajax({
        url: url,
        method: "delete",
        data: {
          _token: $("meta[name='csrf-token']").attr("content")
        },
        success: function(response) {
          console.log(response);
          Swal.fire("Deleted!", "Your Data has been deleted.", "success");
          fetchFunction();
        }
      });
    }
  });
}
