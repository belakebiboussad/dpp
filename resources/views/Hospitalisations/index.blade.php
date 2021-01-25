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
 ol {list-style: none; counter-reset: li}
.rounded-list button{
    position: relative;
    display: block;
    padding: .4em .4em .4em 2em;
    *padding: .4em;
    margin: .5em 0;
    background: #ddd;
    color: #444;
    text-decoration: none;
    border-radius: .3em;
    transition: all .3s ease-out;
  }

  .rounded-list button:hover{
    background: #eee;
  }

  .rounded-list button:hover:before{
    transform: rotate(360deg);
  }

  .rounded-list button:before{
    content: counter(li);
    counter-increment: li;
    position: absolute;
    left: -1.3em;
    top: 50%;
    margin-top: -1.3em;
    background: #87ceeb;
    height: 2em;
    width: 2em;
    line-height: 2em;
    border: .3em solid #fff;
    text-align: center;
    font-weight: bold;
    border-radius: 2em;
    transition: all .3s ease-out;
  }
 </style>
 @endsection
@section('page-script')
<script>
    function cloturerHosp(hospID)
    { 
          $("#hospID").val( hospID );
           $('#sortieHosp').modal('show');
           $('#Heure_sortie').timepicker({ template: 'modal' });
    }
    function ImprimerEtat(hospID)
    { 
           $("#hospID").val( hospID );
           $('#EtatSortie').modal('show'); // $('#Heure_sortie').timepicker({ template: 'modal' });
    }
    function getMedecin (data, type, dataToSet) {
          return data['admission']['demande_hospitalisation']['Demeande_colloque']['medecin']['nom']; 
     }
     function getAction(data, type, dataToSet) {  
          var actions =  '<a href = "/hospitalisation/'+data.id+'" style="cursor:pointer" class="btn secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>' ;  
          if(({{  Auth::user()->role_id }} != 3) &&  {{  Auth::user()->role_id }} != 9){
                actions += '<a href="/hospitalisation/'+data.id+'/edit" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier l\'Hospitalisation" data-placement="bottom"><i class="fa fa-edit fa-xs" aria-hidden="true" fa-lg bigger-120></i></a>';
                if({{  Auth::user()->role_id }} == 1){
                    if( data.etat_hosp != "Cloturé")                    
                    {
                      actions +='<a href="/visite/create/'+data.id+'" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';
                      actions +='<a data-toggle="modal" data-id="'+data.id+'" title="Clôturer Hospitalisation"  onclick ="cloturerHosp('+data.id+')" class="btn btn-warning btn-xs" href="#" id="sortieEvent"><i class="fa fa-sign-out" aria-hidden="false"></i></a>';
                    }else
                      actions +='<a data-toggle="modal" href="#" class ="btn btn-info btn-xs" onclick ="ImprimerEtat('+data.id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                }   
          }
           return actions;
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
                $(".numberResult").html(data.length);  // $(".numberResult").html(Object.keys(data).length);
                $("#liste_hosptalisations").DataTable ({
                     "processing": true,
                     "paging":   true,
                     "destroy": true,
                     "ordering": true,
                     "searching":false,
                     "info" : false,
                     "language":{"url": '/localisation/fr_FR.json'},
                     "data" : data,
                     "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                           $(nRow).attr('id',"hospi"+aData.id);
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
                          },
                          { data: "Date_entree" , title:'Date Entrée' },//
                          { data: "Date_Prevu_Sortie" , title:'Date Sortie Prévue' },
                          { data: "Date_Sortie" , title:'Date Sortie' },
                          { data: "mode_hospi.nom" , title:'Mode'
                          },
                          {   data: "admission.demande_hospitalisation.demeande_colloque.medecin.nom" ,
                               render: function ( data, type, row ) {
                                        return row.admission.demande_hospitalisation.demeande_colloque.medecin.nom + ' ' + row.admission.demande_hospitalisation.demeande_colloque.medecin.prenom ;
                               },
                               title:'Medecin' 
                          }, 
                          { data: "etat_hosp" , title:'Etat' },
                          { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false }
                    ],
           });
        }
	});
	}
	$('document').ready(function(){
    getHospitalisations("etat_hosp",'');
		$('.filter').change(function(){
           	if($(this).attr('id') != "patientName")
                     getHospitalisations($(this).attr('id'),$(this).val());
          });
		$('.filter').keyup(function(){
		       getHospitalisations($(this).attr('id'),$(this).val())
            
		});
          jQuery('#saveCloturerHop').click(function () {
                var formData = {
                     id                      : $("#hospID").val(),
                     Date_Sortie             : jQuery('#Date_SortieH').val(),
                     Heure_sortie            : jQuery('#Heure_sortie').val(),
                     modeSortie              :jQuery('#modeSortie').val(),
                     autre                   : $('#autre').val(),
                     diagSortie              : $("#diagSortie").val(),
                     etat_hosp     :'Cloturé',
                };
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
                     })
               } 
          });
          $(document).on('click', '#selctetat', function(event){
               var selectDocm=$(this).text();
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = {
                      hosp_id: $('#hospID').val(),
                      selectDocm :selectDocm,
                };
                $.ajax({
                    type: "POST",
                    url: "/etatSortie/print",
                    data: formData,
                    // dataType:'json',
                    success: function (data){
                          // $('#iframe-pdf').contents().find('html').html(data.html);  // jQuery('#OrdonModal').modal('toggle');
                        alert(data);
                    },
                    error: function (data) {
                      console.log('Error:', data);
                    }
                });
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
                    <option value="Cloturé">Cloturé</option>
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
<div class="row">@include('hospitalisations.ModalFoms.sortieModal')</div>
<div class="row">@include('hospitalisations.ModalFoms.EtatSortie')</div>
<div class="row">@include('hospitalisations.EtatsSortie.PrintModal')</div>

@endsection