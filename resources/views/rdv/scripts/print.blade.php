<script  type="text/javascript" charset="utf-8" async defer>
$(function(){
  $('#printRdv').click(function(e){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
              }
        });
        $.ajax({
                type : 'GET',
                //url :'/rdvprint/'+$('#idRDV').val(),
                url :'/rdvprint/'+$(this).attr("data-id"),
               success:function(data){ },
               error:function(data){
                      console.log("error");
               }
  });
    });
});
</script>