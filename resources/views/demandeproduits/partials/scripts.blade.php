<script>
 $(function(){
   $('#gamme').change(function(){
      if(($(this).val() == 1)&&($("#specialiteDiv").is(":hidden"))) 
        $("#specialiteDiv").show();
      else
       if(!$("#specialiteDiv").is(":hidden"))
        $("#specialiteDiv").hide();

      switch($(this).val())
      {
          case "2":
              getProducts('{!! route ("dispositif.index") !!}');
              break;
          case "3":
              getProducts('{!! route ("reactif.index") !!}');
              break;
            case "4":
              getProducts('{!! route ("consommable.index") !!}');
              break;
          default:
              break; 
      }
});
$('.specPrd').change(function(){
    var url = '{!! route("drug.index") !!}';
    url +='?spec_id='+$(this).val();
    getProducts(url);
 });
 $('#produit').change(function(){
      $("#ajoutercmd").removeAttr("disabled");
});
$("#ajoutercmd").click(function(){
  $('#cmd').append('<tr><td class="center"><label class="pos-rel"><input type="checkbox" class="ace" id="chk[]" onClick="enableDestry()"/><span class="lbl"></span></label></td><td hidden>'+$("#produit").val()+'</td><td>'+$("#produit option:selected").text()+'</td><td>'+$('#gamme option:selected').text()+'</td><td>'+(($("#gamme").val() == "1") ? $('#specPrd option:selected').text() : "/")+'</td><td >'+$("#quantite").val()+'</td><td>'+$("#unite").val()+'</td></tr>');$('#produit').empty().append('<option selected disabledvalue="">Selectionner...</option>');$("#quantite").val(1);$('#gamme').val('');$('#specPrd').val('');$("#unite").val('');
      $("#ajoutercmd").prop('disabled', true);
 }); 
})
</script>