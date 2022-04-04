<div id="ExamGeneral" class="tabpanel">
  <div class="row">
    <ul class = "nav nav-pills nav-justified navbar-custom1 list-group" role="tablist" id ="cliniq">
      <li role= "presentation" class="active">
        <a href="#ExamGen"  name="ExamGen" aria-controls="ExamGen" role="tab" data-toggle="tab" class="jumbotron">
        <i class="fa fa-stethoscope fa-2x pull-left"></i><span class="bigger-130">Examen général</span>
         </a>
       </li>
      <li role= "presentation" name="appareils">
        <a href="#Appareils" aria-controls="Appareils" role="tab" data-toggle="tab" class="jumbotron">
        <span class="medical medical-icon-i-internal-medicine" aria-hidden="true"></span><span class="bigger-130">Examen d'appareils</span>
         </a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class= "col-md-9 col-sm-9"> 
       <div  class="tab-content" style ="border-style: none;">
    <div  role="tabpanel" class ="tab-pane active" id="ExamGen">
        @if(null != $specialite->consConst)
        @foreach(json_decode($specialite->consConst ,true) as $const)
        <?php $nom = App\modeles\Constante::FindOrFail($const)->nom ?><?php $desc = App\modeles\Constante::FindOrFail($const)->description ?>
         <?php $min = App\modeles\Constante::FindOrFail($const)->min ?>
             {{ $nom }}
        <div class="form-group m-b-30">
              <label ><strong>{{ $desc }}</strong> :</label>
              <input type="text" name="{{ trim($nom) }}" class="irs-hidden-input col-sm-12 {{ $nom }}" tabindex="-1" value="{{ $min }}">
        </div> 
        @endforeach
        @endif
        <div class="form-group">
          <label class="control-label" for="etatgen"><strong>Etat géneral du patient :</strong></label>
          <textarea type="text" name="etat" placeholder= "Etat Géneral du patient..." class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label class="control-label" for="peaupha"><strong>Peau et phanéres :</strong></label>
          <textarea type="text" id="peaupha" name="peaupha" placeholder= "Peau et phanéres ..."   class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label class="control-label" for="autre"><strong>Autre :</strong></label>
          <textarea id="autre" name="autre" placeholder="..." class="form-control" min ="30" step="any"></textarea>
        </div>      
        </div><!-- ExamGen -->
        <div role="tabpanel" class = "tab-pane" id="Appareils"> @include("consultations.ExamenAppareils") </div>
      </div>
    </div>
    <div class= "col-md-3 col-sm-9"><div>@include('consultations.actions')</div></div>
  </div>
</div>