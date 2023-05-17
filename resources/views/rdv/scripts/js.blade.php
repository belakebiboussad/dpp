<script  type="text/javascript" charset="utf-8" async defer>
function getDoctors(specid)
{
  $("#employ_id").empty().append('<option selected="selected" value="">Selectionner...</option>');
  var url = '{{ route("employs.index") }}';
  $.ajax({
    type : 'GET',
    url :url,
    data:{   id :   specid },
    success:function(data,status, xhr){
      $.each(data, function(i, empl) {
        $('#employ_id').append($('<option>', {
          value: empl.id,
          text: empl.full_name
        }));
      })
    }
  });//$("#employ_id").prop('disabled',false);  
}  
$(function(){
  $(".specialite" ).change(function() {
    if($(this).val() != '')
      getAppwithDocParamVal(3,$(this).val());    
    });
})
</script>