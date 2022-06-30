<div id="acteModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="acteCrudModal">Prescrire un Acte Médicale</h4>
      </div>
      <div class="modal-body">
        <form id="addActe" method="POST" action ="{{ route('acte.store')}}" name="form1" id="form1">
        {{ csrf_field() }}
        <input type="hidden" value="" name="idhosp">
        <input type="hidden" id ="id_visite" value="{{ $id }}">
        <input type="hidden" id ="acte_id">
        <div class="row">
          <div class="col-xs-12">
            <label for="specialiteProd"><strong>Acte:</strong></label>
            <input type="text" id="acte" class="form-control" placeholder = "Nom de l'Acte"/> 
          </div>    
        </div><div class="space-12"></div>
        <div class="row">
          <div class="col-xs-12">
            <label for="type"><strong>Type :</strong></label>
            <select class="form-control" id="type" data-placeholder="selectionnez le type de l'acte">
              <option value="" selected disabled >selectionnez le type de l'acte</option>
              <option value="paramedicale">paramédicale</option>
              <option value="medicale">médicale</option>
            </select>
          </div>    
        </div><div class="space-12"></div>
        <div class="row">
          <div class="col-xs-12">
            <label for="code_ngap"><strong>Code NGAP :</strong></label>
            <select id="code_ngap" class="form-control">
              <option value="" selected disabled>selectionnez le Code NGAP</option>
              @foreach($codesNgap as $code)
              <option value="{{ $code->code }}">{{ $code->libelle }}</option>}
              @endforeach
            </select>
          </div>
        </div><div class="space-12"></div>
        <div class="row">
          <div class="col-xs-12">
            <label for="specialiteProd"><strong>Application:</strong></label>
            <input type="text" id="description" class="form-control" placeholder = "applcation de l'acte"/> 
          </div>    
        </div><br/>
         <div class="row">
          <div class="col-xs-12">
            <label for="dureeT"><strong>Nombre d'application/jour:</strong></label>
            <input type="number" id="nbrFJ" class="form-control"  min="1" value="1" placeholder = "Nombre de prise"/>
          </div> <!-- <div class="col-xs-6">  <label for="dureeT"><strong>Durée(jour):</strong></label>
          <input type="number" id="dureeT" class="form-control"  min="1" value="1" placeholder = "Duree"/></div> -->
        </div><hr>
        <div class="row" align="right">
          <button type="submit" id="EnregistrerActe" class="btn btn-primary btn-sm" value ="add">
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
<!--<div class="row"><div class="col-sm-3"><label for="" class="control-label no-padding-right"><b>Periodes:</b></label></div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Matin" value="Matin" checked><b>Matin</b></label></div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Midi" value="Midi"><b>Midi</b></label>
</div><div class="col-sm-3"><label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Soir" value="Soir"><b>Soir</b></label></div></div>--><!--  <div class="row"><div class="col-sm-3"><label class="control-label no-padding-right"><b>Pendant :</b></label></div><div class="col-sm-7"><input type="number" id="duree" name="duree" class="form-control col-sm-6" min="1" value="1" /> </div>   -->