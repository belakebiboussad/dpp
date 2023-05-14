@extends('app')
@section('main-content')
<div class="container-fluid">
<div class="page-header"><h1>Paramètres</h1></div>
  <div class="row">
  <div class="col-sm-12">
    <div class="widget"><div class="widget-title"></div>
      <div class="widget-body">
        <form role="form" method="POST" action="{{ route('params.store') }}">
          {{ csrf_field() }}
          <div class="row">
          @foreach(Auth::user()->role->Parameters  as $param)
          <div class="form-group col-sm-3">
            <label for="{{ $param->nom }}">{{ $param->Parametre->label }}</label>
            <input type="{{ $param->Parametre->type }}" class="form-control" name="{{ $param->Parametre->nom }}" value="{{ $param->value }}" {{ !(is_null($param->parametre->value)) ? "checked" :"" }} >
          </div>
          @endforeach
          </div>
          <div class="text-center">
           <button class="btn btn-primary btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; 
            <a href="/home" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-under bigger-110"></i>Annuler</a>
          </div> 
        </form>
      </div>
    </div>
  </div>
  </div>
</div>
@stop