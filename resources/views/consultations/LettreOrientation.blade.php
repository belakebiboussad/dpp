<div id="lettreorient" class="modal" role="dialog" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
		 <div class="modal-content custom-width-modal">  <!-- Modal content-->
		       <div class="modal-header">
		           <button type="button" class="close" data-dismiss="modal">&times;</button>
		           <h4 class="modal-title">Lettre d'orientation</h4>
		      </div>
		       <div class="modal-body ">
			        <div class="container-fluid">
			         	 <div class="row">
				          	<label for="specialiteOrient"><b>Specialite:</b></label>
						<select class="form-control" id="specialiteOrient" name="specialiteOrient">
						      <option value="">Sélectionner...</option>
						      @foreach($specialites as $specialite)
						      <option value="{{ $specialite->id}}">
						      	{{$specialite->nom}}
						      </option>
						       @endforeach 
				      		</select>
			    		</div><!-- row -->
			    		<div class="space-12"></div>
	    				<div class="row">
		    				<label for="medecin"><b>Medecin :</b></label>
					     	<select class="form-control" id="medecinOrient" name="medecinOrient">
					      	<option value="">Sélectionner...</option> 
						      @foreach($meds as $med)
						      <option value="{{ App\modeles\employ::where("id", $med->employee_id)->get()->first()->id }}">
						        {{ App\modeles\employ::where("id", $med->employee_id)->get()->first()->Nom_Employe }} {{ App\modeles\employ::where("id", $med->employee_id)->get()->first()->Prenom_Employe }}
						      </option>
						      @endforeach 
					      </select>
	   				</div><!-- row -->
	   				<div class="space-12"></div>
	   				<div class="row">
						<label for="motif"><b>Motif :</b></label><br>			     
				     		<textarea class="form-control" id="motifOrient" name="motifOrient" cols="30" rows="3"></textarea>
				 	</div>
				 </div>        
      		       </div> 
      			<div class="space-12"></div> <div class="space-12"></div>
	     		 <div class="modal-footer">
			        <div class="col-sm-12">
			        	<button type="button" class="btn btn-xs btn-primary" data-dismiss="modal" onclick="lettreorientation()">Enregistrer</button>
				      	<button type="button" class="btn btn-xs btn-success"  data-toggle="modal" data-target="#lettreorien"  onclick="lettreoriet('{{ Auth::User()->employ->Nom_Employe }}','{{Auth::User()->employ->Prenom_Employe }}','{{Auth::User()->employ->Service_Employe }}','{{Auth::User()->employ->tele_mobile }}','{{$patient->Nom}}','{{ $patient->Prenom}}',{{$patient->getAge() }})">Imprimer</button>
				      	<button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Annuler</button>
			        </div>
			 </div>
   		 </div>
 	 </div>
</div>     
<div id="lettreorien" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document"><!-- Modal content-->
		<div class="modal-content custom-height-modal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><b>Lettre Orientation :</b></h4>
			</div>
			<div class="modal-body" height="100%">
				 <iframe id="lettreorientation" class="preview-pane hidden" type="application/pdf" width="100%" height="600" frameborder="0" style="position:relative;z-index:999" hidden></iframe>
			</div>
		</div>
	</div>
</div>