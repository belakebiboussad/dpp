@extends('app')
@section('page-script')
<script type="text/javascript">

	$(document).ready(function() {
  	$('#listActes').DataTable({
      colReorder: true,
      stateSave: true,
      searching:false,
  	  'aoColumnDefs': [{
        'bSortable': false,
       	'aTargets': ['nosort']
   		}],
   		"language": {
		                "url": '/localisation/fr_FR.json'
		  },
    });
	}); 
</script>
@endsection
@section('main-content')
	<div class="page-header" width="100%">
  	@include('patient._patientInfo')
	</div>

	<div class="page-header">
		<h1 style="display: inline;"><strong>viste patient</strong></h1>
		<div class="pull-right"> </div>
	</div>
  <div class="content">
	  <div class= "widget-box widget-color-blue" id="widget-box-2">
	    <div class="widget-header" >
	      <h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Actes</b></font></h5>
	       	<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
							{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
						<div class="fa fa-plus-circle"></div><!-- data-target="#antecedantModal" -->
				 		<!-- <a href="#" id="btn-add" name="btn-add" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter un Acte" >
		 					<h4><strong>Acte</strong></h4>
		 				</a> -->
		 					<a href="#"  data-target="#acteModal" id="btn-add" name="btn-add" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter un Acte" >
		 					<h4><strong>Acte Médicale</strong></h4>
		 				</a>
		 			</div>
	    </div>
	    <div class="widget-body" id ="ConsigneWidget">
		    <div class="widget-main no-padding">
		      <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="listActes">
		          <thead class="thin-border-bottom">
		            <tr class ="center">
		              <th class ="hidden"></th>
		            	<th scope="col" class ="center"></th>
									<th scope="col" class ="center"><strong>Acte</strong></th>
									<th scope="col" class ="center"><strong>Nombre de jours</strong></th>
									<th scope="col" class ="center"><strong>Matin</strong></th>
									<th scope="col" class ="center"><strong>Midi</strong></th>
									<th scope="col" class ="center"><strong>Soir</strong></th>
									<th scope="col" class=" center nosort"><em class="fa fa-cog"></em></th>
		            </tr>
		          </thead>
		      </table>	
		     </div>
		  </div>
  	</div>
   	<div id="acteModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<div  id="" class="modal-content custom-height-modal">
					<div class="modal-header">
			  		<button type="button" class="close" data-dismiss="modal">&times;</button>
			  		<h4 class="modal-title">Ajouter un Acte Médicale</h4>
			  		@include('patient._patientInfo')
					</div>
					<div class="modal-body">
					  <form id="addActe" method="POST" action ="/Acte/save">
					 	
					  </form>
					</div>
				</div>
			</div>
		</div>
  </div>
@endsection

