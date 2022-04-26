@extends('app')
@section('title')Hospitalisations @endsection
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
 @endsection
@section('page-script')
<script type="text/javascript" charset="utf-8" async defer>
  var field ="etat";
  var dt;
  function loadDataTable(data){
    dt = $('#liste_hosptalisations').dataTable({// "processing": true,
    'paging':   true,
    'destroy': true,
    'ordering': true,
    'searching':false,
    'bLengthChange': false,
    'info' : false,
    'language':{"url": '/localisation/fr_FR.json'},
    'data' : data,
    'initComplete': function(settings){
        var api = new $.fn.dataTable.Api( settings );
        var showColumn ='{{  !in_array(Auth::user()->role->id,[1,3,5,14]) }}' ? false : true; 
        if(showColumn)
          api.columns([5]).visible(false);
    },
    'fnCreatedRow': function( nRow, aData, iDataIndex ) {
      $(nRow).attr('id',"hospi"+aData.id);
    },
    'columns': [
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
        { data: "Date_entree" , title:'Date Entrée', "orderable": true},//3
        { data: "Date_Prevu_Sortie" ,
           render:function(data, type, row ){
              return (row.etat_id == 1) ? row.Date_Sortie : row.Date_Prevu_Sortie;
          }, title:'Date(sortie/prévue)', "orderable": true
        },//4 
        { data: "mode_hospi.nom" , title:'Mode',"orderable": false  },//5
        { data: "admission.demande_hospitalisation.service.nom" ,
          render: function ( data, type, row ) {
                 return row.admission.demande_hospitalisation.service.nom;
          } ,title:'Service',"orderable": false  
        },//5
      ],
      "columnDefs": [
        //{ "aTargets": [5], "sClass": "invisible"},
      ],
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
            $('#liste_hosptalisations').dataTable().fnSetColumnVis( 4, false );
          }
      });
  }
  $('document').ready(function(){
    $(document).on('click','.findHosp',function(event){
      getHospitalisations(field,$('#'+field).val().trim());
    });
  })
</script>
@endsection
@section('main-content')
<div class="row">
  <div class="col-sm-12 col-md-12">
    <h4><strong>Rechercher une hospitalisation</strong></h4>
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Rechercher</strong></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3">
            <label><strong>Etat :</strong></label>
            <select id='etat' class="form-control filter">
              <option value=""></option>
              <option value="0" selected active>En cours</option>
              <option value="1">Cloturée</option>
            </select>
          </div>
          <div class="col-sm-3">
             <label><strong>  Patient :</strong></label><input type="text" id="Nom" class="form-control filter">
          </div>
          <div class="col-sm-3">
             <label><strong>IPP :</strong></label>
             <input type="text" id="IPP" class="form-control filter">
          </div>
           <div class="col-sm-3">
            <label class="control-label" for="" ><strong>Date de sortie:</strong></label>
            <div class="input-group">
              <input type="text" id ="Date_Sortie" class="date-picker form-control filter ltnow"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
              <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-sm btn-primary findHosp"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 widget-container-col">
  <div class="widget-box transparent">
    <div class="widget-header"><h5 class="widget-title bigger lighter">
      <i class="ace-icon fa fa-table"></i>Hospitalisations</h5>&nbsp;<label><span class="badge badge-info numberResult">{{ $hospitalisations->count() }}</span></label>
    </div>
    <div class="widget-body">
      <div class="widget-main no-padding">
        <table class="table display table-responsive table-bordered" id="liste_hosptalisations">
          <thead>
            <tr>
              <th class ="center"><strong>Patient</strong></th>
              <th class ="center priority-4"><strong>Mode d'admission</strong></th>
              <th class ="center"><strong>Date d'entrée</strong></th>
              <th class ="center  priority-6"><strong>Date(sortie/prévue)</strong></th>
              <th class ="center  priority-5"><strong>Mode</strong></th>
              @if(!in_array(Auth::user()->role->id,[1,3,5,14]))
              <th  class ="center  priority-6"><strong>Service</strong></th>
              @endif
            </tr>
          </thead>
           <tbody>
           @foreach ($hospitalisations as $hosp)
            <tr id="hospi{{ $hosp->id }}">
              <td><a href="{{route('patient.show',$hosp->patient->id)}}" title="voir patient">{{ $hosp->patient->full_name }}</a></td>
              <td class="priority-4">
                <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
              </td>
              <td>{{  $hosp->Date_entree}}</td>
              <td  class="priority-6">{{  $hosp->Date_Prevu_Sortie}}</td>
              <td class="priority-5">{{  $hosp->modeHospi->nom }}</td>
              @if(!in_array(Auth::user()->role->id,[1,3,5,14]))
              <td class="priority-6">{{  $hosp->admission->demandeHospitalisation->Service->nom }}</td>
              @endif
            </tr>
            @endforeach
           </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
</div>
@include('hospitalisations.ModalFoms.sortieModal')@include('hospitalisations.ModalFoms.EtatSortie')
@include('cim10.cimModalForm')
@endsection