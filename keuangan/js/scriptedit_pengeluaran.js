$(document).ready(function() {
  var data = "tampildata_pengeluaran.php";
  $("#datapengeluaran").load(data);

  $(document).on("click", "#btnedit", function(e) {
    e.preventDefault();
    $("#modal_edit").modal("show");
    $.post("modal_edit_pengeluaran.php", { id: $(this).attr("data_id") }, function(
      html
      ) {
      $("#data-edit").html(html);
    });
  });

  $("#form-edit").submit(function(e) {
    e.preventDefault();
    $("#error_edit_id").html("");

    var dataform = $("#form-edit").serialize();
    $.ajax({
      url: "queryedit_pengeluaran.php",
      type: "post",
      data: dataform,
    });
  });
});