<div class="row">
  <div class="col-sm-8">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Patient : {{ $patient->full_name }}</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            @if("" != $specialite->hospConst)
              @foreach(json_decode($specialite->hospConst ,true) as $const)
                <canvas id="{{ App\modeles\Constante::FindOrFail($const)->nom }}" width="400" height="100"></canvas>
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
              <?php $const = App\modeles\Constante::FindOrFail($const) ?>
              <div>
                <label for="{{ $const->nom}}">{{ $const->description }}</label>
                <input type="number" step="{{ $const->step}}" name="{{ $const->nom}}" class="form-control" min="{{ $const->nmin }}" max="{{ $const->max }}" placeholder="Entre {{ $const->min }} et {{ $const->max }} ({{ $const->unite }})">     
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