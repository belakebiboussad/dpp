<script  type="text/javascript" charset="utf-8" async defer>
$(function(){
  $('body').on('click', '.dh-delete', function (e) {
      event.preventDefault();
      var id = $(this).val();
      $.ajax({
        type: "DELETE",
        url: '/demandehosp/' + id,
        data: { _token: CSRF_TOKEN },
        success: function (data) {
          $("#dh-" + id).remove();
        }
      });
  });
})
</script>