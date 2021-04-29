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
     function getAction(data, type, dataToSet) {
          var rols = [ 3, 5,9 ];
          var actions =  '<a href = "/hospitalisation/'+data.id+'" style="cursor:pointer" class="btn secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>' ;  
          if($.inArray({{  Auth::user()->role_id }}, rols) == -1){
            if( data.etat_hosp != "1")                    
            {
                   actions += '<a href="/hospitalisation/'+data.id+'/editf" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier Hospitalisation" data-placement="bottom"><i class="fa fa-edit fa-xs" aria-hidden="true" fa-lg bigger-120></i></a>';
            }
            if( data.etat_hosp != "1")                    
            {
              actions +='<a href="/visite/create/'+data.id+'" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';
              actions +='<a data-toggle="modal" data-id="'+data.id+'" title="Clôturer Hospitalisation"  onclick ="cloturerHosp('+data.id+')" class="btn btn-warning btn-xs" href="#" id="sortieEvent"><i class="fa fa-sign-out" aria-hidden="false"></i></a>';
            }else
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
      $("#liste_hosptalisations").dataTable().fnDestroy();
      var oTable = $('#liste_hosptalisations').dataTable({
          "processing": true,
          "paging":   true,
           "destroy": true,
           "ordering": true,
           "searching":false,
           "info" : false,
           "language":{"url": '/localisation/fr_FR.json'},
           "data" : data,
           "scrollX": true,
           "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                 $(nRow).attr('id',"hospi"+aData.id);
          },
          "columns": [
/* { data:null,title:'#', "orderable": false,searchable: false, render: function ( data, type, row ) {  if ( type === 'display' ) {
  return '<input type="checkbox" class="editor-active check" value="'+data.id+'/><span class="lbl"></span>';}return data;},},*/
                     { data: "patient.Nom",
                            render: function ( data, type, row ) {
                                 return row.patient.Nom + ' ' + row.patient.Prenom;
                            },
                        title:'Patient',"orderable": true
                     },
                     {     data: "admission.demande_hospitalisation.modeAdmission", 
                               render: function ( data, type, row ) {
                                    return row.admission.demande_hospitalisation.modeAdmission ;
                               },
                                title:"Mode Admission","orderable": false 
                     },//2
                     { data: "Date_entree" , title:'Date Entrée', "orderable": true},//3
                     { data: "Date_Prevu_Sortie" , title:'Date Sortie Prévue', "orderable": true },//4
                     { data: "Date_Sortie" , title:'Date Sortie',"orderable": true },//5
                     { data: "mode_hospi.nom" , title:'Mode',"orderable": false  },//6
                     {   data: "admission.demande_hospitalisation.demeande_colloque.medecin.nom" ,
                           render: function ( data, type, row ) {
                                    return row.admission.demande_hospitalisation.demeande_colloque.medecin.nom + ' ' + row.admission.demande_hospitalisation.demeande_colloque.medecin.prenom ;
                           },
                           title:'Medecin',"orderable": false   
                     },//7
                     { data: getState , title:'Etat', "orderable":false },//8
                     { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false }              
          ],
          "columnDefs": [
                {"targets": 0 ,  className: "dt-head-center priority-6" },
                {"targets": 2 ,  className: "dt-head-center priority-4" },
                {"targets": 4 ,  className: "dt-head-center priority-6" },
                 {"targets": 5,  className: "dt-head-center priority-4" },
                 {"targets": 6 ,  className: "dt-head-center priority-5" },
                {"targets": 7 ,  className: "dt-head-center priority-6" },
                 {"targets": 8 ,  className: "dt-head-center priority-6" },
                {"targets": 9,  className: "dt-body-center"},
          ],
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
            }
    	});
	  }
	  $('document').ready(function(){
      $('.filter').change(function(){    // if($(this).attr('id') != "Nom") //getHospitalisations("etat_hosp",null);
          getHospitalisations($(this).attr('id'),$(this).val());
      }); // $('.filter').keyup(function(){//     getHospitalisations($(this).attr('id'),$(this).val()) // });
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
      $(document).on('click', '.selctetat', function(event){
          event.preventDefault();
          var formData = {
            class_name: $('#className').val(),   
            obj_id: $('#objID').val(),
            selectDocm :$(this).val(),
          };
          $.ajax({
            type : 'get',
            url : '{{URL::to('reportprint')}}',
            data:formData,
              success(data){
                $('#EtatSortie').modal('hide');
              },
          }); 
      });
	});
</script>
@endsection
@section('main-content')
<div class="widget">
<div class="widget-title"><h3><strong>Rechercher une Hospitalisation</strong></h3></div>
<div class="widget-body">
  <div class="hospGrid" id="" data-grid-name="hospView">
    <div class="hospFilter well">
      <div class="FilterDiv" id="Filter">
        <div class="card">
       	  <div class="card-body">
            <div class="row">
            	<div class="col-sm-3"> <!--  <div class="form-group col-sm-8"> -->  <!-- </div>    -->
                <label><strong>Etat :</strong></label>
                <select id='etat_hosp' class="form-control filter">
                  <option value="0">En Cours</option>
                  <option value="1">Cloturé</option>
                </select>
            	</div>
            	<div class="col-sm-3"><!-- <div class="form-group col-sm-8"> --><!-- </div> -->
            		<label><strong>Patient :</strong></label><input type="text" id="Nom" class="form-control filter">
              </div>		
            	<div class="col-sm-3">
                <label class="control-label" for="" ><strong>IPP:</strong></label> <input type="text" id="IPP" class="form-control filter">
              </div>
            	<div class="col-sm-3"><!-- <div class="form-group col-sm-8"></div> -->
            		<label class="control-label" for="" ><strong>Date Sortie:</strong></label>
            	  <div class="input-group">
  					      <input type="text" id ="Date_Sortie" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
  						    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    					  </div>
            	</div>	
            </div>
          </div>
        </div>
      </div>
     	</div>   	
    </div>
  </div>
 </div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box transparent" id="widget-box-2">
		<div class="widget-header"><h5 class="widget-title bigger lighter">
            <i class="ace-icon fa fa-table"></i>Hospitalisations</h5>&nbsp;<label><span class="badge badge-info numberResult"></span></label>
          </div>
		<div class="widget-body">
			<div class="widget-main no-padding">
		    <table class="display table-responsive" id="liste_hosptalisations">
          <thead>
              <tr><!-- <th class ="center priority-6" width="2%"></th> -->
                <th class ="center"><strong>Patient</strong></th>
                 <th class ="center priority-4"><strong>Mode Admission</strong></th><th class ="center"><strong>Date_entree</strong></th>
                <th class ="center  priority-6"><strong>Date Sortie Prévue</strong></th><th class ="center priority-4"><strong>Date Sortie</strong></th>
                <th  class ="center  priority-5"><strong>Mode</strong></th><th  class ="center  priority-6"><strong>Medecin</strong></th>
                <th class ="center  priority-6"><strong>Etat</strong></th><th class ="center"><strong><em class="fa fa-cog"></em></strong></th>
              </tr>
          </thead>
          <tbody>
               @foreach ($hospitalisations as $hosp)
                <tr id="hospi{{ $hosp->id }}">
                  {{--   <td class="priority-6"><input type="checkbox" class="editor-active check" value="{{ $hosp->id}}"/><span class="lbl"></span></td> --}}
                    <td>{{ $hosp->patient->Nom }} {{ $hosp->patient->Prenom }}</td>
                    <td class="priority-4">{{ $hosp->admission->demandeHospitalisation->modeAdmission}} </td>
                    <td>{{  $hosp->Date_entree}}</td>
                    <td  class="priority-6">{{  $hosp->Date_Prevu_Sortie}}</td>
                    <td class="priority-4">{{  $hosp->Date_Sortie}}</td>
                    <td class="priority-5">{{  $hosp->modeHospi->nom }}</td>
                    <td class="priority-6">{{  $hosp->medecin->nom }}<!-- admission->demandeHospitalisation->demeandeColloque-> -->
                            {{  $hosp->medecin->prenom }}
                     </td>
                     <td class="priority-6" >
                         <span class="badge badge-pill badge-primary">{{  isset($hosp->etat_hosp)  ?  $hosp->etat_hosp : 'En Cours'}}</span>
                     </td>
                    <td class ="center">
                          <a href = "/hospitalisation/{{ $hosp->id }}" style="cursor:pointer" class="btn secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>
                          @if((Auth::user()->role_id != 3))
                               @if(Auth::user()->role_id == 1)
                                    <a href="/hospitalisation/{{ $hosp->id}}/edit" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier Hospitalisation" data-placement="bottom"><i class="fa fa-edit fa-xs" aria-hidden="true" fa-lg bigger-120></i></a>                   
                                     <a href="/visite/create/{{ $hosp->id }}" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>
                                    <a data-toggle="modal" data-id="{{ $hosp->id }}" title="Clôturer Hospitalisation"  onclick ="cloturerHosp({{ $hosp->id }})" class="btn btn-warning btn-xs" href="#" id="sortieEvent"><i class="fa fa-sign-out" aria-hidden="false"></i></a>
                              @endif
                          @endif
                    </td>
             </tr>
            @endforeach
          </tbody>    
                    </table>
			</div><!-- widget-main -->
	  	</div>	<!-- widget-body -->
	 </div> <!-- widget-box -->
</div>
</div>
<div class="row">@include('hospitalisations.ModalFoms.sortieModal')</div><div class="row">@include('hospitalisations.ModalFoms.EtatSortie')</div>
<div class="row">@include('cim10.cimModalForm')</div>
@endsection