@extends('app_radiologue')
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
</style>
@endsection
@section('page-script')
<script>
/*function ComptRRPrint(){  var indication = $("#indication").val();        var techRea = $("#techRea").val();       var result  = $("#result").val();        var conclusion = $("#conclusion").val();var formData = { id : '{{-- $demande->id--}}', indic:indication,techRea:techRea, result:result,conclusion:conclusion }; $.ajaxSetup({headers: {  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')}  }); $.ajax({// headers: { // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')    // },        type: "POST",url :'/crrs/print', data:formData,dataType: "json", success: function (data,status, xhr) {   // $('#iframe-print').contents().find('html').html(data["html"]); $("#ccrajax").modal(); },  error: function (data) {console.log('Error:', data);  }        }) } */
 function ComptRRPrint()
{
       var indication = $("#indication").val();
        var techRea = $("#techRea").val();
        var result  = $("#result").val();
        var conclusion = $("#conclusion").val();
        var formData = {
             indic:indication,
             techRea:techRea,
             result:result,
             conclusion:conclusion
        };
        $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({  
              type: "POST", 
              url :'/crrPrint',
              data:formData,  //dataType: "json",
             success: function (viewContent,status, xhr) {      
                    document.title ="CCR";
                    $.print(viewContent);  // $('#iframe-print').contents().find('html').html(data["html"]); $("#ccrajax").modal();     
              },  
              error: function (data) {
                console.log('Error:', data);
              }
        })
}
function CRRPrint()
{
      /* var doc = new jsPDF() var tut = document.getElementById('tutelle'); doc.fromHTML(tut, 0, 10, { width: 160 }) var name = document.getElementById('etabname');doc.fromHTML(name, 10, 22, { width: 180 })var adr = document.getElementById('etabAdr');
      doc.fromHTML(adr, 10, 30, { width: 100 })    var adr = document.getElementById('etabTel ');*/
 }
  function CRRSave()
  {
    $.ajaxSetup({
      headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      var formData = {
        demande_id:'{{$demande->id}}',
        exam_id:$("#examId").val(),
        indication:$("#indication").val(),
        techRea:$("#techRea").val(),
        result:$("#result").val(),
        conclusion:$("#conclusion").val(),  
      };
      var state = jQuery('#crrSave').val();
      var type = "POST";
      var ajaxurl = '/crrs';
      if (state == "update") {
         var crr_id =  $('#crrId').val();
        type = "PUT";
        ajaxurl = '/crrs/' + crr_id;
      }
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType : 'json',
        success: (data) => {
          if (state == "add")
          {
            $('#crr-edit'+"-"+$("#examId").val()).val(data.id);
            $("button.cancel[value='"+$('#examId').val()+"']").addClass("hidden"); //hide cancel button  
          }
          if($('#crr-edit'+"-"+$("#examId").val()).hasClass("hidden"))
           $('#crr-edit'+"-"+$("#examId").val()).removeClass("hidden");
          if(!$('#crr-add'+"-"+$("#examId").val()).hasClass("hidden"))
            $('#crr-add'+"-"+$("#examId").val()).addClass("hidden");
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
      let TotalFiles = $("#exm-" + examId)[0].files.length;//let TotalFiles = $("#exm-" + $(this).val())[0].files.length;//Total files  
      let files = $("#exm-" + examId)[0];// let files = $("#exm-" + $(this).val())[0];
      for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
      }
      formData.append('TotalFiles', TotalFiles);
      formData.append('id_demandeexr', '{{ $demande->id }}');
      formData.append('id_examenradio',examId); // formData.append('id_examenradio',$(this).val());    
      $.ajax({
        type:'POST',
        url: "{{ url('store-file')}}",
        data: formData,
        enctype: 'multipart/form-data',
        contentType: false, 
        processData: false,
        dataType : 'json', 
        success: (data) => {
          $.each(data,function(key,value) {
            $('#'+value).remove();
          });
        },
        error: function(data){
          console.log(data);
        }
      });
  }
  $('document').ready(function(){
    $('.result').change(function() {
        var res = $(this).attr('id').replace("exm", "btn");
        if($(this).val())
          $('#'+res).removeAttr('disabled'); 
        else
          $('#'+res).attr('disabled', 'disabled');
    });
    $(".start").click( function(){
      if(!$('#crr-add'+"-"+$(this).val()).hasClass("hidden"))
      {
        Swal.fire({
              title: 'Compte Rendue ?',
              html: '<br/><h4><strong>'+'Voulez-Vous ajouter un Compte Rendue ?'+'</strong></h4>',
              icon: 'info',
              type:'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Oui',
               cancelButtonText: "Non",
        }).then((result) => {
          if(!isEmpty(result.value))
          {
            var examId =  $(this).val();
            $('#examId').val($(this).data('id'));
            jQuery('#CRRForm').trigger("reset");
            jQuery('#crrSave').val("add");
            $('#addCRRDialog').modal('show');
            $('#addCRRDialog').on('hidden.bs.modal', function (e) {
              uploadFiles(examId); //upload Files
            });
          }else
          {
            uploadFiles($(this).val());    
          }
        });
      }else
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
        }).then((result) => {
          if(!isEmpty(result.value))
          {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
              }
            });
            var formData = new FormData();
            formData.append('observation', result.value);
            formData.append('id_demandeexr', $('#id_demandeexr').val());
            formData.append('id_examenradio',$(this).val());
            $.ajax({
                type:'POST',
                url: "{{ url('cancel-exam')}}",
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {
                  $.each(data,function(key,value) {
                    $('#'+value).remove();
                  });
                },
                error: function(data){
                  console.log(data);                
                }
            });
          }
        })
    });
    $(".open-AddCRRDialog").click(function () {
        $('#examId').val($(this).data('id'));
        jQuery('#CRRForm').trigger("reset");
        jQuery('#crrSave').val("add");
        $('#addCRRDialog').modal('show');
    });
    $(".open-editCRRDialog").click(function (event) {
        event.preventDefault();
        $('#examId').val($(this).data('id'));
        var crr_id = $(this).val();
        $('#crrModalTitle').html('Editer un Compte Rendue Radiologique');
        $.get('/crrs/' + crr_id + '/edit', function (data) { 
          $('#crrId').val(data.id);
          $('#indication').val(data.indication);
          $('#techRea').val(data.techRea);
          $('#result').val(data.result);
          $('#conclusion').val(data.conclusion);
          jQuery('#crrSave').val("update");
          $('#addCRRDialog').modal('show');
        });
    });
});
  </script>
@endsection
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo')</div>
<div class="row">
    <div class="col-md-5 col-sm-5"><h3>  Demande Examens Radiologique</h3></div>
    <div class="col-md-7 col-sm-7">
      <a href="/showdemandeexr/{{ $demande->consultation->examensradiologiques->id }}" target="_blank" class="btn btn-sm btn-primary pull-right">
       <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer</a>&nbsp;&nbsp;
       @if('Auth::user()->role_id ' == 12)
         <a href="/listeexrs" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
       @else
         <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
       @endif
    </div>
</div><hr>
<div class="space-12 hidden-xs"></div>
<input type="hidden" id ="id_demandeexr" value="{{ $demande->id }}">
<div class="row">
<div class="col-xs-12 col-sm-9">
<div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="col-sm-6"><label class="control-label pull-right"><b>Date :</b></label></div>
    <div class="form-group col-sm-6">
      <label class="blue">
      @if(isset($demande->consultation))
          {{  (\Carbon\Carbon::parse($demande->consultation->Date_Consultation))->format('d/m/Y') }}
       @else
          {{  (\Carbon\Carbon::parse($demande->visite->date))->format('d/m/Y') }}
        @endif 
      </label>
    </div>
  </div>
</div>
 <div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="col-sm-6"><label class="control-label pull-right"><b>Medecin demandeur :</b></label></div>  
    <div class="form-group col-sm-6">
      <label class="blue">
      @if(isset($demande->consultation))
      {{ $demande->consultation->docteur->nom }} &nbsp;{{ $demande->consultation->docteur->prenom }}
      @else
       {{ $demande->visite->medecin->nom }} &nbsp;{{ $demande->visite->medecin->prenom }}
      @endif
      </label>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="col-sm-6"><label class="control-label pull-right"><b>Informations cliniques pertinentes :</b></label></div>
     <div class="form-group col-sm-6"><label class="blue">{{ $demande->InfosCliniques }}</label></div>
    </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="col-sm-6"><label class="control-label pull-right"><b>Explication de la demande de diagnostic :</b></label></div>
    <div class="form-group col-sm-6"><label class="blue"> {{ $demande->Explecations }} </label> </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="col-sm-6"><label class="control-label pull-right"><b>Explication de la demande de diagnostic :</b></label></div>
    <div class="form-group col-sm-6"><label class="blue"> {{ $demande->Explecations }} </label> </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="col-sm-6"><label class="control-label pull-right"><b>Informations supplémentaires pertinentes :</b></label></div>
    <div class="form-group col-sm-6">
      <label class="blue">
      <ul class="list-inline"> 
      @foreach($demande->infossuppdemande as $index => $info)
        <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
      @endforeach
      </ul>    
     </label>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-xs-12 widget-container-col">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><b>Demande d'examens radiologiques</b></h5></div>
      <div class="widget-body">
        <div class="widget-main">
         <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="center" width="10%">#</th>
                <th>Nom</th>
                <th class="center"><strong>Type</strong></th>
                <th class="center"><strong>Attacher le Résultat</strong></th>
                <td class="center" width="18%"><em class="fa fa-cog"></em></td>
              </tr>
            </thead>
            <tbody>
               @foreach ($demande->examensradios as $index => $examen)
                @if($examen->pivot->etat === null)
                <tr id = "{{ $examen->id }}">
                  <td class="center">{{ $index }}</td>
                  <td>{{ $examen->nom }}</td>
                  <td>
                    <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                    @foreach($exams as $id)
                    <span class="badge badge-success">{{ App\modeles\TypeExam::FindOrFail($id)->nom}}</span>
                    @endforeach
                  </td>
                  <td>
                    @if(Auth::user()->role->id == 12)
                      <input type="file" id="exm-{{ $examen->id }}" name="resultat[]" class="form-control result" accept="image/*,.pdf,.dcm,.DCM" multiple required/>
                    @endif
                  </td>
                  <td class="center" width="18%">
                    <button type="button" class="btn btn-md btn-success open-AddCRRDialog @if( isset($examen->pivot->crr_id)) hidden @endif" id ="crr-add-{{ $examen->id }}" data-toggle="modal" title="ajouter un Compte Rendu" data-id="{{ $examen->id }}">
                      <i class="glyphicon glyphicon-plus glyphicon glyphicon-white"></i>
                    </button>
                    <button type="button" class="btn btn-md btn-primary open-editCRRDialog @if(! isset($examen->pivot->crr_id)) hidden @endif" id ="crr-edit-{{ $examen->id }}" data-toggle="modal" title="Modifier le Compte Rendu" data-id="{{ $examen->id }}" value="{{ $examen->pivot->crr_id }}">
                      <i class="glyphicon glyphicon-edit glyphicon glyphicon-white"></i>
                    </button>
                    <button  type="submit" class="btn btn-md btn-info start" id="btn-{{ $examen->id }}" value ="{{ $examen->id }}" data-id="{{ $examen->id }}" disabled>
                      <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
                    </button>
                    @if(!isset($examen->pivot->crr_id ))
                    <button class="btn btn-md btn-warning cancel" value ="{{ $examen->id }}"><i class="glyphicon glyphicon-ban-circle glyphicon glyphicon-white"></i></button>
                    @endif
                  </td>
                </tr>
                @endif
                @endforeach
            </tbody>
          </table>
        </div>  
      </div>
    </div>
  </div> 
</div><!-- row tabel  -->
</div><!-- col-sm-6 -->
<div class="col-xs-12 col-sm-3" ></div>
</div>
<div class="space-12 hidden-xs"></div>
<div class="row" style="bottom:0px;">
  <div class="col-sm-12" >
    <form class="form-horizontal" method="POST" action="/uploadexr" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
      <div class="clearfix form-actions">
      <div class="col-md-offset-5 col-md-7">
        <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>
        <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>
      </div>
    </div>
    </form>
  </div>
</div>
<div class="row jumbotron text-center">@include('examenradio.CRRModal')</div> 
@endsection