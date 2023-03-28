<div id="ExamGeneral" class="tabpanel">
  <div class="row">
    <ul class = "nav nav-pills nav-justified navbar-custom1 list-group" role="tablist" id ="cliniq">
      <li role= "presentation" class="active">
        <a href="#ExamGen"  name="ExamGen" aria-controls="ExamGen" role="tab" data-toggle="tab" class="jumbotron">
        <i class="fa fa-stethoscope fa-2x pull-left"></i><span class="bigger-130">Examen général</span>
         </a>
      </li>
      @if (!empty(json_decode($specialite->appareils, true))) 
      <li role= "presentation" name="appareils">
        <a href="#Appareils" aria-controls="Appareils" role="tab" data-toggle="tab" class="jumbotron">
        <span class="medical medical-icon-i-internal-medicine" aria-hidden="true"></span><span class="bigger-130">Examen d'appareils</span>
         </a>
      </li>
       @endif
    </ul>
  </div>
  <div class="row">
    <div class= "col-md-9 col-sm-9"> 
      <div  class="tab-content" style ="border-style: none;">
      <div  role="tabpanel" class ="tab-pane active" id="ExamGen">@include("consultations.examenConst")</div>
      @if (!empty(json_decode($specialite->appareils, true))) 
      <div role="tabpanel" class = "tab-pane" id="Appareils"> @include("consultations.ExamenAppareils") </div>
      @endif
      </div>
    </div>
    <div class= "col-md-3 col-sm-3">@include('consultations.actions')</div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
  $('document').ready(function(){
   $.each( {!! $speconst!!}, function( key, cons ) {
      $("."+cons.nom).ionRangeSlider({ min:cons.min,max:cons.max,step:cons.step,from:cons.normale,grid: true,grid_num: cons.grid_num, postfix:" "+cons.unite,skin:"big" });    
    })
 });
</script>