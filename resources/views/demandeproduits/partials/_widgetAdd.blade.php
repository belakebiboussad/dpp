<div class="widget-box">
      <div class="widget-header"><h4 class="widget-title">Sélectionner un produit</h4></div>
      <div class="widget-body">
        <div class="widget-main">
          <div class="row">
          <div class="col-xs-12">
            <form id="dmdprod" method="POST" action="{{ route('demandeproduit.store') }}">
              {{ csrf_field() }}
              <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
            </form>
          <div>
          <label for="gamme" class="control-label">Gamme :</label>
          <select class="form-control" id="gamme">
            <option value="" disabled>Sélectionner...</option>
            @foreach($gammes as $gamme)
              <option value="{{ $gamme->id }}" {{($gamme->id == 1) ? 'slected' :'' }}>{{ $gamme->nom }}</option>
            @endforeach 
          </select>
        </div>
        <div id = "specialiteDiv">
          <label for="specPrd" class="control-label">Spécialité :</label>
          <select class="form-control" id="specPrd">
            <option value="" slected disabled>Sélectionner...</option>
            @foreach($specialites as $spec)
              <option value="{{ $spec->id }}">{{ $spec->nom }}</option>
            @endforeach 
          </select> 
        </div>
        <div>
          <label for="produit" class="control-label">Produit :</label>
          <select class="form-control" id="produit">
            <option value="" selected disabled>Sélectionner...</option>
          </select>
        </div>
        <div>
          <label for="quantite" class="control-label">Quantité :</label>
          <input type="number" class="form-control" id="quantite" min="1">
        </div>
        <div>
          <label for="unite" class="control-label">Unité :</label>
          <input type="text" class="form-control" id="unite" palceholder="Unité">
        </div><div class="hr hr-dotted"></div>
        <div class="pull right">
          <button id="ajoutercmd" class="btn btn-sm btn-primary" disabled>
            <i class="ace-icon fa fa-plus-circle fa-lg bigger-120"></i> Ajouter</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>