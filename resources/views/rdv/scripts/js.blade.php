<script  type="text/javascript" charset="utf-8" async defer>
function getDoctors(specid,appointDoct)
{
  $("#employ_id").empty().append('<option selected="selected" value="">Selectionner...</option>');
  if(specid != '')
  {
    if(appointDoct != null)
    {
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
      });
      $("#employ_id").prop('disabled',false);  
    }
  }  
}
</script>