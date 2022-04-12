<div id="traitModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="TraitCrudModal">Prescrire un traitement</h4>
        </div>
      <div class="modal-body">
        <form id="addTrait" method="POST" action ="{{route('traitement.store')}}" name="form1" id="form1">  <!-- /Acte/save -->
        {{ csrf_field() }}
        <input type="hidden" name="id_visite" id ="id_visiteT" value="{{ $id }}">
        <input type="hidden" id ="trait_id" value=""/>
        <div class="row">
          <div class="col-xs-12">
            <label for="specialiteProd"><strong>Spécialité :</strong></label>
            <select class="form-control" id="specialiteProd" name="specialiteProd">
              <option value="" selected disabled>Sélectionnez la spécialité...</option>
               @foreach($specialitesProd as $specialite)
                <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
              @endforeach 
              </select>
          </div>    
        </div><div class="space-12"></div> <!-- row -->
        <div class="row">
          <div class="col-xs-12">
            <label for="specialiteProd"><strong>Médicament:</strong></label>
            <select id="produit" data-placeholder="selectionnez le Médicament" class="selectpicker show-menu-arrow place_holde form-control" disabled></select>
          </div>    
        </div><div class="space-12"></div>
        <div class="row">
          <div class="col-xs-12">
            <label for="posologie"><strong>Posologie :</strong></label>
            <input type="text" id="posologie" class="form-control" placeholder = "posologie de Traitement"/>
          </div>
        </div><div class="space-12"></div><br/>
        <div class="row">
          <div class="col-xs-12">
            <label for="dureeT"><strong>Nombre de prise/jour:</strong></label>
            <input type="number" id="nbrPJ" class="form-control"  min="1" value="1" placeholder = "Nombre de prise"/>
          </div>
        <!--  <div class="col-xs-6"><label for="dureeT"><strong>Durée(jour):</strong></label>
        <input type="number" id="dureeT" class="form-control"  min="1" value="1" placeholder = "Duree"/></div> -->
        </div><hr>
        <div class="row" align="right">
          <button type="submit" id="EnregistrerTrait" class="btn btn-success btn-sm" value ="add">
            <i class="ace-icon fa fa-save bigger-110"></i>&nbsp;&nbsp;Enregistrer
          </button>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
            <i class="ace-icon fa fa-close bigger-110"></i>Fermer
          </button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- <div class="row"><div class="col-sm-3"><label for="" class="control-label no-padding-right"><b>Periodes:</b></label></div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="TMatin" value="Matin" checked><b>Matin</b></label>
</div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="TMidi" value="Midi"><b>Midi</b></label></div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="TSoir" value="Soir"><b>Soir</b></label>
</div></div><div class="space-12"></div><div class="row"><div class="col-sm-3">-->