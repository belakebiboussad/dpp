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
	function getNomPrenom(data, type, dataToSet)
  {
    return data.patient.Nom + " " + data.patient.Prenom;
  }
  function getMode(data, type, dataToSet){  return data['admission']['demande_hospitalisation']['modeAdmission']; }
  function getDateEntre(data, type, dataToSet) { return data['Date_entree']; }
  function getDateSortiePrev (data, type, dataToSet) { return data['Date_Prevu_Sortie']; }  
  function getDateSortie (data, type, dataToSet) { return data['Date_Sortie']; }
  function getMedecin (data, type, dataToSet) {
    return data['admission']['demande_hospitalisation']['Demeande_colloque']['medecin']['nom']; 
  }   
  function getHospitalisations(field,value)
	{
	  $.ajax({
      url : '{{URL::to('getHospitalisations')}}',
      data: {    
             "field":field,
             "value":value,
      },
      dataType: "json",// recommended response type
    	success: function(data) {
        $(".numberResult").html(Object.keys(data).length);
        $(".numberResult").html(data.length);
        $.each(data,function(key,value){
         $.each(data[key],function(skey,svalue){

          admission
          $.each(value,function(skey,svalue){
          alert(skey + ":" + svalue);
        });
        });

          // $("#liste_hosptalisations").DataTable ({
          //       "processing": true,
          //       "paging":   true,
          //       "destroy": true,
          //       "ordering": true,
          //       "searching":false,
          //       "info" : false,
          //       "language":{"url": '/localisation/fr_FR.json'},
          //       "data" : data,
          //       "columns": [
          //           { data:null,title:'#', "orderable": false,searchable: false,
          //             render: function ( data, type, row ) {
          //                         if ( type === 'display' ) {
          //                             return '<input type="checkbox" class="editor-active check" name="fusioner[]" value="'+data.id+'" onClick="return KeepCount()" /><span class="lbl"></span>';
          //                         }
          //                         return data;
          //             },
          //             className: "dt-body-center",
          //           },
          //           { data: getNomPrenom, title:'Nom' },
          //           { data: getMode , title:'Mode Admission' },
          //           { data: getDateEntre , title:'Date Entrée' },//
          //           { data: getDateSortiePrev , title:'Date Sortie Prévue' },
          //           { data: getDateSortie , title:'Date Sortie' },
          //           { data: getMedecin , title:'Médecin' }, 
          //       ],
          // });
      }
		});
	}
	$('document').ready(function(){
		$('.filter').change(function(){
		 	if($(this).attr('id') != "patientName")
		 		getHospitalisations($(this).attr('id'),$(this).val())
		});
		$('.filter').keyup(function(){
		  getHospitalisations($(this).attr('id'),$(this).val())
		});
	});
</script>
@endsection
@section('main-content')
<div class="widget">
<div class="widget-title"><h3><strong>Liste des Hospitalisations :</strong></h3></div>
<div class="widget-body">
  <div class="hospGrid" id="" data-grid-name="hospView">
    <div class="hospFilter well">
      <div class="FilterDiv" id="Filter">
        <div class="card">
       	  <div class="card-body">
            <div class="row">
            	<div class="col-sm-4">
            		<div class="form-group">
                <label><strong>Etat :</strong></label>
                <select id='etat_hosp' class="form-control filter" style="width: 200px">
                    <option value="">Selectionner Etat</option>
                    <option value="en cours">En Cours</option>
                    <option value="valide">Cloturé</option>
                </select>
            		</div>		
            	</div>
            	<div class="col-sm-4">
            		<div class="form-group">
                	<label><strong>Patient :</strong></label>
                	<input type="text" id="patientName" value="" class="form-control filter">
            		</div>		
            	</div>
            	<div class="col-sm-4">
            		<div class="form-group">
              		<label class="control-label" for="" ><strong>Date :</strong></label>
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
 </div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box transparent" id="widget-box-2">
		<div class="widget-header"><h5 class="widget-title bigger lighter">
      <i class="ace-icon fa fa-table"></i>Hospitalisations</h5>&nbsp;<label>
      <span class="badge badge-info numberResult"></span></label>
    </div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="display table-responsive" id="liste_hosptalisations"></table>
			</div><!-- widget-main -->
	  	</div>	<!-- widget-body -->
	 </div> <!-- widget-box -->
</div>
</div>
@endsection