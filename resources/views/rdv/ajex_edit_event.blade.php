<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  {{-- Modal --}}
 <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        <h5 class="modal-title" id="myModalLabel">
          <span class="glyphicon glyphicon-bell"></span>Modifier le rendez-vous du
            <q><a href="" id="lien" style="color:#FFFFFF"></a></q>
        </h5>
      </div>
  <form id ="updateRdv" role="form" action="" method="POST"> 
    <div class="modal-body">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <input type="hidden" id="idRDV">
      <input  id="datefinrdv" name ="datefinrdv" type="hidden" />
      <div class="row">
        <div class="col-sm-6"><i class="fa fa-phone" aria-hidden="true"></i>
          <strong>&nbsp;Téléphone :</strong><span id="patient_tel" ></span>
        </div>
        <div class="col-sm-6"><strong>&nbsp;Âge :</strong>
         <span id="agePatient"></span><small>Ans</small>
        </div>
      </div><div class="space-12"></div>
      @if(Auth::user()->role->id == 2)
      <div class="row">
        <div class="form-group">                  
          <label for="specialite"><strong>Spécialité:</strong></label>
          <div class="input-group col-sm-12">
            <select  class="form-control" id="specialite"></select>
          </div> 
        </div>
      </div><div class="space-12"></div>
      @endif
      <div class="row">
        <div class="col-sm-6">
          <fieldset class="scheduler-border">
           <legend >Date rendez-Vous</legend>
           <div class="control-group">
              <div class="controls"><!-- bootstrap-timepicker --> <!-- data-date-format="yyyy-mm-dd HH:mm"  -->
                <input type="text" class="datetime" id="daterdv" name="daterdv" readonly/>
                <span class="glyphicon glyphicon-time fa-lg"></span> 
              </div>
           </div>
          </fieldset>
        </div>
        <div class="col-sm-6">
          <fieldset class="scheduler-border">
            <legend>Type rendez-vous</legend>
            <div class="control-group">
              <div class="controls">
                <input type="checkbox" class="ace" id="fixe" name="fixe"/>
                <span class="lbl">Fixe </span>
              </div>
            </div>
          </fieldset>  
       </div> 
      </div>
      </div> {{-- modal-body --}} 
      <div class="modal-footer">
        @if(!in_array(Auth::user()->role_id,[1,13,14]))
          <a type="button" id="btnConsulter" class="btn btn btn-xs btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
        @endif 
        <button type="submit" id ="updateRDV" class="btn btn-primary btn-xs">
          <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer
        </button>
        @if(Auth::user()->role->id == 1)          
        <a  href="" id="btnDelete" class="btn btn-bold btn-xs btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">  <i class="fa fa-trash" aria-hidden="true"></i> Annuler
        </a>
        @endif
        <a  href ="#" id="printRdv" class="btn btn-success btn-xs hidden"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer </a> 
        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"  id ="btnclose" onclick="reset_in();">
          <i class="fa fa-close" aria-hidden="true" ></i> Fermer
        </button>
      </div> {{-- modal-header --}}
    </form>  
        </div>{{-- modal-content --}}
      </div>
    </div>{{-- modal --}}