@extends('app')
@section('title')Hospitalisations @stop
@section('style')
<style>
 .bootstrap-timepicker-meridian, .meridian-column
 {
     display: none;
 }  
 .bootstrap-timepicker-widget table tr:nth-child(3)>td:last-child a {
  display: none;
}
.bootstrap-timepicker-widget table tr:nth-child(1)>td:last-child a {
  display: none;
}
.ui-timepicker-container {
      z-index: 3500 !important;
 }
</style>
 @stop
@section('page-script')
<script>
    var nowDate = new Date();
    var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
     function cloturerHosp(id)
     { 
        $("#id").val(id);
        $('#sortieHosp').modal('show');
        $('#Heure_sortie').timepicker({ template: 'modal' });
     }
     function codeBPrint(id)
     {
        event.preventDefault();
        var formData = { id: id };
        $.ajax({
             type : 'get',
             url : "{{ URL::to('barreCodeprint') }}",
             data:formData,
             success(data){  },
        });
     }
     function getAction(data, type, dataToSet) {
      var rols = [ 1,3,5,13,14 ];var medRols=[1,13,14]; var infRols = [3,5];
      var actions =  '<a href = "/hospitalisation/'+data.id+'" style="cursor:pointer" class="btn secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>' ;  
      if(data.etat == "En cours")                
      {
        if($.inArray({{  Auth::user()->role_id }}, medRols) > -1){
         actions += '<a href="/hospitalisation/'+data.id+'/edit" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier Hospitalisation" data-placement="bottom"><i class="fa fa-edit fa-xs" aria-hidden="true" fa-lg bigger-120></i></a>';
            actions +='<a href="/visite/create/'+data.id+'" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';
            actions +='<a data-toggle="modal" data-id="'+data.id+'" title="Clôturer Hospitalisation"  onclick ="cloturerHosp('+data.id+')" class="btn btn-warning btn-xs" href="#" id="sortieEvent"><i class="fa fa-sign-out" aria-hidden="false"></i></a>';
        }
        if( '{{  Auth::user()->is(5) }}')
           actions += '<a class ="btn btn-info btn-xs" data-toggle="tooltip" title="Imprimer Code a barre" data-placement="bottom" onclick ="codeBPrint('+data.id+')"><i class="fa fa-barcode"></i></a>';
        if($.inArray({{  Auth::user()->role_id }}, rols) > -1)
          actions +='<a href="/soins/index/'+data.id+'" class ="btn btn-xs btn-success" data-toggle="tooltip" title="Dossier de Soins"><img src="{{ asset('/img/drugs.png') }}" alt="" width="10px" height="15px"></a>';
      }else
      if($.inArray({{  Auth::user()->role_id }}, medRols) > -1){
        actions +='<a data-toggle="modal" href="#" class ="btn btn-info btn-xs" onclick ="ImprimerEtat(0,\'hospitalisation\','+data.id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
      }  
      return actions;
     }
     function loadDataTable(data){
          $('#liste_hosptalisations').dataTable({
          "paging":   true,
          "destroy": true,
           "ordering": true,
           "searching":false,
            'bLengthChange': false,
           "info" : false,
           "language":{"url": '/localisation/fr_FR.json'},
           "data" : data,
           "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                 $(nRow).attr('id',"hospi"+aData.id);
          },
          "columns": [
            { data: "patient.Nom",
              render: function ( data, type, row ) {
                var url = '{{ route("patient.show", ":slug") }}'; 
                url = url.replace(':slug',row.patient.id);
                return '<a href="'+ url +'" title="voir patient">'+ row.patient.full_name + '</a>';
              },
              title:'Patient',"orderable": true
            },
            { data: "admission.demande_hospitalisation.modeAdmission", 
              render: function ( data, type, row ) {    // var mode;
                switch(row.admission.demande_hospitalisation.modeAdmission)
                {
                  case 0: 
                    mode ="Programme";
                    break;
                  case 1: 
                   mode ="Ambulatoire";
                    break;
                  case 2:
                   mode ="Urgence";
                    break; 
                }
                var color = (row.admission.demande_hospitalisation.modeAdmission ===  2)  ? 'warning':'primary';
                return '<span class="badge badge-pill badge-'+color+'">' + mode +'</span>';
               }, title:"Mode Admission","orderable": false 
            },//2
            { data: null,
                render: function ( data, type, row ) {
                  return moment(row.date).format('YYYY-MM-DD');
                },title:'Date Entrée'
            },//3
            { data: null,
                render: function ( data, type, row ) {
                  return moment(row.Date_Prevu_Sortie).format('YYYY-MM-DD');
                },title:'Date Sortie Prévue', "orderable": true
            },//4
            { data: null,
                render: function ( data, type, row ) {
                  return moment(row.Date_Sortie).format('YYYY-MM-DD');
                },title:'Date Sortie', "orderable": true
            },
            { data: null, title:'Mode',"orderable": false,
                 render: function(data, type, row){
                        if(data.mode_hospi != null)
                               return data.mode_hospi.nom;
                        else
                              return '';
                 }
               },//6
              { data: "admission.demande_hospitalisation.service.nom" ,title:'Service',"orderable": false  
              },//7 
              { data: "medecin.full_name" , title:'Medecin',"orderable": false },//8
              { data:  null , title:'Garde malade',"orderable": false,
                render: function(data, type, row){
                         if(data.garde != null)
                               return data.garde.full_name;
                        else
                              return '';
                }  
               },
              { data: "etat" ,
                render: function(data, type, row){
                      classe = (row.etat == 'cloturée') ? 'success' : 'primary';
                      return '<span class="badge badge-'+ classe +'">' + row.etat +'</span>'; 
                },title:'Etat', "orderable":false 
              },//9
             { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false }
          ],
          "columnDefs": [
            {"targets": 1 ,  className: "dt-head-center priority-4" },
            {"targets": 3 ,  className: "dt-head-center priority-6" },
            {"targets": 4,  className: "dt-head-center priority-4" },
            {"targets": 5 ,  className: "dt-head-center priority-5" },
            {"targets": 6 ,  className: "dt-head-center priority-6" },
            {"targets": 7 ,  className: "dt-head-center priority-6" },
            {"targets": 10,  className: "dt-head-center dt-body-center"}
          ]
          
      });
    }
      function getHospitalisations(field,value)
      {
        $.ajax({
          url :'{{ route("hospitalisation.index")}}',
          data: {  "field":field, "value":value, },
          dataType: "json",
              success: function(data) {
                $(".numberResult").html(data.length);
                loadDataTable(data);
                $('#'+field).val('');      
              }
          });
      }
      var field ="etat";
      $(function(){
          $(document).on('click','.findHosp',function(event){
              getHospitalisations(field,$('#'+field).val().trim());
          });
          $('#modeSortie').change(function(){
               if($(this).val()==="0")
                {
                    if($('.transfert').hasClass('hidden'))
                      $('.transfert').removeClass('hidden');
                }else{ 
                    if(! ($('.transfert').hasClass('hidden')))
                      $('.transfert').addClass('hidden');
                }
                if ($(this).val()==="2"){
                  if($('.deces').hasClass('hidden'))
                    $('.deces').removeClass('hidden');
                  if(!($('.ndeces').hasClass('hidden')))
                    $('.ndeces').addClass('hidden');
                }else{
                  if(! ($('.deces').hasClass('hidden')))
                    $('.deces').addClass('hidden');
                   if($('.ndeces').hasClass('hidden'))
                    $('.ndeces').removeClass('hidden');
                } 
          });
     $('#cloturerHop').click(function (e) {
          e.preventDefault();
          var formData = {
            _token: CSRF_TOKEN,
            id                 : $("#id").val(),
            Date_Sortie        : jQuery('#Date_SortieH').val(),
            Heure_sortie       : jQuery('#Heure_sortie').val(),
            modeSortie         :jQuery('#modeSortie').val(),
            resumeSortie       : $('#resumeSortie').val(),
            etatSortie         : $('#etatSortie').val(),
            diagSortie         : $("#diagSortie").val(),
            ccimdiagSortie     : $("#ccimdiagSortie").val(),
          };
          if(jQuery('#modeSortie').val() === '0'){
              formData.structure = $("#structure").val();
              formData.motif = $("#motif").val();
          }
          if(jQuery('#modeSortie').val() === '2'){
              formData.cause = $("#cause").val();
              formData.date = $("#date").val();
              formData.heure = $("#heure").val();
              formData.med_id = $("#medecin").val();
          }
          
          if(!($("#Date_Sortie").val() == ''))
          {
            if($('.dataTables_empty').length > 0)
              $('.dataTables_empty').remove();
            url = '{{ route("hospitalisation.update", ":slug") }}'; 
            url = url.replace(':slug', $("#id").val());
            $.ajax({
                type: "PUT",
                url: url,//'/hospitalisation/'+$("#id").val(),
                data: formData,//dataType: 'json',
                 success: function (data) {
                 $("#hospi" + data.id).remove();
                }
            });
          }
      });
  });
</script>
@stop
@section('main-content')
<div class="page-header"><h1>Rechercher une hospitalisation</h1></div>
<div class="row">
  <div class="panel panel-default">
      <div class="panel-heading"><b>Rechercher</b></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3">
            <label>Etat</label>
            <select id='etat' class="form-control filter">
              <option value=""></option>
              <option value="0" selected active>En cours</option>
              <option value="1">Cloturée</option>
            </select>
          </div>
          <div class="col-sm-3">
             <label>Patient</label><input type="text" id="Nom" class="form-control filter">
          </div>
          <div class="col-sm-3"><label>IPP</label><input type="text" id="IPP" class="form-control filter"></div>
           <div class="col-sm-3"><label>Date de sortie</label>
            <div class="input-group">
              <input type="text" id ="Date_Sortie" class="date-picker form-control filter ltnow"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
              <span class="input-group-addon fa fa-calendar"></span>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-sm btn-primary findHosp"><i class="fa fa-search"></i> Rechercher</button>
      </div>
    </div>
<div class="row">
  <div class="col-xs-12 widget-container-col">
  <div class="widget-box transparent">
    <div class="widget-header"><h5 class="widget-title bigger lighter">
      <i class="ace-icon fa fa-table"></i>Hospitalisations</h5> <span class="badge badge-info numberResult">{{ $hospitalisations->count() }}</span>
    </div>
    <div class="widget-body">
      <div class="widget-main no-padding">
        <table class="table display table-responsive table-bordered" id="liste_hosptalisations">
          <thead>
            <tr>
              <th class ="center">Patient</th><th class ="center priority-4">Mode d'admission</th>   
              <th class ="center">Date d'entrée</th><th class ="center  priority-6">Date sortie prévue</th>
              <th class ="center priority-4">Date sortie</th><th class ="center  priority-5">Mode</th>
              <th  class ="center  priority-6">Service</th><th  class ="center  priority-6">Médecin</th>
             <th  class ="center  priority-6">Garde malade</th> <th class ="center  priority-6">Etat</th>
              <th class ="center" width="12%"><em class="fa fa-cog"></em></th>
            </tr>
          </thead>
           <tbody>
               @foreach ($hospitalisations as $hosp)
                <tr id="hospi{{ $hosp->id }}">
                      <td><a href="{{route('patient.show',$hosp->patient->id)}}" title="voir patient">{{ $hosp->patient->full_name }}</a></td>
                      <td class="priority-4">
                      <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
                    </td>
                    <td>{{  $hosp->date->format('Y-m-d')}}</td>
                    <td  class="priority-6">{{ $hosp->Date_Prevu_Sortie->format('Y-m-d')}}</td>
                    <td class="priority-4">{{  $hosp->Date_Sortie }}</td>
                    <td class="priority-5">{{ (isset($hosp->modeHospi)) ? $hosp->modeHospi->nom : '' }}</td>
                    <td class="priority-6">{{  $hosp->admission->demandeHospitalisation->Service->nom }}</td>
                    <td class="priority-6">{{ (isset($hosp->medecin)) ? $hosp->medecin->full_name : ''  }}</td>
                    <td class="priority-6">{{ (isset($hosp->garde)) ? $hosp->garde->full_name : ''  }}</td>
                    <td class="priority-6" ><span class="badge badge-pill badge-primary">{{is_null($hosp->etat) ? 'En cours': $hosp->etat}}</span>
                    <td class ="center"  width="12%">
                      <a href = "/hospitalisation/{{ $hosp->id }}" style="cursor:pointer" class="btn secondary btn-xs" data-toggle="tooltip"><i class="fa fa-hand-o-up fa-xs"></i></a>
                      @if(Auth::user()->isIn([1,5,13,14]))
                        <a href="{{ route('hospitalisation.edit', $hosp->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier Hospitalisation" data-placement="bottom"><i class="fa fa-edit fa-xs" aria-hidden="true" fa-lg bigger-120></i></a>       
                       @if(!Auth::user()->is(5))
                        <a href="/visite/create/{{ $hosp->id }}" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>
                        <a data-toggle="modal" data-id="{{ $hosp->id }}" title="Clôturer Hospitalisation" onclick ="cloturerHosp({{ $hosp->id }})" class="btn btn-warning btn-xs" href="#" id="sortieEvent"><i class="fa fa-sign-out" aria-hidden="false"></i></a>
                       @endif 
                      @endif
                      @if(Auth::user()->is(5))
                        <a href="#" class ="btn btn-info btn-xs" data-toggle="tooltip" title="Imprimer Code a barre" data-placement="bottom" onclick ="codeBPrint('{{ $hosp->id }}')"><i class="fa fa-barcode"></i></a>                      
                      @endif
                      @if(Auth::user()->isIn([1,3,5,13,14]))
                        <a href="{{ route('soins.index', ["id"=>$hosp->id]) }}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Dossier de Soins" data-placement="bottom">
                          <img src="{{ asset('/img/drugs.png') }}" alt="" width="10px" height="15px">
                        </a>
                      @endif
                    </td>
             </tr>
            @endforeach
          </tbody>   
        </table>                  
      </div><!-- widget-main -->
      </div>  <!-- widget-body -->
   </div> <!-- widget-box -->
</div>
</div>
<div class="row">@include('hospitalisations.ModalFoms.sortieModal')</div><div class="row">@include('hospitalisations.ModalFoms.EtatSortie')</div>
<div class="row">@include('cim10.cimModalForm')</div>
@stop