<div id="EtatModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Attacher un etat médical</h4>
        @include('patient._patientInfo')
      </div>
      <div class="modal-body">
      <!-- /Doc/save -->
     
    

   
    <form id="addEtat" method="POST" action ="/saveEtat" name="form2" id="form2">
            {{ csrf_field() }}
    <input type="hidden" value=""  id ="etat_id" name="etat_id">

   
   <!--     <div class="form-group">
         <div class="col-xs-5">
        <label for="resultat">Attacher le Résultat </label>
        </div>
        <div class="col-xs-8">
        <input type="file" id="resultat" name="resultat" class="form-control" accept="image/*,.pdf" required/>
       </div>
       </div>
      
      
       <div class="form-group">
         <div class="col-xs-5">
        <label for="resultat">Nom du Document:</label>
        </div>
        <div class="col-xs-8">
        <input type="file" id="resultat" name="resultat" class="form-control" accept="image/*,.pdf" required/>
       </div>
       </div>

-->           <div class="space-12"></div>
          <div class="row">
            <div class="col-sm-3">
              <label for="resultat" id="labelresultat"class="control-label no-padding-right"><b>Attacher le Résultat</b></label>
            </div>
            <div class="col-sm-7">
             <input type="file" id="fileEtat" name="fileEtat" class="form-control" accept="image/*,.pdf" required/> 
            </div>  
          </div>
  <div class="space-12"></div>

   <div class="row">
            <div class="col-sm-3">
              <label for="" class="control-label no-padding-right"><b>Titre du Document :</b></label>
            </div>
            <div class="col-sm-7">
              <input  id="titeEtat" name="titeEtat" class="form-control" required/>             </div>  
          </div>

        <div class="space-12"></div>
          <
  <div class="space-12"></div>



       <div class="space-12"></div>
          <div class="row">
            <div class="col-sm-3">
              <label for="" class="control-label no-padding-right"><b>Description :</b></label>
            </div>
            <div class="col-sm-7">
              <textarea  id="descriptionEtat" name="descriptionEtat" class="form-control" required></textarea>  
            </div>  
          </div>
  <div class="space-12"></div>


        <div class="space-12"></div>
          <div class="row">
            <div class="col-sm-3">
              <label for="" class="control-label no-padding-right"><b>Type :</b></label>
            </div>
            <div class="col-sm-7">
              <select type="text" id="typeEtat" name="typeEtat" ata-placeholder="selectionnez le type de l'acte" class="selectpicker show-menu-arrow place_holde form-control col-sm-6" required />
               <option value="hospitalisation">hospitalisation</option>
               <option value="consultation">consultation</option>
              
              </select>
            </div>  
          </div>
  <div class="space-12"></div>
        

       <div class="space-12"></div>
       <div class="space-12"></div>
          <hr>
      <div class="clearfix form-actions">
       <div class="col-md-offset-5 col-md-7">
       <button class="btn btn-info" type="submit" id="EnregistrerEtat" value ="add"> <!--  <i class="ace-icon fa fa-upload bigger-110"></i> -->
          <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
          Démarrer l'envoie
        </button>

     <!--    <button class="btn btn-default" > 
          <i class="ace-icon fa fa-undo bigger-150"></
          i>
          Annuller l'envoie
        </button> -->

           <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
            <i class="ace-icon fa fa-close bigger-190"></i> Annuller l'envoie
           </button>

       </div>
       </div>
    

       </form>

        
       
      </div>
    </div>
  </div>
</div>
