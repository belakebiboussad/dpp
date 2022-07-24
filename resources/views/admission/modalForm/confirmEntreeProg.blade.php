<div id="{{ $rdv->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalAdmiss" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div  class="modal-content custom-height-modal">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 id="myModalAdmiss">Confirmer l'entrée du patient</h4>
    </div>
    <div class="modal-body">
      <div class="form-group">
          <div>
           <h3><span style="color: blue;">{{$rdv->demandeHospitalisation->consultation->patient->full_name}}</span></h3>
         </div>  
      </div>
      <div class="form-group">
        <div>
           <h3 style="color: red;">Le &quot;<span> {{ (\Carbon\Carbon::parse($rdv->date))->format('d/m/Y') }}</span>&quot;
            &nbsp;à &nbsp;<span>{{ Date("H:i")}}</span>
           </h3>
         </div>  
      </div>
    </div>
    <div class="modal-footer">
     <form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="{{route('admission.store')}}">
      {{ csrf_field() }}
      <input id="id_RDV" type="hidden" name="id_RDV" value="{{$rdv->id}}">
      <input id="demande_id" type="hidden" name="demande_id" value="{{$rdv->id_demande}}">
      <button type="submit" class="btn btn-success"><i class="ace-icon fa fa-check"></i>Valider</button>
      <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="ace-icon fa fa-undo"></i>Annuler</button></button>
      </form>
    </div>
    </div>
  </div>
</div>