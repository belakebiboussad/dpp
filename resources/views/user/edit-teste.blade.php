@extends('app')
@section('title','Modifier  l\'utilisateur')
@section('main-content')
<div class="page-header">
    <h1>Modification les données du l'utilisateur  <q class="blue">{{ $user->employ->full_name }} </q></h1>
    <div class="pull-right">
      <a href="{{route('users.index')}}" class="btn btn-white btn-info btn-bold">
        <i class="ace-icon fa fa-arrow-circle-left blue"></i> Rechercher</a>
    </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <form role="form" action="{{  route('users.update', $user->employ->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <input type="hidden" name="id" value="{{ $user->employ->id }}">
      <div class="form-group" id="error" aria-live="polite">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
        <div class="form-group col-md-6 col-md-offset-5">
        <button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
        <a href="{{ route('home') }}" class="btn btn-sm btn-warning text-decoration-none"><i class="ace-icon fa fa-undo"></i>Annuler</a>
      </div>
    </form>
  </div>
</div>
@stop