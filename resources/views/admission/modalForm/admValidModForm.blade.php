<div id="admValiForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalAdmiss" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div  class="modal-content custom-height-modal">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 id="myModalAdmiss">Confirmer l'entrée du patient</h4>
    </div>
    <div class="modal-body">
      <p><h3 id="patName"></h3></p>
        <h3>le &quot;<span class="orange">date</span>&quot;&nbsp;à&nbsp;<span class="red">time</span></h3>
      </p>
    </div>
    </div>
    <div class="modal-footer">
     <form id="" class="form-horizontal" role="form" method="POST" action="">
        <input id="id_RDV" type="hidden" name="id_RDV" value="">
        <input id="demande_id" type="hidden" name="demande_id" value="">
        <button type="submit" class="btn btn-success"><i class="ace-icon fa fa-check"></i>Valider</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="ace-icon fa fa-undo"></i>Annuler</button></button>
      </form>
    </div>
    </div>
  </div>
</div>