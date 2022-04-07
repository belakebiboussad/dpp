<script  type="text/javascript" charset="utf-8" async defer>
$('document').ready(function(){
  jQuery('body').on('click', '.delete-demandeRad', function (e) {
      event.preventDefault();
      var demande_id = $(this).val();
      $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
      });
      $.ajax({
          type: "DELETE",
          url: '/demandeexr/' + demande_id,
          success: function (data) {
            $("#demandeRad" + demande_id).remove();
          },
          error: function (data) {
            console.log('Error:', data);
          }
      });
  });
});
</script>