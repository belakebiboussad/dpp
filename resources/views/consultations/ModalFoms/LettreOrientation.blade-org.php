<div id="lettreorient" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">	<!-- Modal content-->
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Lettre d'orientation</h4></div>
			<div class="modal-body">
			  <div class="row">
			    <div class="col-xs-12">
				 		<label for="specialiteOrient"><b>Spécialité:</b></label>
				  	<select class="form-control" id="specialiteOrient" name="specialiteOrient">
					  	<option value="">Sélectionner...</option>
					  	@foreach($specialites as $specialite)
					  	<option value="{{ $specialite->id}}">
							{{$specialite->nom}}
					  	</option>
					  	@endforeach 
				  	</select>
				  </div>
			  	</div><div class="space-12"></div>
			  	<div class="row">
	   				<div class="col-xs-12">
							<label for="motif"><b>Motif de consultation :</b></label>     
							<textarea class="form-control" id="motifC" cols="10" rows="3"></textarea>
						</div>
					</div><div class="space-12"></div>
{{--<div class="row"><div class="col-xs-12"><label for="medecin"><b>Médecin :</b></label><select class="form-control" id="medecinOrient" name="medecinOrient"><option value="">Sélectionner...</option> 
@foreach($meds as $med)<option value="{{ $med->employ->id}}">{{ $med->employ->full_name}}</option>@endforeach</select></div></div><div class="space-12"></div>--}}
	   			<div class="row">
	   				<div class="col-xs-12">
							<label for="motif"><b>Examen général :</b></label>     
							<textarea class="form-control" id="motifOrient" name="motifOrient" cols="20" rows="3"></textarea>
						</div>
					</div>
			</div>{{-- modal-body --}}
			<div class="space-12"></div><div class="space-12"></div>
		  <div class="modal-footer">
          <div class="col-sm-12">
			    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="lettreorientation()"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
				  <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" onclick="orLetterPrint('{{$patient->Nom}}','{{ $patient->Prenom}}','{{$patient->age }}','{{$patient->IPP }}','{{$etab->tutelle }}','{{$etab->nom }}','{{ $etab->adresse }}','{{ $etab->tel }}','{{$etab->logo }}')"><i class="ace-icon fa fa-print"></i>Imprimer</button>
				  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			  </div>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}
<div id="lettreorien" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document"><!-- Modal content-->
		<div class="modal-content custom-height-modal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><b>Lettre Orientation :</b></h4>
			</div>
			<div class="row"><canvas id="lettreorientation" height="1%"><img id='itfL'/></canvas></div>
		</div>
	</div>
</div>