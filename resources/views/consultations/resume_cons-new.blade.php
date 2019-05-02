@extends('app_med')
@section('style')
<style>
	thead th {
		  font-size: 0.6em;
		  padding: 1px !important;
		  height: 15px;
	}
	.datatable-scroll {
   		 overflow-x: auto;
  		  overflow-y: visible;
	}
	input[readonly] {
		    background-color: transparent;
		    border: 0;

		    box-shadow: none;
	}
</style>
@endsection
@section('page-script')
{{-- <script type="text/javascript" src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script> --}}
<script type="text/javascript">
	  $('document').ready(function(){
	           $('#example').DataTable({
	  		"processing": true,
     			"serverSide": false,
     			"searching":false,
	  		"scrollY":"400px",
                    		"scrollCollapse": true,
                    		"paging":false,
                    		 "dom": 't',
                    		"createdRow": function( row, data, dataIndex ) {
                        		if ( data[ 3 ] == "Inp" )
                            		$(row).css('color', 'green')
                        		else 
                           		 $(row).css('color', 'blue')

                	        if ( data[7] > 0 ) $(row).css('font-weight', 'bold')                        
                 		   }, 
	  		"language": {
                		"url": '/localisation/fr_FR.json'
                		},
	  	});
	  });
</script>
@stop
@section('main-content')
<div class="page-header">
<h1><strong>Résumé  du Consultation Pour :</h1>
<?php $patient = $consultation->patient; ?>
  @include('patient._patientInfo', $patient)
</div>
<div class="row">
	<div class="col-sm-7 alert alert-block alert-info voffsetright">
		<div class="content voffsetright">
			<span style="font:bold 14px verdana;">Résumé de la Consultation</span>
			{{-- <span"style="font:bold 12px verdana;">&nbsp;"{{ $consultation->Date_Consultation }}"</span> --}}			
		</div>
	</div>
	<div class="col-sm- 5 alert alert-block alert-info">
		<div class="content voffsetleft center">
		<span style="font:bold 14px verdana;">Liste des consultations </span>
		</div>
	</div>
</div>
<div class="row" style = "margin-top:-2%">
	<div class="col-sm-7" id="consultDetail">
	@include('consultations.inc_consult')
	</div>{{-- col-sm-6 --}}
	<div class="col-sm-5">
		<table id="example" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" " role="grid">
		<thead>
		<tr role="row">
			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Position: activate to sort column descending" style="width:20%">Date</th>
			<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:45%">Medecin</th>
			<th data-orderable="false" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Start date" style="width:45%;">Lieu consultation</th>
			<th style="width:5%;"></th>
		</tr>
		</thead>
		<tbody>
		@foreach($consults as $consult)
		<tr  role="row" class="even">
			<td class="center" width="20%">
				<div class="action-buttons">
					{{$consult->Date_Consultation}}
				</div>
			</td>
			<td class="center" width="30%">
				<div class="action-buttons">
				<span >
				{{ $consult->Nom_Employe }} 
				 {{ $consult->Prenom_Employe }}
				</span>
				</div>
			</td>
			<td class="center" width="45%">
				<div class="action-buttons">
				<span >{{$consult->lieu->Nom}}</span>
				</div>
			</td>
			<td class="center"  width="5%">
			<div class="action-buttons">
				{{-- <button onclick="showConsult({!! str_replace("'", "'", json_encode($consult)) !!})"> 
					 <i class="ace-icon fa fa-pencil bigger-120"></i></button> --}}
				<button onclick="showConsult({{ $consult->id }})"> 
					  <i class="fa fa-eye"></i></button>
					 
			</div>
			</td>	
		</tr>
		@endforeach
		</tbody>
		</table>	
	</div>
</div>
@endsection