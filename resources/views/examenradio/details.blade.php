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
  $("#conclusionPDF").text($("#conclusion").val());
  var pdf = new jsPDF('p', 'pt', 'a4');
  generate(pdf,'pdfContent');
}
function CRRSave()
{
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
      }
    });
    var formData = {
      conclusion:$("#conclusion").val(),  
    };
    var state = jQuery('#crrSave').val();
    if (state == "add") 
      formData.exam_id = $("#examId").val();
    var type = "POST";
    var ajaxurl = '/crrs';
    if (state == "update") {
      type = "PUT";
      ajaxurl = '/crrs/' +  $('#crrId').val();
    }
    $.ajax({
           type: type,
           url: ajaxurl,
           data: formData,
           dataType : 'json',
           success: (data) => {
                  if (state == "add")
                  {
                         $('#crr-edit-'+data).removeClass("hidden");$('#crr-add-'+data).addClass("hidden");     
                  }  
           },
           error: function(data){
                  console.log(data);
           }
     });
}
function uploadFiles(examId)
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });
  var formData = new FormData();
  formData.append('demande_id', '{{ $demande->id }}');
  formData.append('exam_id',examId); 
  formData.append("resultat", $("#exm-" + examId)[0].files[0]);
  $.ajax({
     type:'POST',
     url: "{{ url('store-file') }}",
     data: formData,
     enctype: 'multipart/form-data',
     contentType: false,
     processData: false,
     dataType : 'json', 
     success: (data) => {    
      $("#btn-"+data['exId']).addClass("hidden");
      $("#exm-"+data['exId']).addClass("hidden");
      $("#cancel-"+data['exId']).addClass("hidden");
      $("#delet-"+data['exId']).removeClass("hidden"); 
      url = '{{ URL::asset('storage/files') }}'+"/" +data['fileName'] ;/*if(data['isImg']) $('<img>').appendTo( $("tr#"+ data["exId"]+" td").eq(4)).attr('src',url).attr('id',"preview-"+data["exId"]).attr('style','width:10%');   else*/
       $('<span>').appendTo( $("tr#"+ data["exId"]+" td").eq(4)).attr('id',"preview-"+data["exId"]).html(data['fileName']);   
     },
     error: function(data){
           console.log(data);
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
                  $('#'+res).attr('disabled', 'disabled'); //$('#'+crr).attr('disabled', 'disabled'); 
      }) ; 
      imgToBase64("{{ asset('/img/entete.jpg') }}", function(base64) {
          base64Img = base64; 
        });
        imgToBase64("{{ asset('/img/footer.jpg') }}", function(base64) {
          footer64Img = base64; 
        });    
      $(".start").click( function(e){
        e.preventDefault(); //if(!$('#crr-add'+"-"+$(this).val()).hasClass("hidden"))
        var  id  = "#exm-"+$(this).val();
        if ($(id)[0].files.length !== 0) 
        {
          uploadFiles($(this).val()); 
        }
       });
       $(".cancel").click( function(){
             Swal.fire({
                    title: 'Annulez vous  la demande d\'Examen ?',
                    icon: 'warning',
                    type:'warning',
                    html: '<br/><h4><strong>'+'Pourquoi?'+'</strong></h4>',
                    input: 'textarea',
                    inputPlaceholder: 'la cause d\'annulation du l\'examen',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui',
                    cancelButtonText: "Non",
                    allowOutsideClick: false,
             }).then((result) => {
                          $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                 }
                          }); 
                         var formData = {
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
             jQuery('#CRRForm').trigger("reset");
             jQuery('#crrSave').val("add");
              $('#addCRRDialog').modal('show');
      });
      $(".open-editCRRDialog").click(function () { 
         jQuery('#CRRForm').trigger("reset");
         crrId =  $(this).val();
         $.get('/crrs/' +crrId+'/edit', function (data) { 
            jQuery('#conclusion').val(data.conclusion);
            $('#crrModalTitle').html('Editer un compte rendue radiologique');
            $('#crrId').val(data.id);
            jQuery('#crrSave').val("update");
            $('#addCRRDialog').modal('show');
         })
       });
       $(".deleteExam").click(function () { 
             event.preventDefault();
             var examId =  $(this).val();  
             $.ajaxSetup({
                   headers: {
                          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
             });
              var formData = {
                 examId : examId ,
            };
            $.ajax({
               type: "POST",
               url: "{{ url('delete-file') }}",
               data: formData,
               dataType : 'json', 
                success: function (data) {
                  $("#btn-"+data).removeClass("hidden");
                  $("#cancel-"+data).removeClass("hidden");
                  $("#exm-"+data).removeClass("hidden");
                  $("#delet-"+data).addClass("hidden");
                  $("tr#"+ data+" td").eq(4).html('');
                },
              error: function (data) {
                  console.log('Error:', data);
              }
             }); 
      })
  });
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="row" width="100%">@include('patient._patientInfo')</div>
  <div class="row">
      <div class="col-md-5 col-sm-5"><h4> <strong>Demande d'examen radiologique</strong></h4></div>
      <div class="col-md-7 col-sm-7 btn-toolbar">
        <a href="/drToPDF/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-success pull-right">
          <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer</a>&nbsp;&nbsp;
          @if(Auth::user()->role_id  == 12)
           <a href="/home" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
          @else
           <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
          @endif
      </div>
  </div><hr> <div class="space-12 hidden-xs"></div>
  <div class="row">
    <div class="col-xs-12">
       @include('examenradio.partials._show')
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-xs-12 widget-container-col">
      <div class="widget-box">
        <div class="widget-header"><h5 class="widget-title"><b>Examens radiologique demadés</b></h5></div>
        <div class="widget-body">
          <div class="widget-main">
           <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="center" width="10%">N°</th>
                  <th>Nom</th>
                  <th class="center"><strong>Type</strong></th>
                  <th class="center"><strong>Attacher le résultat</strong></th>
                  <th class="center"><strong>Résultat</strong></th>
                  <td class="center" width="18%"><em class="fa fa-cog"></em></td>
                </tr>
              </thead>
              <tbody>
                @foreach ($demande->examensradios as $index => $examen) 
                    @if($examen->etat !== 0)
                    <tr id = "{{ $examen->id }}">
                      <td class="center">{{ $index+1 }}</td>
                      <td>{{ $examen->Examen->nom }}</td>
                      <td><span class="badge badge-success">{{ $examen->Type->nom }}</span></td>
                      <td class="center"> {{-- @if((Auth::user()->role->id == 12) && ($examen->getEtatID($examen->etat) == ""))@endif --}}
                        <input type="file" id="exm-{{ $examen->id }}" name="resultat" class="form-control result {{ ((Auth::user()->role->id !== 12) || ($examen->getEtatID($examen->etat) !== ""))?'hidden':'' }}" accept="image/*, .pdf,*/dicom, .dcm, image/dcm, */dcm, .dico,.rar" required/>
                      </td>
                      <td class="center" width="30%">
                        <?php  $explodeImage = explode('.', $examen->resultat);  $extension = end($explodeImage);  ?> 
                        @if($examen->getEtatID($examen->etat) ===1)
                       {{--   @if(in_array($extension, config('constants.imageExtensions')))
                         <img  id="preview-{{ $examen->id }}"  src="{{ asset('storage/files/'.$examen->resultat) }}"  style="width:10%"/>
                            src="{{ url('/files/'.$examen->resultat) }}"@else   <span id="preview-{{ $examen->id }}">{{ $examen->resultat }}</span>@endif --}}
                        <span id="preview-{{ $examen->id }}">{{ $examen->resultat }}</span>
                       @endif      
                      </td>
                      <td class="center" width="18%">
                      @if($examen->getEtatID($examen->etat) !==0)<!-- non rejete -->
                      <button  type="button" class="btn btn-sm btn-info start{{ ($examen->getEtatID($examen->etat) ==="" ) ? '' : ' hidden' }}" id="btn-{{ $examen->id }}" value ="{{ $examen->id }}" disabled><i class="glyphicon glyphicon-upload glyphicon"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-success open-AddCRRDialog{{ isset($examen->crr_id) ? ' hidden' : '' }}" data-toggle="modal" title="ajouter un compte rendu" value="{{ $examen->id }}" id ="crr-add-{{ $examen->id }}">
                        <i class="glyphicon glyphicon-plus glyphicon"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-primary open-editCRRDialog{{ (isset($examen->crr_id)) ? ' ' : ' hidden' }}" id ="crr-edit-{{ $examen->id }}" data-toggle="modal" title="Modifier le compte rendu" value="{{ $examen->crr_id }}"><i class="glyphicon glyphicon-edit glyphicon"></i>
                      </button>
                      <button class="btn btn-sm btn-warning cancel{{ ($examen->getEtatID($examen->etat) === 1) ? ' hidden' :'' }}" id="cancel-{{ $examen->id }}" value = '{{ $examen->id }}'><i class="glyphicon glyphicon-ban-circle glyphicon"></i></button>
                      <button type="button" class="btn btn-sm btn-danger deleteExam{{ ($examen->getEtatID($examen->etat) === 1) ? '' :' hidden' }}" id ="delet-{{ $examen->id }}" data-toggle="modal" title="Supprimer le résultat du l'examen"  value="{{ $examen->id }}" data-crr="{{ $examen->crr_id }}">
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
  <div class="row"><div id="pdfContent" class="hidden">@include('examenradio.EtatsSortie.crrClient')</div></div>
  <div class="space-12 hidden-xs"></div>
  <div class="row" style="bottom:0px;">
    <div class="col-sm-12">
      <form class="form-horizontal" method="POST" action="{{ route('demandeexr.update',$demande->id) }}" enctype="multipart/form-data"> 
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="text" name="demande_id" value="{{ $demande->id }}" hidden>
        <div class="col-md-offset-5 col-md-7">
        <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>
        <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>
         </div>
      </form>
    </div>
  </div>
</div>
<div class="row text-center">@include('examenradio.ModalFoms.CRRModal')</div>
<div class="row text-center">@include('examenradio.ModalFoms.crrPrint')</div>  
@endsection