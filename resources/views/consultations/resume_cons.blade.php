@extends('app')
@section('page-script')
{{-- <script type="text/javascript" src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script> --}}
<script type="text/javascript">
	  $('document').ready(function(){
		var table = $('#consultList').DataTable({
			 "searching":false,
			 "processing": true,
			 	"scrollY":"400px",
			 	"scrollCollapse": true,
			 	"paging":false,
			 	"language": {
        		"url": '/localisation/fr_FR.json'
        },	    
		});
 
    $('#consultList tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
	});
	function showConsult(consultId, consult)
  {
  	 url= '{{ route ("consultdetailsXHR", ":slug") }}',
     url = url.replace(':slug',consultId);
     $.ajax({
            type : 'GET',
            url:url,
            success:function(data,status, xhr){
              $('#consultDetail').html(data.html);     
            },
            error:function (data){
			        console.log('Error:', data);
			      }
     });             
  }
</script>
@stop
@section('main-content')
<div class="page-header">
<h1><strong>Résumé  du Consultation Pour :</h1>
<?php $patient = $consultation->patient; ?>
  @include('patient._patientInfo', $patient)
</div>
<div class="row" style = "margin-top:-2%">
	<div class="col-sm-7" id="consultDetail">
	 @include('consultations.inc_consult')
	</div>
	<div class="col-sm-5">
		<div class="page-header" style="margin-top:5px;">
  		<h4>Liste des Consulations :</h4>
		</div>	
		<table id="consultList" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
		<thead>
		<tr role="row">
			<th class="sorting_asc center" tabindex="0"  aria-sort="ascending" aria-label="Position: activate to sort column descending" style="width:20%">Date</th>
			<th class="center sorting_disabled" width="45%">Medecin</th>
			<th class="center sorting_disabled" width="45%">Service</th>
			<th width="10%" ></th>
		</tr>
		</thead>
		<tbody>
		@foreach($consultation->patient->Consultations as $consult)
		<tr  role="row" class="even">
			<td class="center" width="20%">
				{{$consult->Date_Consultation}}
			</td>
			<td width="30%">
				<span>{{ $consult->docteur->Nom_Employe }} {{ $consult->docteur->Prenom_Employe }}</span>
			</td>
			<td width="45%">
				<span >{{$consult->docteur->service->nom}}</span>
			</td>
			<td class="center sorting_disabled"  width="8%">
				<button class="btn btn-primary btn-xs" onclick="showConsult({{ $consult->id }},$(this));"> 
						  <i class="fa fa-hand-o-up"></i>
			  </button>		 
			</td>	
		</tr>
		@endforeach
		</tbody>
		</table>	
	</div>
</div>
@endsection