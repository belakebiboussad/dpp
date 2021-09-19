@extends('app')

@section('page-script')
@endsection
@section('main-content')
<div class="container-fluid">
	<!-- <div class="row"><div class="col-sm-12"></div></div> -->
	<div class="row">
  <div class="col-sm-12">
    <ul class="nav nav-pills pull-right">
    	<li class="btn btn-success btn-xs"><a id="" class="btns" title="" href="#"> <i class="fa fa-cloud-download" aria-hidden="true"></i></a></li>
      <li class="btn btn-info btn-xs"><a class="XiboFormButton btns" title="" href=""> <i class="fa fa-cloud-upload" aria-hidden="true"></i></a></li>
      <li class="btn btn-danger btn-xs"><a class="XiboFormButton btns" title="" href="/maintenance/form/tidy"> <i class="fa fa-trash" aria-hidden="true"></i></a></li>
    </ul>
    <div class="widget">
      <div class="widget-title">Paramètres</div>
      <div class="widget-body">
      	<div class="row">
          <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#generale" role="tab" data-toggle="tab"><span>Générale</span></a></li>
              <li><a href="#cons" role="tab" data-toggle="tab"><span>Consultation</span></a></li>
              <li><a href="#hosp" role="tab" data-toggle="tab"><span>Hosppitalisation</span></a></li>
            </ul>
            <form id="SettingsForm" class="XiboForm form-horizontal" method="put" action="/admin" novalidate="novalidate">
              <div class="tab-content">
                <div class="tab-pane active" id="generale">
                  <h3 class="section-heading">Générale</h3>  
                </div>
                <div class="tab-pane" id="cons">
                  <h3 class="section-heading">Consultation</h3>  
                  <div class="row">
                  	<h4>Examens biologique</h4>
                  </div>
                  <div class="row">
                  	@include('ExamenCompl.ExamenBio')
                  </div>
                </div>
                <div class="tab-pane" id="hosp">
                  <h3 class="section-heading">Hospitalisation</h3>  
                </div>
              </div>
            </form>
                                                           
      </div>
		</div>
	</div>
	</div>
@endsection
