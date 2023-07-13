@extends('app')
@section('title','Créer une demande')
@section('style')
<style type="text/css" media="screen">

</style>
@stop
@section('main-content')
<div class="row">
<div class="col-xs-12 col-sm-12">
  <div class="widget-box">
    <div class="widget-header">
      <h4 class="widget-title">Produits demandés</h4>
      <div class="widget-toolbar" class="btn-group" role="group">
        {{-- <a id="deletepod" class="btn btn-xs btn-danger" disabled><i class="ace-icon fa fa-trash-o"></i></a> --}}
        {{-- btn btn-xs btn-primary block align-middle --}}
        <a href="#" class="btn-xs align-middle" id="Productdd" data-toggle="modal" data-target="#productAdModal"><i class="fa fa-plus-circle bigger-180"></i></a>      </div>
    </div>
    <div class="widget-body">
      <div class="widget-main">
        <div class="row">
          <div class="col-xs-12">
            <form id="demandform" method="POST" action="{{ route('demandeproduit.store') }}">
              {{ csrf_field() }}
              <table id="cmd" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="center">#</th><th class="center">Produits</th><th class="center">Gamme</th><th class="center">Spécialité</th><th class="center">Quantité</th><th class="center">Unité</th>
                  </tr>
                </thead>
                <tbody ></tbody>
              </table>
              <div class="hr hr8 hr-double hr-dotted"></div>
              <div class="pull right">
                <button id="savedmd" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
                </button>
                 <a href="{{ route('demandeproduit.destroy',$demande->id) }}" data-method="DELETE" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>{{-- widget-body --}}
  </div>             
</div>
</div>
@include('demandeproduits.ModalForms.ProductAdModal')
@stop
@section('page-script')
@include('demandeproduits.partials.scripts')
@stop