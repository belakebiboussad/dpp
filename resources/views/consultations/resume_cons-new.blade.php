@extends('app_med')
@section('page-script')
<script type="text/javascript" src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script>
<script type="text/javascript">

	  $('document').ready(function(){
	           $('#example').DataTable({
	  		searching: false,
	  		"bInfo" : false,
	  		"scrollY": "450px",
        			"scrollCollapse": true,
        			"paging": true,
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
  @include('partials._patientInfo')
</div>

<div class="row">
	<div class="col-sm-6 alert alert-block alert-success voffsetright">
		<div class="content voffsetright">
		<span style="font:bold 18px verdana;">les consultations du patient </span>
		<span"style="font:bold 12px verdana;">&nbsp;"{{$patient->Nom}} {{$patient->Prenom}} "</span>
		</div>
	</div>
	<div class="col-sm- 6 alert alert-block alert-success voffsetleft">
		<div class="content voffsetleft">
		<span style="font:bold 18px verdana;">Résumé de la Consultation du</span>
		<span"style="font:bold 12px verdana;">&nbsp;"{{ $consultation->Date_Consultation }}"</span>		
		</span"style="font:bold>
		
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<br>
		<table id="example" class="display dataTable" width="100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" role="grid" aria-describedby="example_info" style="width: 100%;">
			<thead>
				<tr role="row">
				<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 137px;">n°</th>
				<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Position: activate to sort column descending" style="width: 216px">Date</th>
				<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 102px;">Motif</th>
				<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 42px;">Medecin</th>
				<th data-orderable="false" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Start date" style="width: 91px;">Lieu consultation</th></tr>
			</thead>
			</thead>
			
			<tbody>
			<tr role="row" style ="height:0px;" hidden>
				<td></td>
				<td class="sorting_1"></td>
				<td></td>
				<td></td>
				<td></td>					
			</tr>

			@foreach($consults as $i=>$consult)
				<tr  role="row" class="even">
					<td class="sorting_1" width="8%">{{ ++ $i }}</td>
					<td class="center" width="13%">
						<div class="action-buttons">
							{{$consult->Date_Consultation}}
						</div>
					</td>
					<td class="center" width="35%">
						<div class="action-buttons" >
							{{$consult->Motif_Consultation}}
						</div>
					</td>
					<td class="center" width="15%">
						<div class="action-buttons">
						<span >
							{{ $consult->Nom_Employe }} 
							 {{ $consult->Prenom_Employe }}
						</span>
						</div>
					</td>
					<td class="center" width="20%">
						<div class="action-buttons">
							<span >{{$consult->Nom}}</span>
						</div>
					</td>
					<td class="center"  width="10%">
						<div class="action-buttons">
						<button onclick="showConsult({!! str_replace("'", "'", json_encode($consult)) !!})"> 
						 <i class="ace-icon fa fa-pencil bigger-120"></i></button>

						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>			
	</div>
	<div class="col-sm-5">
	</div>
</div>
@endsection