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
<div class="row"><h4><strong>Liste des chambres</strong></h4>
</div>
<div class="row">
	<div class="col-xs-7">
		<div class="widget-box widget-color-blue" >
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i><span><b>Détails des chambres</b></span>
			</h5>
			<div class="widget-toolbar widget-toolbar-primary no-border">
					<a class="btn btn-primary btn-sm" href="{{ route('salle.create')}}" role="button">
						<i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i> <strong>Chambre</strong>
					</a>
				</div>
			
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class ="center">Dénomination</th>
							<th class ="center">ِCapacité</th>
							<th class ="center">Lits en place</th>
							<th class ="center">N° Bloc</th>
							<th class ="center">Etage</th>
							<th class ="center">Unité</th>
							<th class ="center">Etat</th>
							<th class ="center"><strong>Service</strong></th>
							<th class ="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>             
					@foreach($salles as $salle)
					<tr>
						<td><a href="#" id ={{  $salle->id }} onclick="getRoomBeds({{ $salle->id }});">{{ $salle->nom }}</a></td>
						<td >{{ $salle->max_lit }}</td>
						<td >{{ $salle->lits->count() }}</td>
						<td>{{ $salle->bloc }}</td>
						<td>{{ $salle->etage }}</td>
						<td>
						@if($salle->genre)
							Femme
						@else
							Homme
						@endif
						</td>
						<td>
							@if(isset( $salle->etat ))
								<span class="label label-sm label-warning">
							@else
							<span class="label label-sm label-success">
								Non 
							@endif
							Bloquée</span>
						</td>
						<td>{{ $salle->service->nom }}</td>
					  <td class ="center">
						  <a href="{{ route('salle.show',$salle->id) }}" class="btn btn-xs btn-success smalltext">
								<i class="fa fa-hand-o-up fa-xs"></i>	
							</a>
							<a href="{{ route('salle.edit', $salle->id) }}" class="btn btn-xs btn-info smalltext">
								<i class="ace-icon fa fa-pencil fa-xs"></i>
							</a> <!-- /lit/create/{{-- $salle->id --}} -->
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