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
              getProducts('{!! route ("dispositif.index") !!}',function(){});
              break;
          case "3":
              getProducts('{!! route ("reactif.index") !!}',function(){});
              break;
            case "4":
              getProducts('{!! route ("consommable.index") !!}',function(){});
              break;
          default:
              break; 
      }
});
 $('#produit').change(function(){
    $("#Prodadd").removeAttr("disabled");
});
$("#Prodadd").click(function(){
  // $('#cmd').append('<tr><td class="center"><label class="pos-rel"><input type="checkbox" class="ace" id="chk[]" onClick="enableDestry()"/><span class="lbl"></span></label></td><td hidden>'+$("#produit").val()+'</td><td>'+$("#produit option:selected").text()+'</td><td>'+$('#gamme option:selected').text()+'</td><td>'+(($("#gamme").val() == "1") ? $('#specPrd option:selected').text() : "/")+'</td><td >'+$("#quantite").val()+'</td><td>'+$("#unite").val()+'</td></tr>');$('#produit').empty().append('<option selected disabledvalue="">Selectionner...</option>');$("#quantite").val(1);$('#gamme').val('');$('#specPrd').val('');$("#unite").val('');
  //     $("#ajoutercmd").prop('disabled', true);
  
 }); 
})
</script>