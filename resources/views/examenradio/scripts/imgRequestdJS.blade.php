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
          }
      });
  });
  $('#btn-addImgExam').click(function(){
    var examImg, organe;
    $('#ExamIgtModal').modal('toggle');
    $.each($("input[name='exmns']:checked"), function(){
      examImg = $(this).next('label').text();
      organe= $(this).val();
    });
    var exam = '<tr id="acte-'+$("#examensradio").val()+'"><td id="idExamen" hidden>'+$("#examensradio").val()+'</td><td>'+$("#examensradio option:selected").text()+'</td><td id ="types" hidden>'+organe+'</td><td>'+examImg+'</td><td class="center" width="5%">';
    exam += '<button type="button" class="btn btn-xs btn-danger delete-ExamImg" value="'+$("#examensradio").val()+'" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';    
    $('#ExamsImg').append(exam);
    $('#examensradio').val('').trigger('change');
    $("#btn-addImgExam").attr("disabled", true);
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