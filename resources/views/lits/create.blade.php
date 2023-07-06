<script type="text/javascript">
$(function(){

  });
</script>
<div class="page-header"><h1>Ajouter un nouveau lit</h1></div>
<div class="row">
    <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header">
        <h5 class="widget-title"><img src="/img/bed.png" alt="lit"> Lit</h5>
      </div>  
      <div class="widget-body">
        <div class="widget-main">
        <form role="form" method="POST" action="{{ route('lit.store') }}">
          {{ csrf_field() }}
          <div class="form-group row">
            <label class="col-sm-3 control-label text-right">Numéro :</label>
            <div class="col-sm-9">
                  <input type="number"  name="num" placeholder="numéro du lit" class="form-control"  min="1" required />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-control-label text-right" for="nom">Nom :</label>
            <div class="col-sm-9">
              <input type="text"  name="nom" placeholder="Nom complet du lit" class="form-control"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 control-label text-right" for="service">Service :</label>
            <div class="col-sm-9">
               <select class="form-control" id="service" name="service" required>
                  <option value="">Selectionnez....</option>
                  @foreach($services as $service)
                  <option value="{{ $service->id }}" {{ (isset($salle->id) && ($salle->service->id == $service->id ) ) ? 'selected ' : ''}}>{{ $service->nom }}
                  </option>
                    @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-control-label text-right" for="salle_id">Chambre :</label>
            <div class="col-sm-9">
                <select class="form-control" id="salle_id" name="salle_id" required>
                  <option value="" selected disabled>Selectionnez....</option>
                  @if(isset($salle->id))
                  @foreach($salle->service->salles as $chambre)
                  <option value="{{ $chambre->id }}"  {{ ($chambre->id == $salle->id  ) ? 'selected ' : ''}}>{{ $chambre->nom }}</option>
                  @endforeach
                  @endif      
                </select>
            </div>
          </div>
          <div class="form-group row">
            <div class=" col-sm-9 col-sm-offset-3">
              <label>Bloqué
              <input name="bloq" class="ace ace-switch ace-switch-6" type="checkbox" value="1"><span class="lbl"></span>
              </label>
            </div>
          </div>
          <div class="center">
              <button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
              <button class="btn btn-xs btn-danger" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
            </div>
        
        </form>
                </div>
      </div>{{-- widget-body --}}
      </div> {{-- widget-box --}}
      </div> {{-- col-xs-12 --}}
      </div>
    