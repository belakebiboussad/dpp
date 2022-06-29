<script  type="text/javascript" charset="utf-8" async defer>
$(function(){//edit,index
      $('#updateRDV').on('click', function(e) { 
          e.preventDefault();
          var  fixe = 1;
          if(!$("#fixe").prop('disabled'))
            if (!$("#fixe").is(':checked'))
              fixe = 0;
           var formData = {
                          _token: CSRF_TOKEN,
                          id : $(this).val(),
                          date : $("#daterdv").val(),
                          fin  : $("#datefinrdv").val(), 
                          fixe : fixe,       
          };
          if('{{ Auth::user()->role_id == 2 }}')
          {
            formData.specialite = $('#specialite').val();
            if('{{ $appointDoc }}' != null)
              formData.employ_id = $('#employ_id').val();
          }
          $.ajax({
             type : "PUT",
             url : '/rdv/' + $(this).val(),
             data: formData,
             dataType: 'json',
              success: function (data) {
                $('#fullCalModal').modal('hide');
              }
          });
        });
        $('#btnDelete').on('click keyup', function(e) {
              e.preventDefault();
              var eventDelete = confirm("êtes-vous sûr ?");
              if(eventDelete)
              {
                var formData = { _token: CSRF_TOKEN};
                $.ajax({
                  type: "DELETE",
                  url : '/rdv/' + $(this).val(),
                  data: formData,
                  success: function (data) {
                    $(".calendar1").fullCalendar('removeEvents', data.id);  
                  }
              }
        });
});
</script>