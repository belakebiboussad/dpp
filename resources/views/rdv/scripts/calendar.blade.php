<script  type="text/javascript" charset="utf-8" async defer>
$(function(){
      //edit,index
      $('#updateRDV').on('click keyup', function(e) { 
              e.preventDefault();
               var  fixe = 1;
               if(!$("#fixe").prop('disabled'))
                    if (!$("#fixe").is(':checked'))
                            fixe = 0;
               var formData = {
                              id : $(this).val(),
                              date : $("#daterdv").val(),
                              fin  : $("#datefinrdv").val(), 
                              fixe : fixe,       
              };
               if('{{ Auth::user()->role_id == 2 }}')
                    formData.specialite = $('#specialite').val();
                     $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                  $.ajax({
                     type : "PUT",
                     url : '/rdv/' + $(this).val(),
                     data: formData,
                     dataType: 'json',
                      success: function (data) {
                        $('#fullCalModal').modal('hide');
                      },
                      error : function(data){
                           console.log('Error:', data);
                      }
                  });
        });
        $('#btnDelete').on('click keyup', function(e) {
                  e.preventDefault();
                  var eventDelete = confirm("êtes-vous sûr ?");
                  if(eventDelete)
                  {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                      type: "DELETE",
                      url: '/rdv/' + $(this).val(),
                      success: function (data) {
                        $(".calendar1").fullCalendar('removeEvents', data.id);  
                      },
                      error: function (data) {
                             console.log('Error:', data);
                      }
                    });
                  }
        });
});
</script>