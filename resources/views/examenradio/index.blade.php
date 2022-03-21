@extends('app')
@section('title','Demandes examens radiologique ')
@section('page-script')
 <script>
 	var field ="etat";
 	var url = '{{ URL::to('searchImgRequests') }}';
 	 function getAction(data, type, dataToSet) {
            var actions = '<a href = "/demandeexr/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
            if(data.etat == null)
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
<div class="row"><div class="col-sm-12 col-md-12"><h4><strong>Rechercher une demande d'examen radiologique</strong></h4></div></div>
<div class="row">
  	<div class="panel panel-default">
    		<div class="panel-heading"><strong>Rechercher</strong></div>
    		<div class="panel-body">
	  	 <div class="row">
	      		<div class="col-sm-4">
	      			<div class="form-group">
	      				<label><strong>Etat :</strong></label>
	         			<select  id="etat" class="selectpicker show-menu-arrow  col-xs-12 col-sm-12 filter">
		         			<option selected disabled>Selectionner...</option>
		         			<option value="">En Cours</option>
		         			<option value="1">Validé</option>{{-- <option value="0">Rejeté</option> --}}
	         	    </select>
	         		</div>
	         	</div>
	         	<div class="col-sm-4">
	      			<div class="form-group"><label><strong>Service :</strong></label>
		      			<select  id="service" class="selectpicker show-menu-arrow col-xs-11 col-sm-11 filter">
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
											<th class="hidden-480 center"><strong>Date</strong></th>
											<th class="center"><strong>Service demandeur</strong></th>
											<th class="center"><strong>Médecin demandeur</strong></th>
											<th class="center"><strong>Patient</strong></th>
											<th class="center"><strong>Etat</strong></th>
											<th class="center"><em class="fa fa-cog"></em></th>
										</tr>
									</thead>
									<tbody>
										@foreach($demandesexr as $index => $exr)
											<tr>
											@if(isset($exr->consultation))
												<td class="center">{{ $index + 1 }}</td>
												<td>{{ $exr->consultation->date }}</td>
												<td>{{ $exr->consultation->medecin->Service->nom }}</td>
												<td>{{ $exr->consultation->medecin->full_name }} </td>
												<td>{{ $exr->consultation->patient->full_name}}<small class="text-primary">(Consultation)</small></td>
											@else
												<td class="center">{{ $index + 1 }}</td>
												<td>{{ $exr->visite->date }}</td>
												<td>{{ $exr->visite->medecin->Service->nom }}</td>
												<td>{{ $exr->visite->medecin->full_name }}</td>
												<td>{{ $exr->visite->hospitalisation->patient->full_name }}<small class="text-warning">(Hospitalisation)</small></td>
											@endif
												<td>
												
													@if($exr->etat == null)
														<span class="badge badge-success">
														En Cours
													@elseif($exr->etat == "1")
														<span class="badge badge-info">
														Validé
													@else	
														<span class="badge badge-warning">
														Rejeté
													@endif
													</span>
												</td>
												<td class="center">
												 	<a href="{{ route('demandeexr.show', $exr->id) }}" class="btn btn-xs btn-secondary"><i class="fa fa-hand-o-up fa-xs"></i></a>
			              						<a href="/details_exr/{{ $exr->id}}" class="btn btn-xs btn-info">	<i class="glyphicon glyphicon-upload glyphicon glyphicon-white" title="attacher résultat"></i></a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>		
			</div>{{-- widget-box --}}
		</div>{{-- col-xs-12 --}}
	</div>{{-- row --}}

@endsection