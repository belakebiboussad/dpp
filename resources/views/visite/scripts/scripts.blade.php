<script  type="text/javascript" charset="utf-8" async defer>
$(function(){
  $('body').on('change', '#specialiteProd', function () {
    if(!isEmpty($(this).val())) {
      if($("#med_id").prop('disabled') == true)
        $("#med_id").prop('disabled',false);
      getProducts(1,$(this).val());
    }
    else
      $("#med_id").prop('disabled',true);

  });
});
</script>