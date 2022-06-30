<div class="row">
  <div class="col-sm-8">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Patient : {{ $patient->full_name }}</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            <canvas id="poids" width="400" height="100"></canvas>
            <canvas id="taille" width="400" height="100"></canvas>
            <canvas id="pas" width="400" height="100"></canvas>
            <canvas id="pad" width="400" height="100"></canvas>
            <canvas id="pouls" width="400" height="100"></canvas>
            <canvas id="temp" width="400" height="100"></canvas>
             <canvas id="glycemie" width="400" height="100"></canvas>
            <canvas id="cholest" width="400" height="100"></canvas> 
          </div>
        </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Nouvelle prise</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="text-center">     
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
            </div>
            <form method="POST" action="/storeconstantes">
              {{ csrf_field() }}
              <input type="text" name="patient_id" id="patient_id" value="{{ $patient->id }}" hidden>
              <input type="text" name="hosp_id" id="hosp_id" value="{{ $hosp->id }}" hidden>
              <div>
                <label for="poids">Poid (KG)</label>
                <input type="number" step="0.01" name="poids" class="form-control" min="2" max="200" placeholder="Entre 2 et 200 (KG)">     
              </div>
              <hr/>
              <div>
                <label for="taille">Taille (CM)</label>
                <input type="number" step="0.01" name="taille" class="form-control" min="40" max="300" placeholder="Entre 40 et 300 (CM)">        
              </div>
              <hr/>
              <div>
                <label for="pas">PAS (mmHg)</label>
                <input type="number" step="0.01" name="pas" class="form-control" min="50" max="250" placeholder="Normal < 130 (mmHg)">        
              </div>
             <hr/>
              <div>
                <label for="pad">PAD (mmHg)</label>
                <input type="number" step="0.01" name="pad" class="form-control" min="10" max="150" placeholder="Normal < 85 (mmHg)">       
              </div>
              <hr/> 
              <div>
                <label for="pouls">Pouls (bpm)</label>
                <input type="number" step="0.01" name="pouls" class="form-control" min="0" max="200" placeholder="Optimal entre 50 et 80 (bpm)">        
              </div>
              <hr/>
              <div>
                <label for="temp">Temp (°C)</label>
                <input type="number" step="0.01" name="temp" class="form-control" min="0" max="50" placeholder="Idéal 37 (°C)">       
              </div>
              <hr/>
              <div>
                <label for="glycemie">Glycémie (g/l)</label>
                <input type="number" step="0.01" name="glycemie" class="form-control" min="0" max="7" placeholder="Normale 0.7 et 1.1 (g/l)">       
              </div>
              <hr/>
              <div>
                <label for="cholest">Cholést (g/l)</label>
                <input type="number" step="0.01" name="cholest" class="form-control" min="0" max="7" placeholder="En moyenne entre 1,4 et 2,5 (g/l)">       
              </div>
              </hr>
              <div class="form-actions center">
                <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
                </button>
              </div>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>