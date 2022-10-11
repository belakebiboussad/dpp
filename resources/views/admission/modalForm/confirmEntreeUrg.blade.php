<div id="{{ $demande->id }}" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Confirmer l'entrée du patient {{ $demande->id }}:</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<h3><span style="color: blue;"><b>{{ $demande->consultation->patient->full_name}}</b></span></h3>
				</div>
			</div>
			<div class="row">
			 	<div class="col-sm-12">
				 	<h3>
						<span style="color: orange;"><b>{{  (\Carbon\Carbon::parse($demande->consultation->date))->format('d/m/Y') }}</b>
						</span>&nbsp;à &nbsp;<span class="text-danger"><b>{{ Date("H:i") }}</b></span>
				 	</h3>
			 	</div>	
			</div>
		</div><!-- modalbody -->
		<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="{{route('admission.store')}}">
		{{ csrf_field() }}
			<input id="demande_id" type="text" name="demande_id" value="{{$demande->id}}" hidden>
			<div class="modal-footer">
				<button  type="submit" class="btn btn-success" ><i class="ace-icon fa fa-check"></i>Valider</button>
				<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
			</div> 
		</form>
	</div>
	</div>
</div>