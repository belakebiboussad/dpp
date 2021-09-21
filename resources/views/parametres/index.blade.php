@extends('app')
@section('page-script')
@endsection
@section('main-content')
<div class="container-fluid">
	<div class="row">
  <div class="col-sm-12">
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
            <form id="SettingsForm" class="form-horizontal" role="form" method="POST" action="{{ route('params.store')}}">
            {{ csrf_field() }}
              <div class="tab-content">
                <div class="tab-pane active" id="generale">
                	<h3 class="section-heading">Générale</h3>
                	<div class="row"><div class="col-sm-12"><h4>Examens biologique</h4></div></div>
                  <div class="row">
                    @include('examenbio.bioExamList')
                  </div>
                  <div class="row"><div class="col-sm-12"><h4>Examens Radiologique</h4></div></div>
                  <div class="row">
                  @foreach($examensImg as $exImg)
      	            <div class="col-xs-2">
        						  @if(isset($specExamsImg))
                      <input name="exmsImg[]" type="checkbox" class="ace" value="{{ $exImg->id}}" {{ (in_array($exImg->id, $specExamsImg))? 'checked' : '' }}/>
                      @else
                      <input name="exmsImg[]" type="checkbox" class="ace" value="{{ $exImg->id}}"/>
                      @endif   
                      <span class="lbl">{{ $exImg->nom }} </span>
                    </div>
                  @endforeach
                  </div>
                </div>
                <div class="tab-pane" id="cons">
                  <h3 class="section-heading">Consultation</h3>  
               
            		</div>
                <div class="tab-pane" id="hosp"><h3 class="section-heading">Hospitalisation</h3></div>
             </div>
             <div class="space-12"></div>
             <div class="row">
                <div class="col-sm12">
                  <div class="center" style="bottom:0px;">
                    <button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
                    <a href="" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-close bigger-110"></i>Annuler</a>
        					</div>
      					</div>
    					</div>
            </form>                                            
      		</div>
				</div>
			</div>
	</div>
@endsection
