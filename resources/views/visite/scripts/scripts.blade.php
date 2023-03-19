<script  type="text/javascript" charset="utf-8" async defer>

$('document').ready(function(){
  $('body').on('change', '#specialiteProd', function () {
//if($(this).val() != "0" ){}/*else{$("#produit").val(0);$("#produit").prop('disabled', 'disabled');}*/
    $("#produit").removeAttr("disabled");
    var id_spec = $(this).val(); getProducts(1,id_spec);
  });
});
</script>