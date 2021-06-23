<div id="DocModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Attacher un document médical</h4>
      </div>
      <div class="modal-body">
        <form id="addDoc" method="POST" action ="/saveDoc" name="form2" id="form2">
          {{ csrf_field() }}
          <input type="hidden" value=""  id ="doc_id" name="doc_id"> <div class="space-12"></div>
          <div class="row">
            <div class="col-sm-3">
              <label for="resultat" id="labelresultat"class="control-label no-padding-right"><b>Attacher le résultat</b></label>
            </div>
            <div class="col-sm-7">
             <input type="file" id="resultat" name="resultat" class="form-control" accept="image/*,.pdf" required/> 
            </div>  
          </div><div class="space-12"></div><div class="space-12"></div>
          <div class="row">
            <div class="col-sm-3"><label for="" class="control-label no-padding-right"><b>Titre du document :</b></label></div>
            <div class="col-sm-7"><input  id="nomDoc" name="nomDoc" class="form-control" required/></div>
          </div> <div class="space-12"></div><div class="space-12"></div>
          <div class="row">
            <div class="col-sm-3"><label for="" class="control-label no-padding-right"><b>Description :</b></label></div>
            <div class="col-sm-7"><textarea  id="descriptions" name="descriptions" class="form-control" required></textarea> </div>
          </div><div class="space-12"></div> <div class="space-12"></div>
          <div class="row">
            <div class="col-sm-3"><label for="" class="control-label no-padding-right"><b>Type :</b></label></div>
            <div class="col-sm-7">
              <select type="text" id="types" name="types" data-placeholder="selectionnez le type" class="selectpicker show-menu-arrow place_holde form-control col-sm-6" required />
               <option value="analyses biologique">Analyses biologique</option>
               <option value="boilogie">Imagerie</option>
               <option value="analyse anapath">Analyse d'anapath</option>
              </select>
            </div>  
          </div><div class="space-12"></div> <div class="space-12"></div> <div class="space-12"></div>
          <hr>
        <div class="clearfix form-actions">
         <div class="col-md-offset-5 col-md-7">
            <button class="btn btn-info btn-xs" type="submit" id="EnregistrerDoc" value="add"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>  Démarrer</button>
            <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-90"></i>Annuller</button>
         </div>
       </div>
      </form>
    </div>
  </div>
  </div>
</div>
