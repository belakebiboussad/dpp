<div id="lettreorient" class="modal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <!-- Modal content-->
    <div class="modal-content custom-width-modal">
      <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Lettre d'orientation</h4>
           @include('patient._patientInfo')
      </div>
      <div class="modal-body ">
           <div class="container-fluid">
           <div>
	       	<label for="specialite"><b>Specialite:</b></label>
		<select class="form-control" id="specialite" name="specialite">
		        <option value="">Sélectionner...</option>
		       @foreach($specialites as $specialite)
		         <option value="{{ $specialite->id}}">
		        	{{$specialite->nom}}
		          </option>
		       @endforeach 
	      	</select>
    	</div>
    	<br/>
   	<div>
		<label for="medecin"><b>Medecin :</b></label>
	     	 <select class="form-control" id="medecin" name="medecin">
	       		<option value="">Sélectionner...</option> 
		          @foreach($meds as $med)
		          <option value="{{ App\modeles\employ::where("id", $med->employee_id)->get()->first()->id }}">
		            {{ App\modeles\employ::where("id", $med->employee_id)->get()->first()->Nom_Employe }} {{ App\modeles\employ::where("id", $med->employee_id)->get()->first()->Prenom_Employe }}
		          </option>
		          @endforeach 
	      	</select>
   	</div>
   	<br/>
	<div>
		<label for="motif"><b>Motif :</b></label>
	      	<br>
	      	<input type="text" class="form-control" id="motifOrient" name="motifOrient">
	 </div>
    	<br/><br>
          </div>        
      </div> 
      <div class="space-12"></div>
          <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="lettreorientation()">Enregistrer</button>
	          <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#lettreorien"  onclick="lettreoriet('{{ Auth::User()->employ->Nom_Employe }}','{{Auth::User()->employ->Prenom_Employe }}','{{Auth::User()->employ->Service_Employe }}','{{Auth::User()->employ->tele_mobile }}','{{$patient->Nom}}','{{ $patient->Prenom}}',{{Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age}})">Imprimer</button>
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>

     	 </div>
    </div>

  </div>
</div>

        
         <div id="lettreorien" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<!-- Modal content-->
		<div class="modal-content custom-height-modal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Ordonnance :</b></h4>
			</div>
			<div class="modal-body" height="100%">
				 <iframe id="lettreorientation" class="preview-pane hidden" type="application/pdf" width="100%" height="600" frameborder="0" style="position:relative;z-index:999" hidden></iframe>

			</div>
			<div class="modal-footer">
				{{-- <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="storeord()">Enregistrer</button> --}}
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="storeord1()" >Terminer</button>
			</div>
		</div>
	</div>
</div>