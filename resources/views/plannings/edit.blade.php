@extends('app')
@section('page-script')
<script type="text/javascript">
</script>
@stop
@section('main-content')
<div class="container">
  <div class="page-header">Modifier la demande du {{$demande->date}}</div>
  <div class="widget-box">
    <div class="widget-header"><h5 class="widget-title"></h5>
      <div class="pull-right">
        <a href="{{ route('planning.index') }}" class="btn btn-sm btn-info"><i class="ace-icon fa fa-bars"></i>Demandes</a>
          <form action="{{ route('planning.destroy', $demande)}}" method="post" class="inline">
            {{ csrf_field() }}
           {{ method_field('DELETE') }}
            <button class="btn btn-sm btn-danger" type="submit"><i class="ace-icon fa fa-trash-o"> Supprimer</i></button>
          </form>      
        
      </div>
    </div>
    <div class="widget-body">
    <div class="widget-main">
      <form action="{{ route('planning.update', $demande) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group row">
            <label for="employe" class="col-sm-2 col-form-label">Employé</label>
            <div class="col-sm-10">
                <select class="form-control" id="employe" name="employe_id">
                  <option value="{{ $employe->id }}" selected disabled>{{ $employe->full_name }}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date début</label>
            <div class="col-sm-10">
              <input type="text" class="date-picker form-control date" name="date" value="{{ $demande->date->format('Y-m-d') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="date_end" class="col-sm-2 col-form-label">Date fin</label>
            <div class="col-sm-10">
              <input type="text" class="date-picker form-control date" name="date_end" value="{{ $demande->date_end->format('Y-m-d') }}">
            </div>
        </div>
         <div class="form-group row">
            <label for="date_end" class="col-sm-2 col-form-label">La demande</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="desc" cols="30" rows="5" value ="{{ $demande->desc }}" required></textarea>
            </div>
        </div>
        <div class="form-group col text-center">
          <button type="submit" class="btn btn-sm btn-primary mt-3"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
          <button class="btn btn-warning btn-sm" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
