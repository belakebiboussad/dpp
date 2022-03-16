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
<script>
    var nowDate = new Date();
    var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
     function cloturerHosp(hospID)
     { 
        $("#hospID").val( hospID );
        $('#sortieHosp').modal('show');
        $('#Heure_sortie').timepicker({ template: 'modal' });
     }
     function getMedecin (data, type, dataToSet) {
         return data['admission']['demande_hospitalisation']['Demeande_colloque']['medecin']['nom']; 
     }
     function codeBPrint(id)
     {
        event.preventDefault();
        var formData = {
              id: id,    
        };
        $.ajax({
             type : 'get',
             url : "{{ URL::to('barreCodeprint') }}",
             data:formData,
             success(data){
             },
        });
     }
     function getAction(data, type, dataToSet) {
      var rols = [ 1,5,13,14 ];
      var actions =  '<a href = "/hospitalisation/'+data.id+'" style="cursor:pointer" class="btn secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>' ;  
       if($.inArray({{  Auth::user()->role_id }}, rols) > -1){ /* if( data.etat_hosp != "1") { }*/ 
            if( data.etat_hosp != "1")                    
            {   
             if({{  Auth::user()->role_id }} != 5)
             { 
              actions += '<a href="/hospitalisation/'+data.id+'/edit" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier Hospitalisation" data-placement="bottom"><i class="fa fa-edit fa-xs" aria-hidden="true" fa-lg bigger-120></i></a>';
              actions +='<a href="/visite/create/'+data.id+'" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';
              actions +='<a data-toggle="modal" data-id="'+data.id+'" title="Clôturer Hospitalisation"  onclick ="cloturerHosp('+data.id+')" class="btn btn-warning btn-xs" href="#" id="sortieEvent"><i class="fa fa-sign-out" aria-hidden="false"></i></a>';
            }else
                  actions += ' <a href="#" class ="btn btn-info btn-xs" data-toggle="tooltip" title="Imprimer Code a barre" data-placement="bottom" onclick ="codeBPrint('+data.id+')"><i class="fa fa-barcode"></i></a>';
            }else
             if({{  Auth::user()->role_id }} != 5)
                   actions +='<a data-toggle="modal" href="#" class ="btn btn-info btn-xs" onclick ="ImprimerEtat(\'hospitalisation\','+data.id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';      
       }
       return actions;
     }
     function getState(data, type, dataToSet) {
       if(data.etat_hosp == 1)
          return '<span class="badge badge-pill badge-primary">Cloturé</span>';
        else
          return '<span class="badge badge-pill badge-primary">En Cours</span>'
     }
     function loadDataTable(data){
          $('#liste_hosptalisations').dataTable({// "processing": true,
          "paging":   true,
           "destroy": true,
           "ordering": true,
           "searching":false,
           "info" : false,
           "language":{"url": '/localisation/fr_FR.json'},
           "data" : data,// "scrollX": true,
           "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                 $(nRow).attr('id',"hospi"+aData.id);
          },
          "columns": [
            { data: "patient.Nom",
              render: function ( data, type, row ) {
                return row.patient.Nom + ' ' + row.patient.Prenom;
              },
              title:'Patient',"orderable": true
            },
            { data: "admission.demande_hospitalisation.modeAdmission", 
              render: function ( data, type, row ) {
                switch(row.admission.demande_hospitalisation.modeAdmission)
                {
                  case '0':
                    return '<span class="badge badge-pill badge-primary">Programme</span>';
                    break;
                  case '1':
                    return '<span class="badge badge-pill badge-primary">Ambulatoire</span>';
                    break;
                  case '2':
                    return '<span class="badge badge-pill badge-primary">Urgence</span>';
                    break;
                }
               },
              title:"Mode Admission","orderable": false 
            },//2
            { data: "Date_entree" , title:'Date Entrée', "orderable": true},//3
            { data: "Date_Prevu_Sortie" , title:'Date Sortie Prévue', "orderable": true },//4
            { data: "Date_Sortie" , title:'Date Sortie',"orderable": true },//5
            { data: "mode_hospi.nom" , title:'Mode',"orderable": false  },//6
            { data: "medecin.nom" ,
                render: function ( data, type, row ) {
                  return row.medecin.nom + ' ' + row.medecin.prenom ;
                },
              title:'Medecin',"orderable": false   
            },//7
            { data: getState , title:'Etat', "orderable":false },//8
            { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false }
          ],
          "columnDefs": [
            {"targets": 1 ,  className: "dt-head-center priority-4" },
            {"targets": 3 ,  className: "dt-head-center priority-6" },
            {"targets": 4,  className: "dt-head-center priority-4" },
            {"targets": 5 ,  className: "dt-head-center priority-5" },
            {"targets": 6 ,  className: "dt-head-center priority-6" },
            {"targets": 7 ,  className: "dt-head-center priority-6" },
            {"targets": 8,  className: "dt-head-center dt-body-center"}
          ]
          
      });
    }
      function getHospitalisations(field,value)
      {
        $.ajax({
          url : '{{URL::to('getHospitalisations')}}',
          data: {  "field":field, "value":value, },
          dataType: "json",
              success: function(data) {
                $(".numberResult").html(data.length);
                loadDataTable(data);
                $('#'+field).val(''); 
              }
          });
      }
      var field ="etat_hosp";
      $('document').ready(function(){
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
          }else{
            if(! ($('.deces').hasClass('hidden')))
                $('.deces').addClass('hidden');
            } 
     });
     jQuery('#saveCloturerHop').click(function () {
          var formData = {
                id                      : $("#hospID").val(),
                Date_Sortie        : jQuery('#Date_SortieH').val(),
                Heure_sortie       : jQuery('#Heure_sortie').val(),
                modeSortie         :jQuery('#modeSortie').val(),
                resumeSortie     : $('#resumeSortie').val(),
                etatSortie            : $('#etatSortie').val(),
                diagSortie           : $("#diagSortie").val(),
                ccimdiagSortie    : $("#ccimdiagSortie").val(),
                etat_hosp            :'1',
          };
          if(jQuery('#modeSortie').val() === '0'){
              formData.structure = $("#structure").val();
              formData.motif = $("#motif").val();
          }
          if(jQuery('#modeSortie').val() === '2'){
              formData.cause = $("#cause").val();
              formData.date = $("#date").val();
              formData.heure = $("#heure").val();
              formData.medecin = $("#medecin").val();
          } 
          if(!($("#Date_Sortie").val() == ''))
          {
            if($('.dataTables_empty').length > 0)
              $('.dataTables_empty').remove();
              $.ajax({
                        headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '/hospitalisation/'+$("#hospID").val(),//'hospitalisation/'+ $("#hospID").val(),
                        data: formData,
                        dataType: 'json',
                        success: function (data) {
                          $("#hospi" + data.id).remove();
                        },
                        error: function (data){
                          console.log('Error:', data);
                        },
              });
          }
      });
  });
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
            <select id='etat_hosp' class="form-control filter">
              <option value="0">En cours</option>
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
  <div class="widget-box transparent" id="widget-box-2">
    <div class="widget-header"><h5 class="widget-title bigger lighter">
      <i class="ace-icon fa fa-table"></i>Hospitalisations</h5>&nbsp;<label><span class="badge badge-info numberResult">{{ $hospitalisations->count() }}</span></label>
    </div>
    <div class="widget-body">
      <div class="widget-main no-padding">
        <table class="table display table-responsive table-bordered" id="liste_hosptalisations">
          <thead>
            <tr>
              <th class ="center"><strong>Patient</strong></th>
              <th class ="center priority-4"><strong>Mode d'admission</strong></th><th class ="center"><strong>Date d'entrée</strong></th>
              <th class ="center  priority-6"><strong>Date sortie prévue</strong></th><th class ="center priority-4"><strong>Date sortie</strong></th>
              <th  class ="center  priority-5"><strong>Mode</strong></th><th  class ="center  priority-6"><strong>Médecin</strong></th>
              <th class ="center  priority-6"><strong>Etat</strong></th>
              <th class ="center" width="12%"><strong><em class="fa fa-cog"></em></strong></th>
            </tr>
          </thead>
           <tbody>
               @foreach ($hospitalisations as $hosp)
                <tr id="hospi{{ $hosp->id }}">
                      <td>{{ $hosp->patient->full_name }}</td>
                    <td class="priority-4">
                      @switch($hosp->admission->demandeHospitalisation->modeAdmission)
                          @case(0)
                          <span class="label label-sm label-primary">Programme</span>
                          @break
                        @case(1)
                          <span class="label label-sm label-success">Ambulatoire</span>
                          @break
                        @case(2)
                          <span class="label label-sm label-warning">Urgence</span>
                          @break    
                      @endswitch
                    </td>
                    <td>{{  $hosp->Date_entree}}</td>
                    <td  class="priority-6">{{  $hosp->Date_Prevu_Sortie}}</td>
                    <td class="priority-4">{{  $hosp->Date_Sortie }}</td>
                    <td class="priority-5">{{  $hosp->modeHospi->nom }}</td>
                    <td class="priority-6">{{  $hosp->medecin->full_name }}</td>
                     <td class="priority-6" >
                         <span class="badge badge-pill badge-primary">{{  isset($hosp->etat_hosp)  ?  $hosp->etat_hosp : 'En Cours'}}</span>
                     </td>
                    <td class ="center"  width="12%">
                      @if(Auth::user()->role_id != 3)<!-- inf -->
                        <a href = "/hospitalisation/{{ $hosp->id }}" style="cursor:pointer" class="btn secondary btn-xs" data-toggle="tooltip"><i class="fa fa-hand-o-up fa-xs"></i></a>
                        @if(in_array(Auth::user()->role_id,[1,13,14]))
                          <a href="/hospitalisation/{{ $hosp->id}}/edit" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier Hospitalisation" data-placement="bottom"><i class="fa fa-edit fa-xs" aria-hidden="true" fa-lg bigger-120></i></a>           
                          <a href="/visite/create/{{ $hosp->id }}" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>
                          <a data-toggle="modal" data-id="{{ $hosp->id }}" title="Clôturer Hospitalisation" onclick ="cloturerHosp({{ $hosp->id }})" class="btn btn-warning btn-xs" href="#" id="sortieEvent"><i class="fa fa-sign-out" aria-hidden="false"></i></a>
                        @endif
                        @endif
                      @if(Auth::user()->role_id == 5){{-- surmed --}}
                        <a href="#" class ="btn btn-info btn-xs" data-toggle="tooltip" title="Imprimer Code a barre" data-placement="bottom" onclick ="codeBPrint('{{ $hosp->id }}')"><i class="fa fa-barcode"></i></a>                      
                      @endif
                      @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
                        <a href="{{ route('soins.index', ["hosp_id"=>$hosp->id]) }}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Dossier de Soins" data-placement="bottom">
                          <img src="{{ asset('/img/medicine.png') }}" alt="" width="10px" height="15px"><!-- <span class="medical medical-icon-i-cardiology fa-xs" aria-hidden="true"></span> -->
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
@endsection