<script  type="text/javascript" charset="utf-8" async defer>
$('document').ready(function(){
  $('body').on('click', '.dh-delete', function (e) {
      event.preventDefault();
      var id = $(this).val();
      $.ajaxSetup({
          headers: {
           'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type: "DELETE",
        url: '/demandehosp/' + id,
        success: function (data) {
          $("#dh-" + id).remove();
        }
      });
  });
})
</script>