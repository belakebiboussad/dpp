@extends('app')
@section('page-script')
<script type="text/javascript">
   $(function(){
    $('[data-rel=tooltip]').tooltip();
    $('#fuelux-wizard-container')
      .ace_wizard({
      }).on('finished.fu.wizard', function(e) {
        $( "#profilForm" ).submit();  
      }).on('stepclick.fu.wizard', function(e){
      });
      var wizard = $('#fuelux-wizard-container').data('fu.wizard')
      wizard.currentStep = 1;
      wizard.setState();  
  });
</script>
@stop
@section('main-content')
<div class="page-header">
  <h4 class="lighter"><i class="fa fa-user"></i> Mon Profil</h4>
</div>
<div class="hr hr-18 hr-double dotted"></div>
<div class="widget-box">
  <div class="widget-header widget-header-blue widget-header-flat">
    <div class="widet-body">
      <div class="widget-main">
        <div id="fuelux-wizard-container" class="no-steps-container">
          <div>
            <ul class="steps" style="margin-left: 0">
              <li data-step="1" class="active"><span class="step">1</span>
              <span class="title">
              <i class="ace-icon fa fa-info-circle"></i> Personnelles</span>
              </li>
              <li data-step="2">
                <span class="step">2</span>
                <span class="title"><i class="ace-icon fa fa-phone"></i> Contact</span>
              </li>
              <li data-step="3">
                <span class="step">3</span>
                <span class="title"><i class="ace-icon fa fa-check bigger-120"></i>Validation</span>
              </li>
            </ul>
          </div>
          <hr>
          <div class="step-content pos-rel">
          <div class="step-pane active" data-step="1">
            <form class="form-horizontal" id="profilForm" action="{{ route('home') }}">
                <div class="form-group">
                  <label for="nom" class="col-xs-12 col-sm-3 control-label no-padding-right">Nom</label>
                  <div class="col-xs-12 col-sm-5">
                    <input type="text" id="nom" class="width-100" value="{{ $employe->nom }}" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nom" class="col-xs-12 col-sm-3 control-label no-padding-right">Prenom</label>
                  <div class="col-xs-12 col-sm-5">
                    <input type="text" id="prenom" class="width-100" value="{{ $employe->prenom }}" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nom" class="col-xs-12 col-sm-3 control-label no-padding-right">Service</label>
                  <div class="col-xs-12 col-sm-5">
                  <input type="text" id="prenom" class="width-100" value="{{ $employe->service->nom}}" disabled>
                  </div>
                </div>
              </form>
            </div><!-- step-pane -->
            <div class="step-pane" data-step="2">
              <form class="form-horizontal"> 
               <div class="form-group">
                  <label for="nom" class="col-xs-12 col-sm-3 control-label no-padding-right">Adresse</label>
                  <div class="col-xs-12 col-sm-5">
                    <input type="text" id="prenom" class="width-100" value="{{ $employe->Adresse }}" disabled>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="nom" class="col-xs-12 col-sm-3 control-label no-padding-right">Tél fixe</label>
                  <div class="col-xs-12 col-sm-5">
                    <input type="text" id="prenom" class="width-100" value="{{ $employe->phone }}" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nom" class="col-xs-12 col-sm-3 control-label no-padding-right">Mobile</label>
                  <div class="col-xs-12 col-sm-5">
                    <input type="text" id="prenom" class="width-100" value="{{ $employe->mob }}" disabled>
                  </div>
                </div>
              </form>
            </div><!-- step-pane -->
            <div class="step-pane" data-step="3">
              <div class="center"><h3 class="green">Merci!</h3>
                <div>
                  <p><i class="fa fa-check"></i> Cliquer sur <b>Terminer</b> pour Continuer.</p>
                </div>
              </div>
            </div><!-- step-pane -->
          </div><!-- step-content -->
        </div><!-- fuelux-wizard -->
        <div class="wizard-actions">
          <button class="btn btn-prev" disabled="disabled">
            <i class="ace-icon fa fa-arrow-left"></i>Précédant</button>
          <button class="btn btn-success btn-next" data-last="Terminer">
            Suivant<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
@stop