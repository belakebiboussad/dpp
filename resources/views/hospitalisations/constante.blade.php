<div class="row">
  <div class="col-sm-8">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Patient : {{ $patient->full_name }}</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            @if("" != $specialite->hospConst)
              @foreach(json_decode($specialite->hospConst ,true) as $const)
                <?php $nom = App\modeles\Constante::FindOrFail($const)->nom ?>
                <?php $desc = App\modeles\Constante::FindOrFail($const)->description ?>
                <?php $min = App\modeles\Constante::FindOrFail($const)->min ?>
                <canvas id="{{ $nom }}" width="400" height="100"></canvas>
              @endforeach
            @endif
          </div>
        </div>
      </div>
  </div>
  <div class="col-sm-4">
    @if("" != $specialite->hospConst)
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Nouvelle prise</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            @if($message = Session::get('succes'))
              <div class="alert alert-success" role="alert">
                {{ $message }}
              </div>
            @endif 
            @if($message = Session::get('error'))
              <div class="alert alert-danger" role="alert">
                {{ $message }}
              </div>
            @endif
            <!-- /storeconstantes -->
            <form method="POST" action="{{ route('const.store')}}">
              {{ csrf_field() }}
              <input type="text" name="hospitalisation_id" value="{{ $hosp->id }}" hidden>
              @foreach(json_decode($specialite->hospConst ,true) as $const)
              <?php $nom = App\modeles\Constante::FindOrFail($const)->nom ?><?php $desc = App\modeles\Constante::FindOrFail($const)->description ?>
              <?php $min = App\modeles\Constante::FindOrFail($const)->min ?><?php $max = App\modeles\Constante::FindOrFail($const)->max ?>
              <?php $unite = App\modeles\Constante::FindOrFail($const)->unite ?>
              <div>
                <label for="poids">{{ $desc }}</label>
                <input type="number" step="0.01" name="{{$nom}}" class="form-control" min="{{ $min }}" max={{ $max}} placeholder="Entre {{ $min }} et {{ $max}} ({{ $unite }})">     
              </div>
              @endforeach
              <div class="form-actions center">
                <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
                </button>
              </div>
            </form>
          </div>
        </div>
    </div>
    @endif
  </div>
</div>