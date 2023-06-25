<form method="POST" action="{{ route('uploadBioRes') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="{{ $demande->id }}">
  <input type="hidden" name="crb" id ="crb">
<div class="user-profile row">
  <div class="col-xs-12 col-sm-12 center">
    <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th class="center" width="5%">#</th><th class="center" width="30%">Nom</th>
        <th class="center" width="15%">Classe</th>
        <th class="center" width="40%">Attacher le Résultat</th>
        <th class="center" width="10%">Compte rendu</th>
      </tr>
    </thead>
    <tbody>
      @foreach($demande->examensbios as $index => $exm)
      <tr>
        <td class="center">{{ $index + 1 }}</td><td>{{ $exm->nom }}</td>
        <td>{{ $exm->Specialite->nom }}</td>
        @if($loop->first)
        <td rowspan ="{{ $demande->examensbios->count()}}" class="align-middle">
          <input type="file" class="form-control-file" id="resultat" name="resultat" alt="Résultat du l'éxamen" accept="image/*,.pdf"/> {!! $errors->first('resultat', '<p class="alert-danger">:message</p>') !!}
        </td>
        @endif
        @if($loop->first)
        <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
        @if(Auth::user()->is(11))
        <button type="button" class="btn btn-md btn-success open-AddCRBilog" data-toggle="modal" title="ajouter un compte rendu" data-id="{{ $demande->id }}" id ="crb-add"  disabled><i class="glyphicon glyphicon-plus glyphicon 
          glyphicon-white"></i>
        </button>
        @else
        <input type="file" class="form-control-file" name="crbFile" alt="Résultat du l'éxamen" accept="image/*,.pdf"/> 
        @endif
        </td>
        @endif 
      </tr>
      @endforeach                         
    </tbody>
    </table>
  </div>
</div><br>
<div class="row">
  <div class="col-xs-12 col-sm-12 center">
      <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
   </div>
</div>
</form>
