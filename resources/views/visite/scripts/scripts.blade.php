<script  type="text/javascript" charset="utf-8" async defer>
$(function(){
  $('body').on('change', '.specPrd', function () {
      if($("#med_id").prop('disabled') == true)
        $("#med_id").prop('disabled',false);
      var url = '{!! route("drug.index") !!}';
    url +='?spec_id='+$(this).val();
    getProducts(url);

  });
});
</script>