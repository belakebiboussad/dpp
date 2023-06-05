@extends('app')
@section('main-content')
<div class="container-fluid">
<div class="page-header">Paramètres</div>
  <div class="row">
  <div class="col-sm-12">
    <div class="widget"><div class="widget-title"></div>
      <div class="widget-body">
        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#generale" role="tab" data-toggle="tab"><span>Générale</span></a></li>
              <li><a href="#cons" role="tab" data-toggle="tab"><span>Consultation</span></a></li>
              <li><a href="#hosp" role="tab" data-toggle="tab"><span>Hosppitalisation</span></a></li>
              @if(Auth::user()->isIn([13,14]))
              <li><a href="#rdvs" role="tab" data-toggle="tab"><span>Rendaz-Vous</span></a></li>
              @endif
            </ul>
            <form role="form" method="POST" action="{{ route('params.store')}}">
              {{ csrf_field() }}
              <div class="tab-content">
                <div class="tab-pane active" id="generale">@include('parametres.medicale.generale')</div>
                <div class="tab-pane" id="cons">@include('consultations.config')</div>
                <div class="tab-pane" id="hosp">
                <h3 class="section-heading">@include('hospitalisations.config')</h3>
                </div>
                <div class="tab-pane" id="rdvs"> 
               @foreach(Auth::user()->role->Parameters  as $param)
                  @if($param->parametre->type =="checkbox")
                  <label><input name="{{ $param->parametre->nom }}" type ="{{ $param->parametre->type }}" class="ace"   value="1" {{ (null !== (Auth::user()->employ->Specialite->Parameters->find($param->param_id)) && (!is_null(Auth::user()->employ->Specialite->Parameters->find($param->param_id)['pivot']['value']))) ? 'checked' : '' }}/>
                    <span class="lbl text-nowrap"> {{ $param->parametre->label}}</span>
                    </label>
                  @endif
                @endforeach
                </div>
             </div><div class="space-12"></div>
             <div class="row">
                <div class="col-sm12">
                  <div class="bottom center">
                    <button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
                    <a href="/home" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-close bigger-110"></i>Annuler</a>
                  </div>
                </div>
              </div>
            </form>                                            
          </div>
        </div>
      </div>
  </div>
@stop