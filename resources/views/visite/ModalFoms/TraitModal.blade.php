<div id="traitModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="TraitCrudModal">Prescrire un traitement</h4>
        </div> 
        <form id="addTrait" method="POST" action ="{{route('traitement.store')}}" name="form1" id="form1">  <!-- /Acte/save -->
        {{ csrf_field() }}
        <input type="hidden" name="id_visite" id ="id_visiteT" value="{{ $id }}">
        <input type="hidden" id ="trait_id" value=""/>
      <div class="modal-body">
        <div class="form-group row">
               <label  class="control-label" for="specialiteProd">Spécialité :</label>
              <select class="form-control" id="specialiteProd" name="specialiteProd">
              <option value="" selected disabled>Sélectionnez la spécialité...</option>
               @foreach($specialitesProd as $specialite)
                <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
              @endforeach 
              </select>
        </div><!-- row -->
        <div class="form-group row">
              <label class="control-label" for="specialiteProd">Médicament :</label>
              <select id="produit" data-placeholder="selectionnez le Médicament" class="selectpicker  form-control" disabled></select>
        </div>
        <div class="form-group row">
            <label  class="control-label" for="posologie">Posologie :</label>
            <input type="text" id="posologie" class="form-control" placeholder = "posologie de Traitement"/>
        </div>
        <div class="fom-group row">
            <label  class="control-label" for="dureeT">Nombre de prise/jour :</label>
            <input type="number" id="nbrPJ" class="form-control"  min="1" value="1" placeholder = "Nombre de prise"/>
           <!-- <label for="dureeT">Durée(jour):</label><input type="number" id="dureeT" class="form-control"  min="1" value="1" placeholder = "Duree"/> -->
        </div>
    {{--     <div class="row" align="right"> --}}   {{-- </div> --}}
      </div>
      <div class="modal-footer">
        <button type="submit" id="EnregistrerTrait" class="btn btn-success btn-sm" value ="add">
            <i class="ace-icon fa fa-save"></i>Enregistrer </button>
          <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- <div class="row"><div class="col-sm-3"><label for="" class="control-label no-padding-right"><b>Periodes:</b></label></div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="TMatin" value="Matin" checked><b>Matin</b></label>
</div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="TMidi" value="Midi"><b>Midi</b></label></div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="TSoir" value="Soir"><b>Soir</b></label>
</div></div><div class="space-12"></div><div class="row"><div class="col-sm-3">-->