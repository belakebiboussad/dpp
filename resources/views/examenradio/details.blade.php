@extends('app')
@section('title','Demande Examens Imagerie')
@section('style')
<link rel="stylesheet" href="css/styles.css">
<style>
    iframe {
        display: block;
        margin: 0 auto;
        border: 0;
        position:relative;
        z-index:999;
    }
    .mt-12 { padding-top:-12px;}
    #pdfContent {
      background: #fff;
      width: 70%;
      height: 100px;
      margin: 20px auto;
      border: 1px solid black;
      padding: 20px;
  }
</style>
@endsection
@section('page-script')
<script>
function CRRPrint()
{ 
  var fileName ='compteRendRadio-'+'{{ $patient->Nom}}'+'-'+'{{ $patient->Prenom}}'+'.pdf';
  $("#conclusionPDF").text($("#conclusion").val());
  var pdf = new jsPDF('p', 'pt', 'a4');
  generate(fileName,pdf,'pdfContent');
}
function CRRSave()
{
    var formData = {
        _token: CSRF_TOKEN,
        conclusion:$("#conclusion").val(),  
    };
    var state = jQuery('#crrSave').val();
    if (state == "add") 
      formData.exam_id = $("#examId").val();
    var type = "POST", ajaxurl = '/crrs';
    if (state == "update") {
      type = "PUT";
      ajaxurl = '/crrs/' +  $('#crrId').val();
    }
    $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType : 'json',
            success: function (data) {
              if (state == "add")
              {
                $('#crr-edit-' + data.exId).removeClass("hidden");
                $('#crr-edit-' + data.exId).val(data.crrId);
                $('#crr-add-' + data.exId).addClass("hidden");     
              }  
           },
           error: function(data){
              console.log(data);
           }
     });
}
function uploadFiles(examId)
{
  var formData = new FormData();
  formData.append('_token', CSRF_TOKEN);
  formData.append('demande_id', '{{ $demande->id }}');
  formData.append('exam_id',examId); 
  formData.append("resultat", $("#exm-" + examId)[0].files[0]);
  $.ajax({
     type:'POST',
     url: "{{ url('store-res') }}",
     data: formData,
     enctype: 'multipart/form-data',
     contentType: false,
     processData: false, 
     success: function(data) {    
      $("#btn-"+data['exId']).addClass("hidden");
      $("#exm-"+data['exId']).addClass("hidden");
      $("#cancel-"+data['exId']).addClass("hidden");
      $("#delet-"+data['exId']).removeClass("hidden"); 
      url = '{{ URL::asset('storage/files') }}'+"/" +data['fileName'] ;
      $('<span>').appendTo( $("tr#"+ data["exId"]+" td").eq(4)).attr('id',"preview-"+data["exId"]).html(data['fileName']);  
     }
  });
}
$(function(){
      $('.result').change(function() {
            var res = $(this).attr('id').replace("exm", "btn");
            var crr = $(this).attr('id').replace("exm", "crr-add");
             var preview = $(this).attr('id').replace("exm", "preview");
             if( this.files &&  this.files[0])
             {
                    $('#'+res).removeAttr('disabled'); //$('#'+crr).removeAttr('disabled');   
            }else
                  $('#'+res).attr('disabled', 'disabled'); 
      }) ; 
      imgToBase64("{{ asset('/img/entete.jpg') }}", function(base64) {
          base64Img = base64; 
        });
      imgToBase64("{{ asset('/img/footer.jpg') }}", function(base64) {
        footer64Img = base64; 
      });    
      $(".start").click( function(e){
        e.preventDefault();
        var id  = "#exm-"+$(this).val();
        if ($(id)[0].files.length !== 0) 
          uploadFiles($(this).val());
        });
       $(".cancel").click( function(){
         Swal.fire({
            title: 'Annulez vous  la demande d\'Examen ?',
            icon: 'warning',
            type:'warning',
            html: '<br/><h4><b>'+'Pourquoi?'+'</b></h4>',
            input: 'textarea',
            inputPlaceholder: 'la cause d\'annulation du l\'examen',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: "Non",
            allowOutsideClick: false,
            showCloseButton: true
         }).then((result) => {
                     var formData = {
                            _token: CSRF_TOKEN,
                             demande_id:'{{ $demande->id }}',
                             exmId:$(this).val(),
                            observation: result.value,  
                      };
                      $.ajax({
                            type:'POST',
                             url: "{{ url('cancel-exam') }}",
                            data: formData,
                            dataType : 'json',
                            success: (data) => {
                              $('#'+data).remove();
                            },
                            error: function(data){
                              console.log(data);                
                            }
                      });
          })
       });
      $(".open-AddCRRDialog").click(function () { 
        $('#examId').val($(this).val());
        $('#CRRForm').trigger("reset");
        $('#crrSave').val("add");
        $('#addCRRDialog').modal('show');
      });
      $(".open-editCRRDialog").click(function () { 
         $('#CRRForm').trigger("reset");
         crrId =  $(this).val();
         $.get('/crrs/' +crrId+'/edit', function (data) { 
            jQuery('#conclusion').val(data.conclusion);
            $('#crrModalTitle').html('Editer le compte rendue radiologique');
            $('#crrId').val(data.id);
            jQuery('#crrSave').val("update");
            $('#crbm').text(data.conclusion);
            $('#addCRRDialog').modal('show');
         })
       });
       $(".deleteExam").click(function () { 
          event.preventDefault();
          var examId =  $(this).val();  
          var formData = { _token: CSRF_TOKEN, examId : examId };
          $.ajax({
           type: "POST",
           url: "{{ url('delete-res') }}",
           data: formData,
           dataType : 'json', 
            success: function (data) {
              $("#btn-" + data.id).removeClass("hidden");
              $("#cancel-" + data.id).removeClass("hidden");
              $("#exm-" + data.id).removeClass("hidden");
              $("#delet-" + data.id).addClass("hidden");
              $('#crr-edit-' + data.id).val();
              $('#crr-edit-' + data.id).addClass("hidden");
              $('#crr-add-' + data.id).removeClass("hidden");
              $("tr#"+ data.id + " td").eq(4).html('');
            },
         }); 
      })
  });
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="page-header"> @include('patient._patientInfo')</div>
  <div class="row">
      <div class="col-md-5 col-sm-5"><h4>Demande d'examen radiologique</h4></div>
      <div class="col-md-7 col-sm-7 btn-toolbar">
        <a href="/drToPDF/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-success pull-right">
          <i class="ace-icon fa fa-print"></i> Imprimer</a> 
        @if(Auth::user()->role_id  == 12)
        <a href="/home" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>  precedant</a>
        @else
        <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i> precedant</a>
          @endif
      </div>
  </div><hr>
  <div class="row"><div class="col-xs-12">@include('examenradio.partials._show')</div></div>
   <div class="row">
    <div class="col-sm-12 col-xs-12 widget-container-col">
      <div class="widget-box">
        <div class="widget-header"><h5 class="widget-title">Examens radiologique demadés</h5></div>
        <div class="widget-body">
          <div class="widget-main">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="center" width="5%">N°</th><th>Nom</th>
                <th class="center">Type</th><th class="center">Attacher le résultat</th>
                <th class="center">Résultat</th><td class="center" width="18%"><em class="fa fa-cog"></em></td>
              </tr>
            </thead>
            <tbody>
            @foreach ($demande->examensradios as $index => $examen) 
              @if($examen->etat !== 0)
              <tr id = "{{ $examen->id }}">
                <td class="center">{{ $index+1 }}</td>
                <td>{{ $examen->Examen->nom }}</td>
                <td><span class="badge badge-success">{{ $examen->Type->nom }}</span></td>
                <td class="center">
                <input type="file" id="exm-{{ $examen->id }}" name="resultat" class="form-control-file result{!! isInprog($examen) !!}" accept="image/*, .pdf,*/dicom, .dcm, image/dcm, */dcm, .dico,.rar" required/></td>
                <td class="center" width="30%">
                  <?php  $explodeImage = explode('.', $examen->resultat);  $extension = end($explodeImage);  ?> 
                  @if($examen->getEtatID() ===1)
                  <span id="preview-{{ $examen->id }}">{{ $examen->resultat }}</span>
                 @endif      
                </td>
                <td class="center" width="18%">
                @if($examen->getEtatID() !==0)<!-- non rejete -->
                <button  type="button" class="btn btn-sm btn-info start{!! isInprog($examen) !!}" id="btn-{{ $examen->id }}" value ="{{ $examen->id }}" disabled><i class="glyphicon glyphicon-upload glyphicon"></i>
                </button>
                <button type="button" class="btn btn-sm btn-success open-AddCRRDialog{{ isset($examen->crr_id) ? ' hidden' : '' }}" data-toggle="modal" title="ajouter un compte rendu" value="{{ $examen->id }}" id ="crr-add-{{ $examen->id }}">
                  <i class="glyphicon glyphicon-plus glyphicon"></i>
                </button>
                <button type="button" class="btn btn-sm btn-primary open-editCRRDialog{{ (isset($examen->crr_id)) ? ' ' : ' hidden' }}" id ="crr-edit-{{ $examen->id }}" data-toggle="modal" title="Modifier le compte rendu" value="{{ $examen->crr_id }}"><i class="glyphicon glyphicon-edit glyphicon"></i>
                </button>
                <button class="btn btn-sm btn-warning cancel{{ ($examen->getEtatID() === 1) ? ' hidden' :'' }}" id="cancel-{{ $examen->id }}" value = '{{ $examen->id }}'><i class="glyphicon glyphicon-ban-circle glyphicon"></i></button>
                <button type="button" class="btn btn-sm btn-danger deleteExam{{ ($examen->getEtatID() === 1) ? '' :' hidden' }}" id ="delet-{{ $examen->id }}" data-toggle="modal" title="Supprimer le résultat du l'examen"  value="{{ $examen->id }}" data-crr="{{ $examen->crr_id }}">
                  <i class="glyphicon glyphicon-trash glyphicon"></i>
                </button>
                @else
                <span class="badge badge-warning">{{ $examen->etat }}</span>
                @endif
                </td>
              </tr>
              @endif
              @endforeach
              </tbody>
            </table>
          </div><!-- main -->
        </div> <!-- body -->
      </div><!-- box -->
    </div>
  </div>
  <div class="row"><div id="pdfContent" class="hidden">@include('examenradio.EtatsSortie.crrClient')</div></div><div class="space-12 hidden-xs"></div>
  <div class="row">
    <div class="col-sm-12 center">
      <form method="POST" action="{{ route('demandeexr.update',$demande->id) }}" enctype="multipart/form-data"> 
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="demande_id" value="{{ $demande->id }}">
         <button class="btn btn-info btn-xs" type="submit"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
        <a class="btn btn-warning btn-xs" href="{{ URL::previous() }}"><i class="ace-icon fa fa-undo"></i> Annuler</a>
      </form>
    </div>
  </div>
</div>
@include('examenradio.ModalFoms.CRRModal'){{-- @include('examenradio.ModalFoms.crrPrint') --}}
@endsection