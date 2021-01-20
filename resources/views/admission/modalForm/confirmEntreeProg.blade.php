<div id="{{ $rdv->id }}" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Confirmer l'entrée du patient: </h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<h3>
						<span style="color: blue;"><strong>{{$rdv->demandeHospitalisation->consultation->patient->Nom}} &nbsp;{{$rdv->demandeHospitalisation->consultation->patient->Prenom}}</strong></span>
					</h3>
				</div>
			</div>
			<div class="row">
			 	<div class="col-sm-12">
				 	<h3>
						le  &quot;<span  style="color: orange;"><strong>{{ $rdv->date_RDVh }}</strong></span>&quot; &nbsp;à &nbsp;<span style="color: red;"><strong>{{Date("H:i")}}</strong></span>
				 	 </h3>
			 	</div>	
			</div>
		</div><!-- modalbody -->
		<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="{{route('admission.store')}}">
		{{ csrf_field() }}
			<input id="id_RDV" type="text" name="id_RDV" value="{{$rdv->id}}" hidden>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-120"></i>Annuler</button>
				<button  type="submit" class="btn btn-success" ><i class="ace-icon fa fa-check bigger-120"></i>Valider</button>
			</div> 
		</form>
	</div>
	</div>
</div>