<script  type="text/javascript" charset="utf-8" async defer>
$(function(){
  $('#printRdv').click(function(e){
        $.ajax({
            type : 'GET',
            url :'/rdvprint/'+$(this).attr("data-id"),
            success:function(data){ },
            error:function(data){ console.log("error"); }
  
  });
    });
});
</script>