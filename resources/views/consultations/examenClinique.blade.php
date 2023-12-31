<div id="ExamGeneral" class="tabpanel">
  <div class="row">
    <ul class = "nav nav-pills nav-justified navbar-custom1 list-group" role="tablist" id ="cliniq">
      @if ($specialite->Consts->count()>0) 
      <li role= "presentation" class="active">
        <a href="#ExamGen"  name="ExamGen" aria-controls="ExamGen" role="tab" data-toggle="tab" class="jumbotron">
        <i class="fa fa-stethoscope fa-2x pull-left"></i><span class="bigger-130">Examen général</span>
         </a>
      </li>
      @endif
      @if ($specialite->appareils->count()>0) 
      <li role= "presentation" name="appareils">
        <a href="#Appareils" aria-controls="Appareils" role="tab" data-toggle="tab" class="jumbotron">
        <span class="medical medical-icon-i-internal-medicine" aria-hidden="true"></span><span class="bigger-130">Examen d'appareils</span></a>  
      </li>
       @endif
    </ul>
  </div>
  <div class="row">
    <div class= "col-md-9 col-sm-9"> 
      <div  class="tab-content" style ="border-style: none;">
      <div  role="tabpanel" class ="tab-pane active" id="ExamGen">@include("consultations.examenConst")</div>
      <div role="tabpanel" class = "tab-pane" id="Appareils"> @include("consultations.ExamenAppareils")</div>
      </div>
    </div>
    <div class= "col-md-3 col-sm-3">@include('consultations.actions')</div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
  $(function(){
   $.each( {!! $specialite->Consts !!}, function( key, cons ) {
      $("."+ cons.nom).ionRangeSlider({ min:cons.min,max:cons.max,step:cons.step,from:cons.normale,grid: true,grid_num: cons.grid_num, postfix:" "+cons.unite,skin:"big" });    
    })
 });
</script>