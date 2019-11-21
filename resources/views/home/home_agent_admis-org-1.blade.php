@extends('app_agent_admis')
@section('main-content')
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				Liste des admissions du jour <strong>&quot;{{ Date('Y-m-d') }}&quot;	</strong>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th style="display: none;"></th>
						<th>Patient</th>
						<th>Service</th>
						<th>Salle</th>
						<th>Lit</th>
						<th>Date prévue d'entrée</th>
						<th>Heure prévue d'entrée</th>
						<th>{{ count($admissions)}}</th>
					</tr>
				</thead>
				<tbody>		
				@foreach($admissions as $admission)
					<!-- @if($admission->date_RDVh == Date('Y-m-d'))		 -->
					<tr>
						<td style="display: none;">{{$admission->id_admission}}</td>
						<td>{{ $admission->Nom }} {{$admission->Prenom }}</td>
						<td>{{ $admission->nom_service }}</td>
						<td>{{ $admission->nom_salle }}</td>
						<td>{{ $admission->num_lit }}</td>
						<td>
							<span  style="color: red;">
								<strong>{{ $admission->date_RDVh }}</strong>
							</span>
						</td>	
						<td>
							<span  style="color: red;">
								<strong>{{ $admission->heure_RDVh }}</strong>
							</span>
						</td>							
						<td>								<!-- Trigger the modal with a button -->
							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#entrée{{$admission->id_admission}}" data-backdrop="false">confirmer l'entrée</button>
							<!--model pop-up -->
							<div id="entrée{{$admission->id_admission}}" class="modal fade" role="dialog" aria-hidden="true">
 							<div class="modal-dialog">
							<div class="modal-content">
      							<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal">&times;</button>
        									<h4 class="modal-title">confirmer l'entrée du patient:</h4>
      							</div>
      							<div class="modal-body">
        							<p><span  style="color: blue;"><strong >{{ $admission->Nom }} {{$admission->Prenom }}</strong></span></p>
        								<p>le  &quot;<span  style="color: orange;"><strong>{{ $admission->date_RDVh }}</strong></span>&quot; à <span  style="color: red;"><strong>{{Date("H:i:s")}}</strong></span></p>			
        							</div>
      							<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="{{route('hospitalisation.store')}}">{{ csrf_field() }}
      							<input id="id_ad" type="text" name="id_ad" value="{{$admission->id_admission}}" hidden>
      							<input id="id_RDV" type="text" name="id_RDV" value="{{$admission->idRDV}}" hidden>
      							<div class="modal-footer">
        							<button type="button" class="btn btn-default" data-dismiss="modal">
        								 <i class="ace-icon fa fa-undo bigger-120"></i>
        								Fermer
        							</button>
        							<button  type="submit" class="btn btn-success" >
        								  <i class="ace-icon fa fa-check bigger-120"></i>
        								Valider
        							</button>
      							</div> 
      							</form>
   							 </div>
  							</div>
							</div>
						</td>
					</tr>
				<!-- @endif	 -->
				@endforeach
				</tbody>
			</table>
		</div>
		</div>
	</div>
	</div><!-- /.span -->

@endsection