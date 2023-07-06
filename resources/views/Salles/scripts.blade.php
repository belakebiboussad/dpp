<script type="text/javascript">
$(function(){
  $('body').on('click', '#salleAdd', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).data("href"),
        data: { _token: CSRF_TOKEN },
        success: function (data) {
          $('#ajaxPart').html(data);
        } 
    });
  });
}); 
</script>