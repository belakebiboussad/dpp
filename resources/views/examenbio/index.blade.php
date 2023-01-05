@extends('app')<!-- app_laboanalyses  -->
@section('title','Demandes examens biologique ')
@section('page-script')
 <script>
 	field ="etat";
  var url = '{{ route("demandeexb.index") }}';
 	function getAction(data, type, dataToSet) {
    var actions = '<a href = "/demandeexb/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
    if(data.etat == "En Cours")
      actions +='&nbsp;<a href="/detailsdemandeexb/'+data.id+'" class="btn btn-info btn-xs" title="attacher résultat"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>';                
    return actions;
  }
 	$(function(){
 		$(".demandeBioSearch").click(function(e){
	  		getRequests(url,field,$('#'+field).val().trim());
	  	})
  	})
</script>
@endsection 	
@section('main-content')
<div class="row"><div class="col-sm-12 col-md-12"><h4><b>Rechercher une demande d'examen biologique</b></h4></div></div>
<div class="row">
  	<div class="panel panel-default">
    		<div class="panel-heading"><b>Rechercher</b></div>
    		<div class="panel-body">
	  	 <div class="row">
	      		<div class="col-sm-4">
	      			<div class="form-group">
	      				<label><b>Etat :</b></label>
	         			<select  id="etat" class="selectpicker show-menu-arrow  col-xs-12 col-sm-12 filter">
		         			<option selected disabled>Selectionner...</option>
		         			<option value="">En Cours</option>
		         			<option value="1">Validé</option>
	         	    </select>
	         		</div>
	         	</div>
	         	<div class="col-sm-4">
	      			<div class="form-group"><label><b>Service :</b></label>
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
    			<button type="submit" class="btn btn-sm btn-primary demandeBioSearch"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
    		</div>
       </div>
 </div>
 <div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demandes d'examen biologique</h5>&nbsp;<label><span class="badge badge-info numberResult"></span></label>
				</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
					<div class="col-xs-12">
					<table id="demandes_table" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th class="center">#</th>
								<th class="hidden-480"><strong>Date</th>
								<th class="center"><strong>Service</th>
								<th class="center">Médecin demandeur</th>
								<th class="center">Patient</th>
								<th class="center">Etat</th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($demandesexb as $index => $demande)
							<tr>
								<td class="center">
                  <input type="checkbox" class="editor-active check"  value="{{ $demande->id }}" /><span class="lbl"></span>            
                </td>
								@if(isset($demande->consultation))
                <td>{{ $demande->consultation->date->format('Y-m-d') }}</td>
                <td>{{ $demande->consultation->medecin->Service->nom }} </td>
                <td>{{ $demande->consultation->medecin->full_name }}</td>
                <td>{{ $demande->consultation->patient->full_name }}<small class="text-primary">(Consultation externe)</small></td>
                @else
                <td>{{ $demande->visite->date }}</td>
                <td>{{ $demande->visite->medecin->Service->nom }}</td>
                <td>{{ $demande->visite->medecin->full_name }}</td>
                <td>{{ $demande->visite->hospitalisation->patient->full_name}}<small class="text-warning">(Hospitalisation)</small></td>
                @endif
								<td>
								  <span class="badge badge-{{ ( $demande->getEtatID($demande->etat) == "0" ) ? 'warning':'primary' }}">{{ $demande->etat }}</span></span>
								</td>
								<td class="center">
								  <a href="{{ route('demandeexb.show', $demande->id) }}" class="btn btn-xs btn-secondary"><i class="fa fa-hand-o-up fa-xs"></i></a>
		    					<a href="/detailsdemandeexb/{{ $demande->id }}" title="attacher résultat" class="btn btn-xs btn-info">
									 <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
									</a>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
@endsection