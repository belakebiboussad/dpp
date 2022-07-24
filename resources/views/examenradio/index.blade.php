@extends('app')
@section('title','Demandes examens radiologique ')
@section('page-script')
 <script>
 	var field ="etat";
 	var url = '{{ URL::to('searchImgRequests') }}';
 	function getAction(data, type, dataToSet) {
    var actions = '<a href = "/demandeexr/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
    if(data.etat == "En Cours")
      actions +='&nbsp;<a href="/details_exr/'+data.id+'" class="btn btn-info btn-xs" title="attacher résultat"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>';                
     return actions;
  } 
  $(function(){
		$(".demandeImgExamSearch").click(function(e){
	   	getRequests(url,field,$('#'+field).val().trim());
  	})
	})
 </script>
 @endsection
@section('main-content')
<div class="page-header"><h4>Rechercher une demande d'examen radiologique</h4></div>
<div class="row">
  	<div class="panel panel-default">
    		<div class="panel-heading">Rechercher</div>
    		<div class="panel-body">
	  	 <div class="row">
	      		<div class="col-sm-4">
	      			<div class="form-group">
	      				<label class="control-label">Etat :</label>
	         			<select  id="etat" class="selectpicker col-xs-12 col-sm-12 filter">
		         			<option selected disabled>Selectionner...</option>
		         			<option value="">En Cours</option>
		         			<option value="1">Validé</option>{{-- <option value="0">Rejeté</option> --}}
	         	    </select>
	         		</div>
	         	</div>
	         	<div class="col-sm-4">
	      			<div class="form-group"><label>Service :</label>
		      			<select  id="service" class="selectpicker col-xs-11 col-sm-11 filter">
		      				<option value="">Selectionner...</option>	
		      				@foreach ($services as $service)
		      					<option value="{{ $service->id }}">{{ $service->nom}}</option>
		      				@endforeach
		      			</select>
	      			</div>
	         	</div>
         	</div>
         	</div>
         	<div class="panel-footer">
    			<button type="submit" class="btn btn-sm btn-primary demandeImgExamSearch"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
    		</div>
    </div> {{-- panel --}}
 	</div>
 	 <div class="row">
		<div class="col-xs-12">
 			<div class="widget-box">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demandes d'examen radiologique</h5>&nbsp;<label><span class="badge badge-info numberResult"></span></label>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<table id="demandes_table" class="table table-striped table-bordered" width="100%">
									<thead>
										<tr>
											<th class="center">#</th>
											<th class="hidden-480 center">Date</th>
											<th class="center">Service</th>
											<th class="center">Médecin demandeur</th>
											<th class="center">Patient</th>
											<th class="center">Etat</th>
											<th class="center"><em class="fa fa-cog"></em></th>
										</tr>
									</thead>
									<tbody>
										@foreach($demandesexr as $index => $demande)
											<tr>
                        <td class="center">
                           <input type="checkbox" class="editor-active check"  value="{{ $demande->id }}" /><span class="lbl"></span>            
                        </td>
											@if(isset($demande->consultation))
												<td>{{ $demande->consultation->date }}</td>
												<td>{{ $demande->consultation->medecin->Service->nom }}</td>
												<td>{{ $demande->consultation->medecin->full_name }} </td>
												<td>{{ $demande->consultation->patient->full_name}}<small class="text-primary">(Consultation)</small></td>
											@else
												<td>{{ $demande->visite->date }}</td>
												<td>{{ $demande->visite->medecin->Service->nom }}</td>
												<td>{{ $demande->visite->medecin->full_name }}</td>
												<td>{{ $demande->visite->hospitalisation->patient->full_name }}<small class="text-warning">(Hospitalisation)</small></td>
											@endif
												<td class="center">
												  <span class="badge badge-{{ ( $demande->getEtatID($demande->etat) == "0" ) ? 'warning':'primary' }}">{{ $demande->etat }}</span>
													</span>
												</td>
												<td class="center">
												 	<a href="{{ route('demandeexr.show', $demande->id) }}" class="btn btn-xs btn-secondary"><i class="fa fa-hand-o-up fa-xs"></i></a>
			              				<a href="/details_exr/{{ $demande->id}}" class="btn btn-xs btn-info">	<i class="glyphicon glyphicon-upload glyphicon glyphicon-white" title="attacher résultat"></i></a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>		
			</div>{{-- widget-box --}}
		</div>{{-- col-xs-12 --}}
	</div>{{-- row --}}

@endsection