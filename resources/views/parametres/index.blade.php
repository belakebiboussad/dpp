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
                <div class="tab-pane active" id="generale">@include('parametres.generale')</div>
                <div class="tab-pane" id="cons">
                  <h3 class="section-heading">Consultation</h3>  
                  <div class="row"><div class="col-sm-12"><h4><u>Types antecédants</u></h4></div></div>
                  <div class="row">
                  @foreach($antecTypes as $antecType)
                    <div class="col-xs-2">
                    @if(isset($specAntecTypes))
                      <input name="antecTypes[]" type="checkbox" class="ace" value="{{ $antecType->id}}" {{ (in_array($antecType->id, $specAntecTypes))? 'checked' : '' }}/>
                    @else
                      <input name="antecTypes[]" type="checkbox" class="ace" value="{{ $antecType->id}}"/>
                    @endif   
                    <span class="lbl">{{ $antecType->nom_complet }}</span>
                    </div>
                  @endforeach
                  </div><div class="space-12"></div>
                  <div class="row"><div class="col-sm-12"><h4><u>Constantes médicaux</u></h4></div></div>
                    <div class="row">
                    @foreach($consts as $const)
                      <div class="col-xs-2">
                              @if(isset($consConsts))
                                <input name="consConsts[]" type="checkbox" class="ace" value="{{ $const->id}}" {{ (in_array($const->id, $consConsts))? 'checked' : '' }}/>
                              @else
                                <input name="consConsts[]" type="checkbox" class="ace" value="{{ $const->id}}"/>
                              @endif
                              <span class="lbl">{{ $const->nom }}</span>
                      </div>
                    @endforeach
                    </div>
                    <div class="row"><div class="col-sm-12"><h4><u>Appareils</u></h4></div></div>
                    <div class="row">
                       @foreach($appareils as $appar)
                      <div class="col-xs-2">
                        @if(isset($specappreils))
                         <input name="appareils[]" type="checkbox" class="ace" value="{{ $appar->id}}" {{ (in_array($appar->id, $specappreils))? 'checked' : '' }}/>
                        @else
                        <input name="appareils[]" type="checkbox" class="ace" value="{{ $appar->id}}"/>
                        @endif
                        <span class="lbl">{{ $appar->nom }}</span>
                      </div>
                      @endforeach
                   </div>
                </div>
                <div class="tab-pane" id="hosp"><h3 class="section-heading">Hospitalisation</h3>
                    @include('hospitalisations.config')
                </div>
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