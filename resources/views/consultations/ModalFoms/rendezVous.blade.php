<div class="modal fade" id="RDV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modaldialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title" id="myModalLabel"><strong>Ajouter une Rendez-Vous</strong></h5>
      </div>
      <div class="modal-body bodyodal">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              &nbsp;&nbsp;&nbsp;&nbsp; 
              <div class="panel-heading" style="margin-top:-20px">
                <div class="left"><!-- <strong>Liste Des Rendez-Vous</strong> --></div>
              </div>
              <div class="panel-body">
                <div  class="calendar1"></div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer "> 
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" type="reset"> <i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
     <div class="modal-header"  style="padding:35px 50px;">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
           <h5 class="modal-title" id="myModalLabel">
                <span class="glyphicon glyphicon-bell"></span>
                 Modifier Rendez-Vous du <q><a href="" id="lien"><span id="patient" class="blue"> </span></a></q>
           </h5>
           <hr>
           <div class="row">
                <div class="col-sm-6">    
                     <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="blue"></span>
                </div>
                <div class="col-sm-6">
                     <strong>Age:&nbsp;</strong>
                     <span id="agePatient" class="blue"></span> <small>Ans</small>
                </div>
              </div>
     </div>
      <div class="modal-body">
           <form id ="updateRdv" role="form" action="" method="POST">      {{-- {{route('rdv.update',5)}} /rdv/5--}}
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="well">
                     <div class="row">
                           <label for="date"><span class="glyphicon glyphicon-time fa-lg"></span><strong> Date Rendez-Vous :</strong></label>
                           <div class="input-group">
                                <input class="form-control" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd HH:mm:ss" readonly/>
                           </div>
                     </div>
                     <div class="row" class= "invisible">
                           <div class="input-group">
                                <input class="form-control" id="datefinrdv" name ="datefinrdv" type="text" data-date-format="yyyy-mm-dd HH:mm:ss" style="display:none"/>
                           </div>
                      </div>             
                </div>  {{-- well --}}
           </form>   
      </div>
      <br>
      <div class="modal-footer">
      @if(Auth::user()->role->id == 1)
      <a type="button" id="btnConsulter" class="btn btn btn-sm btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
     <button type="button" class="btn btn-sm btn-primary" onclick="update();">
                @if(Auth::user()->role->id  != 2) 
                        <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer</button>
                 @endif       
      <a  href=""  id="btnDelete" class="btn btn-bold btn-sm btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">
                <i class="fa fa-trash" aria-hidden="true"></i> Annuler
     </a>
     <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
           <i class="fa fa-undo" aria-hidden="true" ></i> Fermer</button>
     @endif
      </div>
    </div>
  </div>
</div>{{-- modal --}}
  


