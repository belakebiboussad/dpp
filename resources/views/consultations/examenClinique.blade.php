<div id="ExamGeneral" class="tabpanel">
  <div class="row">
    <ul class = "nav nav-pills nav-justified navbar-custom1 list-group" role="tablist" id ="cliniq">
      @if("" != $specialite->consConst)
      <li role= "presentation" class="active">
        <a href="#ExamGen"  name="ExamGen" aria-controls="ExamGen" role="tab" data-toggle="tab" class="jumbotron">
        <i class="fa fa-stethoscope fa-2x pull-left"></i><span class="bigger-130">Examen général</span>
         </a>
      </li>
      @endif
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
      @if("" != $specialite->consConst)
      <div  role="tabpanel" class ="tab-pane active" id="ExamGen">@include("consultations.examenConst")</div>
      @endif
      <div role="tabpanel" class = "tab-pane" id="Appareils"> @include("consultations.ExamenAppareils") </div>
      </div>
    </div>
    <div class= "col-md-3 col-sm-9"><div>@include('consultations.actions')</div></div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
  function formatConsuConsts()
  {
    try
    {
      var conts = {!! $specialite->consConst !!};
      $.each(conts,function(key,id){
        $.get('/const/'+id+'/edit', function (data) {
           $("."+data.nom).ionRangeSlider({ min:data.min,max:data.max,step:data.step,from:data.normale,grid: true,grid_num: data.grid_num, postfix:" "+data.unite,skin:"big" });
        });
      });
    } catch(err) {
      console.log("error");
    }
 }
 $('document').ready(function(){
    formatConsuConsts()
 });
</script>