@extends('app')
@section('page-script')
<script type="text/javascript">
function getRoomBeds(id)
{ 
  var url = '{{ route("lit.index") }}';
	$.ajax({
      type : 'GET',
      url :url,
      data:{   id :  id  },
      success:function(data,status, xhr){
      	 $('#salleRooms').html(data.html);
      }
  });
}	
</script>
@endsection
@section('main-content')
<div class="page-header"><h1>Liste des chambres</h1></div>
<div class="row">
	<div class="col-xs-7">
		<div class="widget-box widget-color-blue" >
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i><span>Détails des chambres</span>
			</h5>
			<div class="widget-toolbar widget-toolbar-primary no-border">
				<a class="btn btn-primary btn-sm" href="{{ route('salle.create')}}" role="button">
			  <i class="ace-icon  fa fa-plus-circle"></i> Chambre</a>
			</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class ="center">Dénomination</th>
							<th class ="center">ِCapacité</th>
							<th class ="center">Lits(nb)</th>
							<th class ="center">Unité</th>
							<th class ="center">Bloquée ?</th>
							<th class ="center">Service</th>
							<th class ="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>             
					@foreach($salles as $salle)
					<tr>
						<td><a href="#" id ={{  $salle->id }} onclick="getRoomBeds({{ $salle->id }});">{{ $salle->nom }}</a></td>
						<td >{{ $salle->max_lit }}</td>
						<td >{{ $salle->lits->count() }}</td>
						<td>{{ isset($salle->genre) ? 'Femme' : 'Homme'}}</td>
						<td>
							@if(isset( $salle->etat ))
								<span class="label label-sm label-warning">Oui
							@else
							<span class="label label-sm label-success">Non 
								
							@endif
							</span>
						</td>
						<td>{{ $salle->service->nom }}</td>
					  <td class ="center">
						  <a href="{{ route('salle.show',$salle->id) }}" class="btn btn-xs btn-success smalltext">
								<i class="fa fa-hand-o-up fa-xs"></i>	
							</a>
							<a href="{{ route('salle.edit', $salle->id) }}" class="btn btn-xs btn-info smalltext">
								<i class="ace-icon fa fa-pencil fa-xs"></i>
							</a> 
							<a href="{{ route('lit.create', array('id' => $salle->id) ) }}" class="btn btn-xs btn-grey smalltext" title="Ajouter un lit"><i class="ace-icon fa fa-plus fa-xs"></i>	
							</a>
							<a href="{{ route('salle.destroy', $salle->id) }}"  data-method="DELETE" data-confirm="Etes Vous Sur ?"class="btn btn-xs btn-danger smalltext" >
								<i class="ace-icon fa fa-trash-o fa-xs"></i>
							</a>
						</td>
					</tr>
					</tr>
					@endforeach
					</tbody>
				</table>
				</div>
			</div>	{{-- widget-body --}}
		</div>
	</div>{{-- col-xs-12 --}}
	<div class ="col-xs-5" id="salleRooms"> 
	</div>	
</div>
{{-- row --}}
@endsection