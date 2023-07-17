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
   var actions ='<a href="#" class="btn btn-xs btn-danger proDel"><i class="ace-icon fa fa-trash-o"></i></a>';
   $('#cmd').append('<tr><td class="center"><label class="pos-rel"><input type="checkbox" class="ace" id="chk[]"/><span class="lbl"></span></label></td><td hidden>'+$("#produit").val()+'</td><td>'+$("#produit option:selected").text()+'</td><td>'+$('#gamme option:selected').text()+'</td><td>'+(($("#gamme").val() == "1") ? $('#specPrd option:selected').text() : "/")+'</td><td >'+$("#quantite").val()+'</td><td>'+$("#unite").val()+'</td><td class="center">'+actions+'</td></tr>');
}); 
$('#productAdModal').on('shown.bs.modal', function () {
  $("#Prodadd").prop('disabled', true);//Prodadd
  $('#productAdModal form')[0].reset(); 
  $('#produit').empty().append('<option selected disabledvalue="">Selectionner...</option>');
})
})
</script>