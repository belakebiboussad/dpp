@extends('app')<!-- app_laboanalyses  -->
@section('title','Demandes examens biologique ')
@section('page-script')
 <script>
 	field ="etat";
  var url = '{{ route("demandeexb.index") }}';
 	function getAction(data, type, dataToSet) {
    var actions = '<a href = "/demandeexb/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
    if(data.etat == "En cours")
      actions +=' <a href="/detailsdemandeexb/'+data.id+'" class="btn btn-info btn-xs" title="attacher résultat"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>';                
    return actions;
  }
 	$(function(){
 		$(".demandeBioSearch").click(function(e){
	  		getRequests(url,field,$('#'+field).val().trim());
	  	})
  	})
</script>
@stop 	
@section('main-content')
<div class="page-header"><h1>Rechercher une demande d'examen biologique</h1></div>
<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">Rechercher</div>
    	<div class="panel-body">
	  	  <div class="row">
	      	<div class="col-sm-4">
	      			<div class="form-group"><label>Etat</label>
	      				<select  id="etat" class="form-control selectpicker show-menu-arrow  filter">
		         			<option val="" selected disabled>Selectionner...</option>
		         			<option value="">En cours</option><option value="1">Validée</option>
	         	    </select>
	         		</div>
	         	</div>
	         	<div class="col-sm-4">
	      			<div class="form-group"><label>Service</label>
		      			<select  id="service" class="form-control selectpicker show-menu-arrow filter">
		      				<option val="" selected disabled>Selectionner...</option>	
		      				@foreach ($services as $service)
		      					<option value="{{ $service->id }}">{{ $service->nom}}</option>
		      				@endforeach
		      			</select>
	      			</div>
	         	</div>
         	</div>
         	</div>
         	<div class="panel-footer">
    			<button type="submit" class="btn btn-sm btn-primary demandeBioSearch"><i class="fa fa-search"></i> Rechercher</button>
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
								<th class="center">#</th><th class="hidden-480">Date</th>
								<th class="center">Service</th><th class="center">Médecin demandeur</th>
								<th class="center">Patient</th><th class="center">Etat</th>
							<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($demandesexb as $index => $demande)
							<tr>
								<td class="center">
                  <input type="checkbox" class="editor-active check"  value="{{ $demande->id }}" /><span class="lbl"></span>            
                </td>
                <td>{{ $demande->imageable->date->format('Y-m-d') }}</td>
								<td>{{ $demande->imageable->medecin->Service->nom }}</td> 
                <td>{{ $demande->imageable->medecin->full_name }}</td> 
                <td>{{ $demande->imageable->patient->full_name }}<small class="text-primary"> ({{ ($demande->imageable_type === 'App\modeles\visite')?'Hospitalisation':'Consultation' }})</small>
                </td>
              	<td>{!! $formatStat
($demande->etat) !!}</td>
								<td class="center">
								  <a href="{{ route('demandeexb.show', $demande->id) }}" class="btn btn-xs btn-secondary"><i class="fa fa-hand-o-up fa-xs"></i></a>
		    					<a href="/detailsdemandeexb/{{ $demande->id }}" title="attacher résultat" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>
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
@stop