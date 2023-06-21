@extends('app')
@section('style')
<link rel="stylesheet" href="{{ asset('css/print.css') }}" />
<style>
  .modaldialog {
    width:92%;
  }
  iframe {
      display: block;
      margin: 0 auto;
      border: 0;
      position:relative;
      z-index:999;
  }
  #content {
    background: white;
    width: 98%;
    height: 100%;
    margin: 5px auto;
    border: 1px solid orange;
    padding: 10px;
  }
  /*#RDV {
    z-index: 1040 !important;
  }*/
/*  .select2-close-mask{
    z-index: 2099;
  }
  .select2-dropdown{
      z-index: 3051;
  }*/
</style>
@stop
@section('page-script')
@include('examenradio.scripts.imgRequestdJS')
<script>
function print()
{
  document.title = 'ordonnance-'+'{{ $obj->patient->Nom }}'+'-'+'{{ $obj->patient->Prenom}}';
  $('#iframe-pdf').get(0).contentWindow.print();document.title = 'Nouvelle Consultation';
}
function drugRemove(id)
{
  $("#"+id).remove();
}
function storeord()
{
  var arrayLignes = document.getElementById("ordonnance").rows;
  var longueur = arrayLignes.length; var ordonnance = []; 
  for(var i=1; i<longueur; i++)
  {
    ordonnance[i-1] = { med: arrayLignes[i].cells[0].innerHTML, posologie: arrayLignes[i].cells[4].innerHTML }
  }
  var champ = $("<input type='text' name ='listMeds' value='"+JSON.stringify(ordonnance)+"' hidden>");
  champ.appendTo('#consultForm');
}
function addmidifun()
{
  var med ='<tr id="'+$("#drugId").val()+'"><td hidden>'+$("#drugId").val()+'</td><td>'+$("#nommedic").val()+'</td><td class="priority-5">'+$("#forme").text()+'</td><td class="priority-5">'+$("#dosage").text()+'</td><td>'+$("#posologie").val()+'</td><td class ="bleu center">';
  med += '<button class="btn btn-xs btn-info open-modal" value="' + $("#drugId").val()+ '" onclick="editMedicm('+$("#drugId").val()+');drugRemove('+$("#drugId").val()+');"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button> ';
  med += '<button class="btn btn-xs btn-danger" value="' + $("#nommedic").val()+ '" onclick ="drugRemove('+$("#drugId").val()+')" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
  $("#ordonnance").append(med);
  $("#posologie").prop("disabled", true);$("#addDrugBtn").prop("disabled", true);
  $("#nommedic").val('');$("#forme").text('');$("#dosage").text('');$("#posologie").val('');
}
function editMedicm(id)
{
  $.get('/medicament/'+ id +'/edit', function (data) {
    $("#nommedic").val(data['Nom_com']); $("#forme").text(data['Forme']);
    $("#dosage").text(data.Dosage); $("#drugId").val(data['id']);
    $("#posologie").prop("disabled", false);$("#addDrugBtn").prop("disabled", false); 
  });
}
$(function(){ 
  if (performance.navigation.type == performance.navigation.TYPE_RELOAD) { 
    var consult_id = '{{ $obj->id }}'-1;
    var formData = {_token: CSRF_TOKEN };
    $.ajax({
          type: "DELETE",
          url: '/consultations/' + consult_id,
          data: formData,
          success: function (data) {}
    });
  }
  $.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';
  document.onkeydown = capturekey;document.onkeypress = capturekey;document.onkeyup = capturekey;
  document.addEventListener('contextmenu', event => {
    event.preventDefault(); 
  });
  imgToBase64("{{ asset('/img/entete.jpg') }}", function(base64) {
      base64Img = base64; 
  });
  imgToBase64("{{ asset('/img/footer.jpg') }}", function(base64) {
     footer64Img = base64; 
  });
  $("#isOriented").change(function() {
    if( $("#hidden_fields").hasClass('hidden'))
      $("#hidden_fields").removeClass('hidden');
    else {
      $("#hidden_fields").addClass('hidden');
      $("#lettreorientaioncontent").val("");
    }
  });
  $('.modal').on('hidden.bs.modal', function(e)
  { 
    $(this).find('form')[0].reset();
  });
  $("#EnregistrerAntecedant").click(function (e) {
    e.preventDefault();
    if($("#EnregistrerAntecedant").attr('data-atcd') == "Perso")
    {
      var tabName = "antsTab";
      var formData = {
         _token: CSRF_TOKEN,
        pid      : '{{ $obj->patient->id }}',
        Antecedant           : 'Personnels',
        typeAntecedant       : '0',
        stypeatcd            : jQuery('#sstypeatcdc').val(),
        date                    : $('#dateAntcd').val(),
        cim_code      :$('#cim_code').val(),
        description         : $("#description").val()
      };
    } else
    {
      var tabName = "antsFamTab";
      var formData = {
        _token: CSRF_TOKEN,
        pid   : '{{ $obj->patient->id }}',
        Antecedant         : 'Familiaux',
        date               : $('#dateAntcd').val(),
        cim_code           : $('#cim_code').val(),
        description       : $("#description").val()
      };
    }
    if(!($("#description").val() == ''))
    {  
      if($('.dataTables_empty').length > 0)
        $('.dataTables_empty').remove();
      var state = jQuery('#EnregistrerAntecedant').val();
      var type = "POST";
      var atcd_id = jQuery('#atcd_id').val();
      var ajaxurl = '/atcd';
      if (state == "update") {
        type = "PUT";
        ajaxurl = '/atcd/' + atcd_id;
      }   
      $.ajax({
         type: type,
         url: ajaxurl,
         data: formData,
         dataType: 'json',
         success: function (data) {
          if(data.Antecedant == "Personnels")
          {
            var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.pid + '</td><td>' + data.stypeatcd +'</td><td>'+ data.date +'</td><td>'+data.cim_code+ '</td><td>' + data.description + '</td>';
              atcd += '<td class ="center"><button class="btn btn-xs btn-success open-modal" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button> ';
            atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button></td></tr>';
          }else
          {
            var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.pid + '</td><td>' + data.date + '</td><td>' +data.cim_code
                + '</td><td>' + data.description + '</td>';
            atcd += '<td class ="center"><button class="btn btn-xs btn-success open-modalFamil" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button> ';
            atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button></td></tr>';
          }
          if (state == "add")
            $('#' + tabName+' tbody').append(atcd);
          else
            $("#atcd" + atcd_id).replaceWith(atcd);
           $('#antecedantModal').modal('hide');
        }
        });
      }          
    });
    $('body').on('click', '.open-modal', function (event) {//EDIT
      event.preventDefault();
      var atcd_id = $(this).val();
      $.get('/atcd/' + atcd_id, function (data) { 
        $('#atcd_id').val(data.id);
          $('#typeAntecedant').val(data.typeAntecedant).change();
        $('#sstypeatcdc').val(data.stypeatcd).change();//if(data.typeAntecedant   === 'Pathologiques')
        if($( "#atcdsstypehide" ).hasClass( "hidden" ))
          $( "#atcdsstypehide" ).removeClass("hidden"); 
        $('#dateAntcd').val(data.date);
        $('#cim_code').val(data.cim_code);
        $('#description').val(data.description);
        $("#EnregistrerAntecedant").attr('data-atcd',"Perso");
        $('#AntecCrudModal').html("Editer un Antecedant");  
        $('#EnregistrerAntecedant').val("update"); 
        $('#antecedantModal').modal('show');
      });
    });
    $('body').on('click', '.open-modalFamil', function (event) {
      event.preventDefault();
      var atcd_id = $(this).val();
      $.get('/atcd/' + atcd_id, function (data) { 
        $('#atcd_id').val(data.id);
        $('#dateAntcd').val(data.date);
        $('#cim_code').val(data.cim_code);
        $('#description').val(data.description);
        if(! ($( "#atcdsstypehide" ).hasClass( "hidden" )))
          $( "#atcdsstypehide" ).addClass("hidden"); 
        $('#EnregistrerAntecedant').val("update");
        $("#EnregistrerAntecedant").attr('data-atcd',"Famille") 
         $('#antecedantModal').modal('show');
      });
    });
    $("#EnregistrerAntecedantPhys").click(function (e) {
      e.preventDefault();
      var habitudeAlim = null; var tabac=null ; var ethylisme = null;
      var formData = {
        _token: CSRF_TOKEN,
        pid                  : '{{ $obj->patient->id }}',
        Antecedant           : 'Personnels',//$('#Antecedant').val()
        typeAntecedant       : '1',//$('#typeAntecedant').val(),
        date                 : $('#dateAntcdPhys').val(),
        cim_code             : $('#phys_cim_code').val(),
        description          : $("#descriptionPhys").val(),
        habitudeAlim         : $('#habitudeAlim').val()
      };
      formData.tabac = $("#tabac").is(":checked") ? 1:0;
      formData.ethylisme = $("#ethylisme").is(":checked") ? 1:0;
      if($('.dataTables_empty').length > 0)
        $('.dataTables_empty').remove();
      var state = $(this).val();
      var type = "POST";
      var atcd_id = $('#atcdPhys_id').val();
      var ajaxurl = '/atcd';
      if (state == "update") {
        type = "PUT";
        ajaxurl = '/atcd/' + atcd_id;
      } 
      $.ajax({
          type: type,
          url: ajaxurl,
          data: formData,
          dataType: 'json',
          success: function (data) {
            var tabac = data.tabac != 0 ? 'Oui' : 'Non';
            var ethylisme = data.ethylisme !=0 ? 'Oui' : 'Non';
            var atcd = '<tr id="atcd' + data.id + '"><td>' + data.date+'</td><td>' + data.cim_code + '</td><td>' + tabac + '</td><td>'+ ethylisme + '</td><td>'+ data.habitudeAlim + '</td><td>'+data.description +'</td>';
            atcd += '<td class ="center"><button class="btn btn-xs btn-success Phys-open-modal" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button> ';
            atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button></td></tr>';
            if (state == "add")
              $('#antsPhysTab tbody').append(atcd);
            else 
              $("#atcd" + atcd_id).replaceWith(atcd);
             $('#modalFormAntPhysio')[0].reset();
            $('#antecedantPhysioModal').modal('hide');
          }
      });
    });
    $('body').on('click', '.Phys-open-modal', function (event) {
      event.preventDefault();
      var atcd_id = $(this).val();
      $.get('/atcd/' + atcd_id, function (data) { 
        $('#atcdPhys_id').val(data.id);
        $('#dateAntcdPhys').val(data.date);
        $('#habitudeAlim').val(data.habitudeAlim);
        if(data.tabac)
          $('#tabac').prop('checked', true);
        if(data.ethylisme)
          $('#ethylisme').prop('checked', true);
        $('#phys_cim_code').val(data.cim_code);
        $('#descriptionPhys').val(data.description);
        $('#EnregistrerAntecedantPhys').val("update");
        $('#antecedantPhysioModal').modal('show');
      });
    });
    var confirmed = false;
    $("#consultForm").submit(function(event){
      event.preventDefault();
      if(!checkConsult())
      {
        activaTab("Interogatoire");
        return false;
      }else
       {
          if (!confirmed) {
            Swal.fire({ //title: 'Enregistrer Vous la Consultation ?',
            title:'<strong>êtes-vous sûr ?</strong>',
            type:'warning',
            html: '<br/><h4>Attention! En appuyant sur ce boutton, Vous allez Clôturer la Consulatation En cours</h4><br/><hr/>',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: "Non",//closeOnConfirm: true, //timer: 2000, //icon: 'warning',
            showCloseButton: true
          }).then((result) => {
              if(result.value)
              {
                confirmed = true; 
                if ($( "#ExamsImg" ).length )
                  addExamsImg(this);
                document.getElementById("consultForm").submit()
              }else
                return false; 
          });
        }
      }     
    });//calendrier 
    $(".apgar").ionRangeSlider({ min:0,max:10,step:1, values:5, grid:true, grid_num:10, postfix:"", skin:"big" });
    $(".shoutnbr").ionRangeSlider({ min:0,max:4,step:1, from:0, grid:true, grid_num:4, postfix:" fois", skin:"big" });
    $(".pcran").ionRangeSlider({ min:25,max:60,step:1, from:25, grid:true, grid_num:60, postfix:" cm", skin:"big" });
    $("#drugsPrint").click(function(){
      storeord();
      var fileName ='Ordonnance-' + '{{ $obj->patient->full_name }}' +'.pdf'; 
      ol = document.getElementById('listMeds');
      ol.innerHTML = '';
      $("#ordonnance tbody tr").each(function(key,value){
        $("ol").append('<li><h4>'+(key+1)+'- '+ $(this).find('td:eq(1)').text() 
                + '  '+ $(this).find('td:eq(2)').text() + '  '+ $(this).find('td:eq(3)').text()
                +'</h4><h5>'+$(this).find('td:eq(4)').text()+'</h5></li>');
      }); 
      var pdf = new jsPDF('p', 'pt', 'a4');
      JsBarcode("#barcode",'{{ $obj->patient->IPP }}' ,{
          format: "CODE128",
          width: 2,
          height: 30,
          textAlign: "left",
          fontSize: 12, 
          text: "IPP: " + '{{ $obj->patient->IPP }}' 
      });
      var canvas = document.getElementById('barcode');
      var jpegUrl = canvas.toDataURL("image/jpeg");
      pdf.addImage(jpegUrl, 'JPEG', 53, 180);
      generate(fileName,pdf,'ordPdf');
    });//teste
    $("#DHospadd").click(function(e){
      e.preventDefault();
      var formData = {
         _token             : CSRF_TOKEN,
        id_consultation     : '{{ $obj->id }}',
        modeAdmission       : $('#modeAdmissionHospi').val(), 
        specialite          : $('#specialiteHospi').val(),
        service             : $('#serviceHospi').val()
      };
      var type = "POST" , url = '';
      var state = $(this).val(); 
      if ( state == "update") {
        type = "PUT";
        url = '{{ route("demandehosp.update", ":slug") }}'; 
        url = url.replace(':slug',$("#dh_id").val());
      }else
        url ="{{ route('demandehosp.store') }}";
      $.ajax({
          type: type,
          url: url,
          data: formData,
          success: function (data) {
            if(state == "add")
            {
              $("#DHospadd").val("update");
              $("#dh_id").val(data.id);
            }
          }
      });
    }) 
});
</script>
@stop
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12">@include('patient._patientInfo',['patient'=>$obj->patient])</div></div>
  <div class="row">
    <form id ="consultForm" action="{{ route('consultations.store') }}" method="POST" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="patient_id" id="patient_id" value="{{ $obj->patient->id }}">
     <input type="hidden" name= "id" id= "id" value="{{ $obj->id }}">
    <div class="form-group" id="error" aria-live="polite">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
         @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
        </ul>
      </div>
    @endif
    </div>
    <div class="tabpanel">
      <ul class = "nav nav-pills nav-justified list-group" role="tablist">
        <li role= "presentation" class="col-md-4 in active">
          <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
          <span class="bigger-160" style="font-size:10vw">Interrogatoire</span>
          </a>
        </li>
            <li role= "presentation" class="col-md-4">
          <a href="#ExamClinique"  aria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg"> 
            <span class="bigger-160" style="font-size:10vw">Examens Cliniques</span></a>
        </li>
        <li role= "presentation" class="col-md-4">
            <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg">
            <span class="bigger-160" style="font-size:10vw">Examens Complémentaires</span>
          </a>
        </li>
      </ul>
      <div class ="tab-content no-border">
          <div role="tabpanel" class = "tab-pane active" id="Interogatoire">@include('consultations.Interogatoire')</div>
          <div role="tabpanel" class = "tab-pane" id="ExamClinique">@include('consultations.examenClinique')</div>
          <div role="tabpanel" class = "tab-pane" id="ExamComp">@include('ExamenCompl.index')</div>  
      </div>
    </div><!-- tabpanel -->
     <div class="row">
      <div class="col-sm12">
        <div class="center" style="bottom:0px;">
          <button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp;
          <a href="{{ route('consultations.destroy',$obj->id) }}" data-method="DELETE" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>
@if(count(array_intersect([1,3], $specialite->antecTypes()->pluck('id')->toArray())) > 0)
  @include('antecedents.ModalFoms.AntecedantModal')
@endif
@if(in_array(2,$specialite->antecTypes()->pluck('id')->toArray()))
@include('antecedents.ModalFoms.AntecedantModalPhysio')
@endif
@if(in_array(5,$specialite->antecTypes()->pluck('id')->toArray()))
<div class="row">@include('antecedents.ModalFoms.motherModal')</div>
@endif
@if(in_array(8,$specialite->antecTypes()->pluck('id')->toArray()))
@include('antecedents.ModalFoms.vaccinsModal')
@endif
@include('cim10.cimModalForm')
@include('ExamenCompl.ModalFoms.ExamenImgModal')
@include('consultations.ModalFoms.DemadeHospitalisation')
@include('consultations.ModalFoms.LettreOrientation')
@include('consultations.ModalFoms.Ordonnance')@include('consultations.ModalFoms.imprimerOrdonnanceAjax')   
@include('examenradio.ModalFoms.crrPrint')@include('consultations.ModalFoms.certificatDescriptif')
<div id="bioExamsPdf" class="hidden"> @include('consultations.EtatsSortie.demandeExamensBioPDF')</div>
<div id="imagExamsPdf" class="hidden">@include('consultations.EtatsSortie.demandeExamensImgPDF')</div>
<div id="ordPdf" class="hidden">@include('consultations.EtatsSortie.ordonnancePdf')</div>
<div id="OrientLetterPdf" class="hidden">@include('consultations.EtatsSortie.orienLetterPDF')</div>
{{-- <div id="certificatDescrPdf">@include('consultations.EtatsSortie.certifDescripPDF')</div> --}}
@stop