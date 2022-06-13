<script  type="text/javascript" charset="utf-8" async defer>
$('document').ready(function(){
  jQuery('body').on('click', '.delete-demandeRad', function (e) {
      event.preventDefault();
      var demande_id = $(this).val();
      $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
      });
      $.ajax({
          type: "DELETE",
          url: '/demandeexr/' + demande_id,
          success: function (data) {
            $("#demandeRad" + demande_id).remove();
          },
          error: function (data) {
            console.log('Error:', data);
          }
      });
  });
  $('#btn-addImgExam').click(function(){
    var selected = []; var array = [];
    $('#ExamIgtModal').modal('toggle');
    $.each($("input[name='exmns']:checked"), function(){
       selected.push($(this).next('label').text());
        array.push($(this).val());
    });   
    var exam = '<tr id="acte-'+$("#examensradio").val()+'"><td id="idExamen" hidden>'+$("#examensradio").val()+'</td><td>'+$("#examensradio option:selected").text()+'</td><td id ="types" hidden>'+array+'</td><td>'+selected+'</td><td class="center" width="5%">';
    exam += '<button type="button" class="btn btn-xs btn-danger delete-ExamImg" value="'+$("#examensradio").val()+'" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';     
    $('#ExamsImg').append(exam);
    $('#examensradio').val(' ').trigger('change');
    $(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
    if($(".requestPrint").prop('disabled') == true)
      $(".requestPrint").removeAttr("disabled");
  });
  $('body').on('click', '.delete-ExamImg', function () {
      $("#acte-" + $(this).val()).remove();
      var length = document.getElementById("ExamsImg").rows.length;
      if(length < 1)
        $(".requestPrint").attr('disabled','disabled');
  });
});

</script>