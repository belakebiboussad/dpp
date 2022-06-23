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
      <div  role="tabpanel" class ="tab-pane active" id="ExamGen">@include("consultations.examenConst")</div>
      <div role="tabpanel" class = "tab-pane" id="Appareils"> @include("consultations.ExamenAppareils") </div>
      </div>
    </div>
    <div class= "col-md-3 col-sm-9"><div>@include('consultations.actions')</div></div>
  </div>
</div>