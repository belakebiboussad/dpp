<script  type="text/javascript" charset="utf-8" async defer>
$(function(){
  $('body').on('change', '.specPrd', function () {
    var url = '{!! route("drug.index") !!}';
    url +='?spec_id='+$(this).val();
    getProducts(url,function(){});
  });
});
</script>