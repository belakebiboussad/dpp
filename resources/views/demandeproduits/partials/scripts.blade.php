<script>
function getProducts(id_gamme, spec_id=0,med_id = 0)
{
  var html = '<option value="" selected disabled>Sélectionner...</option>';
  var url ='';
  switch(id_gamme)
  {
       case "1":
        var base = '{!! route('drug.index') !!}';
        url = base+'?spec_id='+spec_id ;
        break;
        case 2:
            url= '{{ route ("dispositif.index") }}';
            break;
        case 3:
            url= '{{ route ("reactif.index") }}';
            break;
        case 4:
            url= '{{ route ("consommable.index") }}';
            break;
    }
    $.ajax({
          url : url,
          type : 'GET',
          dataType : 'json',
           success : function(data){
              $.each(data, function(){
                 html += "<option value='"+this.id+"'>"+this.nom+"</option>";
              });
              $('#produit').html(html);
              if(med_id != 0)
                $('#produit').val(med_id);
           }
       })
}
$(function(){
         $('#gamme').change(function(){
             switch($(this).val())
             {
                    case "1":
                          if($("#specialiteDiv").is(":hidden"))
                                $("#specialiteDiv").show();
                           break;
                    case "2":
                           if(!$("#specialiteDiv").is(":hidden"))
                                 $("#specialiteDiv").hide();
                          if($("#med_id").prop('disabled') == true)
                                  $("#med_id").prop('disabled',false);
                          getProducts(2);
                        break;
                  case "3":
                            if(!$("#specialiteDiv").is(":hidden"))
                                   $("#specialiteDiv").hide();
                            getProducts(3);
                            break;
                  case "4":
                          $("#specialiteDiv").hide();
                if($("#med_id").prop('disabled') == true)
                      $("#med_id").prop('disabled',false);
                getProducts(4);
            break;
          default:
            break; 
        }
      });
      $('#specPrd').change(function(){
               getProducts($('#gamme').val(),$(this).val());
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