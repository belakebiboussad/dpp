<div class="row">
  <div class="col-sm-{{($hosp->etat_id != 1)? '8':'12' }}">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Patient : {{ $patient->full_name }}</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            @foreach(json_decode($specialite->hospConst ,true) as $const)
              <canvas id="{{ App\modeles\Constante::FindOrFail($const)->nom }}" width="400" height="100"></canvas>
            @endforeach
          </div>
        </div>
      </div>
  </div>
  @if($hosp->etat_id != 1)
  <div class="col-sm-4">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Nouvelle prise</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            @if($message = Session::get('succes'))
              <div class="alert alert-success" role="alert">{{ $message }}</div>
            @endif 
            @if($message = Session::get('error'))
              <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @endif
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
                <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>
@endif
@include('constantes.scripts.functions')
<script type="text/javascript" charset="utf-8" async defer>
  $( function() { 
  if('{{ Auth::user()->employ->specialite }}' ) {
    if('{{$specialite->hospConst}}' != "");
    {
       var days = []; var constValues= [];
          days = getConstDatas('{{ $hosp->id }}','date')
          $.each({!! $specialite->hospConst !!},function(key,id){
            $.get('/const/'+id+'/edit', function (data) {
              constValues = getConstDatas('{{ $hosp->id }}',data.nom)
              if(constValues.length > 0 )
              {
                var ctx = document.getElementById(data.nom).getContext('2d');
                new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: days,
                      datasets: [{
                          label: data.nom+"(" + data.unite + ")",
                          data: constValues,
                          backgroundColor: [/*'rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)',*/
                            'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [/*'rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)',*/
                            'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 2
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          },
                      }//scales
                  }
                });
              }
            })
          });
      }
  }
});
</script>