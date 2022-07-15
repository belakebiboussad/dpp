@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="row">
  <div class="col-sm-12">
    <div class="widget">
      <div class="widget-title">Paramètres</div>
      <div class="widget-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('params.store')}}">
          {{ csrf_field() }}
          @foreach(Auth::user()->role->Parameters  as $param)
          <div class="form-group">
            <label for="{{ $param->nom }}">{{ $param->label }} :</label>
            <input type="{{ $param->type }}" class="form-control" name="{{ $param->nom }}" value={{ $param->value }} >
          </div>
          @endforeach
          <div class="bottom center">
           <button class="btn btn-primary btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
            <a href="/home" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-close bigger-110"></i>Annuler</a>
          </div> 
        </form>
      </div>
    </div>
  </div>
  </div>
</div>
@endsection