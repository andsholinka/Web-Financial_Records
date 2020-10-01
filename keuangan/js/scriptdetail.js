$(document).ready(function() {
  var data = "tampildetail.php";
  $("#tampildetail").load(data);

  $(document).on("click", "#btndetail", function(e) {
    e.preventDefault();
    $("#modal-detail").modal("show");
    $.post("querydetail.php", { id_arsip: $(this).attr("data-id") }, function(
      html
      ) {
      $("#data-detail").html(html);
    });
  });
});