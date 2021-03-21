@extends('app')
@section('page-script')
<script>
function getConsultations(field,value)
{
  $.ajax({
      url : '{{ URL::to('getConsultations') }}',
      data: {    
         "field":field,
         "value":value,
      },
      dataType: "json",// recommended response type
    	success: function(data) {
              $(".numberResult").html(data.length);
               $("#liste_conultations").DataTable ({
                   "processing": true,
                   "paging":   true,
                   "destroy": true,
                   "ordering": true,
                   "searching":false,
                   "info" : false,
                   "language":{"url": '/localisation/fr_FR.json'},
                   "data" : data,  // "scrollX": true,
                   "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                         $(nRow).attr('id',"consult"+aData.id);
                   },
                   "columns": [
                      	{ data:null,title:'#', "orderable": false,searchable: false,
                               render: function ( data, type, row ) {
                                    if ( type === 'display' ) {
                                          return '<input type="checkbox" class="editor-active check" name="fusioner[]" value="'+data.id+'" onClick="return KeepCount()" /><span class="lbl"></span>';
                                    }
                                    return data;
                               },
                               className: "dt-body-center",
                          }, 
                          { data: "motif" , title:'Motif' },
                          { data: "Date_Consultation" , title:'Date' },
                          { data: "Resume_OBS" , title:'Résumé' },
                          { data: "patient.Nom",
                                render: function ( data, type, row ) {
                                     return row.patient.Nom + ' ' + row.patient.Prenom;
                               },
                           	 title:'Patient',"orderable": true
                          },
                           {   data: "docteur.nom" ,
                               render: function ( data, type, row ) {
                                        return row.docteur.nom + ' ' + row.docteur.prenom ;
                               },
                               title:'Medecin' 
                          },
                          { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false}
                    ],
                    "columnDefs": [
                        {"targets": 2 ,  className: "dt-head-center" },//nom
                        {"targets": 3 ,  className: "dt-head-center priority-5" },
                        {"targets": 4 ,  className: "dt-head-center"},
                        {"targets": 5 ,  className: "dt-head-center priority-4" },
                        {"targets": 6 , "orderable": false, className: "dt-head-center dt-body-center" },
                    ],
         });
      }
	});
}
function getAction(data, type, dataToSet) {
  var actions = '<a href = "/consultations/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
  actions +='<a data-toggle="modal" href="#" class ="btn btn-info btn-xs" onclick ="ImprimerEtat(\'consultation\','+data.id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
  return actions;
}
$('document').ready(function(){
    getConsultations("Date_Consultation",'<?= date("Y-m-j") ?>');
    $('.filter').change(function(){//   if($(this).attr('id') != "patientName")
          getConsultations($(this).attr('id'),$(this).val());
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
<div class="widget-title"><h3><strong>Rechercher une consultation</strong></h3></div>
<div class="widget-body">
  <div class="hospGrid" id="" data-grid-name="hospView">
    <div class="hospFilter well">
      <div class="FilterDiv" id="Filter">
        <div class="card">
       	  <div class="card-body">
           	 <div class="row">
            		<div class="col-sm-4">
            			<div class="form-group"><label><strong>Patient :</strong></label><input type="text" id="Nom" value="" class="form-control filter"></div>
               		</div>
            		<div class="col-sm-4">
            			<div class="form-group"><label class="control-label" for="" ><strong>Date :</strong></label>
          			    <div class="input-group">
  					     		  <input type="text" id ="Date_Consultation" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
  							       <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    						    </div>
					        </div>
            		</div>	
            	</div>
          </div>
        </div>{{-- card --}}
      </div>
     	</div>   	
    </div>
  </div>
</div>{{-- widget --}}
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box transparent" id="widget-box-2">
		<div class="widget-header"><h5 class="widget-title bigger lighter">
         		 <i class="ace-icon fa fa-table"></i>Consultations</h5>&nbsp;<label>  <span class="badge badge-info numberResult"></span></label>
          </div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="display table-responsive" id="liste_conultations"></table>
			</div><!-- widget-main -->
	  	</div>	<!-- widget-body -->
	 </div> <!-- widget-box -->
</div>
</div>
@include('hospitalisations.ModalFoms.EtatSortie')
@endsection