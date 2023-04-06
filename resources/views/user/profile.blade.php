@extends('app')
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
                <span class="title"><span class="glyphicon glyphicon-home"></span> Affectation</span>
              </li>
              <li data-step="4">
                <span class="step">4</span>
                <span class="title"><i class="ace-icon fa fa-check bigger-120"></i>Validation</span>
              </li>
            </ul>
          </div>
          <hr>
          <div class="step-content pos-rel">
          <div class="step-pane active" data-step="1">
          <h3 class="lighter block green">informations</h3>
            <form class="form-horizontal" id="sample-form">
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
                    <input type="text" id="prenom" class="width-100" value="{{ $employe->service->nom }}" disabled>
                  </div>
                </div>
              </form>
            </div><!-- step-pane -->
            <div class="step-pane" data-step="2">
            <h3 class="lighter block green">informations</h3>
            </div><!-- step-pane -->
            <div class="step-pane" data-step="3">
            <h3 class="lighter block green">informations</h3>
            </div><!-- step-pane -->
            <div class="step-pane" data-step="4">
            <h3 class="lighter block green">informations</h3>
            </div><!-- step-pane -->
          </div><!-- step-content -->
        </div><!-- fuelux-wizard -->
        <div class="wizard-actions">
<button class="btn btn-prev" disabled="disabled">
  <i class="ace-icon fa fa-arrow-left"></i>
  Prev
</button>

<button class="btn btn-success btn-next" data-last="Finish">
  Next
  <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
</button>
</div>
      </div>
    </div>
  </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
  jQuery(function() {
    <script type="text/javascript">
      jQuery(function($) {
        var $validation = false;
        $('#fuelux-wizard-container')
        .ace_wizard({
          //step: 2 //optional argument. wizard will jump to step "2" at first
          //buttons: '.wizard-actions:eq(0)'
        })
        .on('actionclicked.fu.wizard' , function(e, info){
          if(info.step == 1 && $validation) {
            if(!$('#validation-form').valid()) e.preventDefault();
          }
        })
        //.on('changed.fu.wizard', function() {
        //})
        .on('finished.fu.wizard', function(e) {
          bootbox.dialog({
            message: "Thank you! Your information was successfully saved!", 
            buttons: {
              "success" : {
                "label" : "OK",
                "className" : "btn-sm btn-primary"
              }
            }
          });
        }).on('stepclick.fu.wizard', function(e){
          //e.preventDefault();//this will prevent clicking and selecting steps
        });
        //jump to a step
        /**
        var wizard = $('#fuelux-wizard-container').data('fu.wizard')
        wizard.currentStep = 3;
        wizard.setState();
        */
      
        //determine selected step
        //wizard.selectedItem().step
      
      
      
        //hide or show the other form which requires validation
        //this is for demo only, you usullay want just one form in your application
        $('#skip-validation').removeAttr('checked').on('click', function(){
          $validation = this.checked;
          if(this.checked) {
            $('#sample-form').hide();
            $('#validation-form').removeClass('hide');
          }
          else {
            $('#validation-form').addClass('hide');
            $('#sample-form').show();
          }
        })
      
  });
</script>
@stop
