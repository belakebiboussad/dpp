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
  }/*.b{ height:20px !important;  }*/
  #content {
    background: white;
    width: 98%;
    height: 100%;
    margin: 5px auto;
    border: 1px solid orange;
    padding: 10px;
  }
  #RDV {
    z-index: 1040 !important;
  }
</style>
@endsection
@section('page-script')
@include('examenradio.scripts.imgRequestdJS')
<script>
function print()
{
  document.title = 'ordonnance-'+'{{ $patient->Nom }}'+'-'+'{{ $patient->Prenom}}';
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
  var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(ordonnance)+"' hidden>");
  champ.appendTo('#consultForm');
}
function resetField()
{
  $("#description").val('');$('#dateAntcd').val('');
}
function addmidifun()
{
  var med ='<tr id="'+$("#id_medicament").val()+'"><td hidden>'+$("#id_medicament").val()+'</td><td>'+$("#nommedic").val()+'</td><td class="priority-5">'+$("#forme").val()+'</td><td class="priority-5">'+$("#dosage").val()+'</td><td>'+$("#posologie_medic").val()+'</td><td class ="bleu center">';
  med += '<button class="btn btn-xs btn-info open-modal" value="' + $("#id_medicament").val()+ '" onclick="editMedicm('+$("#id_medicament").val()+');drugRemove('+$("#id_medicament").val()+');"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
  med += '<button class="btn btn-xs btn-danger delete-atcd" value="' + $("#nommedic").val()+ '" onclick ="drugRemove('+$("#id_medicament").val()+')" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
  $("#ordonnance").append(med);
  $(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
  $("#nommedic").val('');$("#forme").val('');$("#dosage").val('');$("#posologie_medic").val('');
}
function editMedicm(med)
{
  $.ajax({
      type: 'GET',
      url: '/getmed/'+med,
      dataType: "json",
      success: function (result)
      {
        $("#nommedic").val(result['Nom_com']); $("#forme").val(result['Forme']);
        $("#dosage").val(result.Dosage);$("#id_medicament").val(result['id']);
        $(".disabledElem").removeClass("disabledElem").addClass("enabledElem");
      }
    });
}/*function rowDelete(id){  $("#"+id).remove();}*/
function warning()
{
  return "dzd"; //U can write any custom message here.
}
$(function(){ 
  if (performance.navigation.type == performance.navigation.TYPE_RELOAD) { //ajax delete consult
    var consult_id = '{{ $consult->id }}'-1;
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
  });//var date = new Date('{{ $patient->Dat_Naissance }}'); $( ".gdob" ).datepicker( "option", "minDate", date );  /*$( 'ul.nav li' ).on( 'click', function() {  $(this).siblings().addClass('filter'); });*/
  /*$('#select2-multiple-style .btn').on('click', function(e){  var target = $(this).find('input[type=radio]');  var which = parseInt(target.val());if(which == 2) $('.select2').addClass('tag-input-style'); else  $('.select2').removeClass('tag-input-style');});*/
  $("#isOriented").change(function() {
    if( $("#hidden_fields").hasClass('hidden'))
      $("#hidden_fields").removeClass('hidden');//show();
    else {
      $("#hidden_fields").addClass('hidden');
      $("#lettreorientaioncontent").val("");
    }
  });/*$(".two-decimals").change(function(){    this.value = parseFloat(this.value).toFixed(2); });*/
/* pas sup pas verif $("button").click(function (event) {which = '';str ='send';which = $(this).attr("id");var which = $.trim(which);var str = $.trim(str);if(which==str){return true;}  });*//*$("#btnCalc").click(function(event){event.preventDefault(); });*/
  $('#medc_table').DataTable({
      processing: true,
      serverSide: true,
      ordering: true,
      bInfo : false,
      searching: true,
      pageLength: 5,
      bLengthChange: false,
      nowrap:true,
      "language": {
        "url": '/localisation/fr_FR.json'
      },
      ajax: '/getmedicaments',
      columns: [
        {data: 'Nom_com'},
        {data: 'Forme',className: "priority-3" , orderable: false},
        {data: 'Dosage' , orderable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ],
      columnDefs: [
        { "targets": 3 ,  className: "dt-head-center dt-body-center" }
      ],
    });
  $('#btn-addAntPhys').click(function () {// //antecedant Physiologique
    $('#EnregistrerAntecedantPhys').val("add");
    $('#modalFormDataPhysio').trigger("reset");
    $('#AntecPhysCrudModal').html("Ajouter un antécédent");
    $('#antecedantPhysioModal').modal('show');
  });
  $("#EnregistrerAntecedant").click(function (e) {
    e.preventDefault();
    if($("#EnregistrerAntecedant").attr('data-atcd') == "Perso")
    {
      var tabName = "antsTab";
      var formData = {
         _token: CSRF_TOKEN,
        pid      : '{{ $patient->id }}',
        Antecedant           : 'Personnels',//jQuery('#Antecedant').val()
        typeAntecedant       : '0',//jQuery('#typeAntecedant').val(),
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
        pid   : '{{ $patient->id }}',
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
              atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
            atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
          }else
          {
            var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.pid + '</td><td>' + data.date + '</td><td>' +data.cim_code
                + '</td><td>' + data.description + '</td>';
            atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modalFamil" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
            atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
          }
            if (state == "add")
              $('#' + tabName+' tbody').append(atcd);
            else
              $("#atcd" + atcd_id).replaceWith(atcd);
            $('#modalFormAnt').trigger("reset");
            $('#antecedantModal').modal('hide');
        },
        error: function (data) {
            console.log('Error:', data);
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
    $("#EnregistrerAntecedantPhys").click(function (e) {
      e.preventDefault();
      var habitudeAlim = null; var tabac=null ; var ethylisme = null;
      var formData = {
        _token: CSRF_TOKEN,
        pid                  : '{{ $patient->id }}',
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
              atcd += '<td class ="center"><button class="btn btn-xs btn-info Phys-open-modal" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
              atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
              if (state == "add")
                $('#antsPhysTab tbody').append(atcd);
              else 
                $("#atcd" + atcd_id).replaceWith(atcd);
              $('#antecedantPhysioModal').modal('hide');
          },
          error: function (data) {
            console.log('Error:', data);
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
            html: '<br/><h4>Attention! En appuyant sur ce boutton, Vous allez Clôturer la Consulatation en Cours</h4><br/><hr/>',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: "Non",
            //closeOnConfirm: true, //timer: 2000, //icon: 'warning',
            showCloseButton: true
          }).then((result) => {
              if(result.value)
              {
                confirmed = true; 
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
      var fileName ='Ordonnance-' + '{{ $patient->full_name }}' +'.pdf'; 
      ol = document.getElementById('listMeds');
      ol.innerHTML = '';
      $("#ordonnance tbody tr").each(function(key,value){
        $("ol").append('<li><h4>'+(key+1)+'- '+ $(this).find('td:eq(1)').text() 
                + ' &nbsp; &nbsp;'+ $(this).find('td:eq(2)').text()
                + ' &nbsp; &nbsp;'+ $(this).find('td:eq(3)').text()
                +'</h4><h5>'+$(this).find('td:eq(4)').text()+'</h5></li>');
      }); 
      var pdf = new jsPDF('p', 'pt', 'a4');
      JsBarcode("#barcode",'{{ $patient->IPP }}' ,{
          format: "CODE128",
          width: 2,
          height: 30,
          textAlign: "left",
          fontSize: 12, 
          text: "IPP: " + '{{ $patient->IPP }}' 
      });
      var canvas = document.getElementById('barcode');
      var jpegUrl = canvas.toDataURL("image/jpeg");
      pdf.addImage(jpegUrl, 'JPEG', 55, 165);
      generate(fileName,pdf,'ordPdf');
    });//teste
    $("#DHospadd").click(function(e){
      e.preventDefault();
      var formData = {
         _token             : CSRF_TOKEN,
        id_consultation     : '{{ $consult->id }}',
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
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12">@include('patient._patientInfo')</div></div>
  <div class="row">
    <form  class="form-horizontal" id ="consultForm" action="{{ route('consultations.store') }}" method="POST" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
     <input type="hidden" name= "id" id= "id" value="{{ $consult->id }}">
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
          <button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp;
          <a href="{{ route('consultations.destroy',$consult->id) }}" data-method="DELETE" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>
@include('antecedents.AntecedantModal')@include('antecedents.AntecedantModalPhysio')
@include('cim10.cimModalForm')@include('consultations.ModalFoms.DemadeHospitalisation')
@include('consultations.ModalFoms.LettreOrientation')
@include('consultations.ModalFoms.Ordonnance')@include('consultations.ModalFoms.imprimerOrdonnanceAjax')
@include('examenradio.ModalFoms.crrPrint')@include('consultations.ModalFoms.certificatDescriptif')
<div id="bioExamsPdf" class="hidden"> @include('consultations.EtatsSortie.demandeExamensBioPDF')</div>
<div id="imagExamsPdf" class="hidden">@include('consultations.EtatsSortie.demandeExamensImgPDF')</div>
<div id="ordPdf" class="hidden">@include('consultations.EtatsSortie.ordonnancePdf')</div>
<div id="OrientLetterPdf" class="hidden">@include('consultations.EtatsSortie.orienLetterPDF')</div>
<div id="certificatDescrPdf" class="hidden">@include('consultations.EtatsSortie.certifDescripPDF')</div>
@endsection