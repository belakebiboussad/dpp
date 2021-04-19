@extends('app')
@section('page-script')
<script type="text/javascript">
$('document').ready(function(){
   $("#accordion" ).accordion({
      collapsible: true ,
      heightStyle: "content",
      animate: 250,
      header: ".accordion-header"
  }).sortable({
      axis: "y",
      handle: ".accordion-header",
      stop: function( event, ui ) {
        ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
      }
  });
  

});
</script>
@endsection
@section('main-content')
<div class="row">
  <div class="pull-right">
    <a href="{{ route('patient.index') }}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-search bigger-120 blue"></i>Chercher</a>
    <a href="{{route('patient.destroy',$patient->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold">
          <i class="ace-icon fa fa-trash-o bigger-120 orange"> Supprimer</i>
      </a>
   </div>
</div>
<div class="row">
  <div  class="user-profile">
    <div class="tabbable">
      <ul class="nav nav-tabs padding-18">
        <li class="active">
          <a data-toggle="tab" href="#home"><i class="green ace-icon fa fa-user bigger-120"></i>Informations Administratives</a>
        </li>
        @if(in_array(Auth::user()->role_id,[1,14]))
        <li>
           <a data-toggle="tab" href="#Ants">
            <i class="fa fa-history fa-1x"></i>&nbsp;<span>Antecedants</span>&nbsp;<span class="badge badge-primary">
            {{$patient->antecedants->count() }}</span>
          </a>
        </li>
        <li>
          <a data-toggle="tab" href="#Cons">
            <i class="orange ace-icon fa fa-stethoscope bigger-120"></i>Consultations&nbsp;
            <span class="badge badge-warning">{{ $patient->consultations->count() }}</span>
          </a>
        </li>
        <li>
          <a data-toggle="tab" href="#Hosp"><i class="pink ace-icon fa fa-h-square bigger-120"></i>
            Hospitalisations&nbsp;<span class="badge badge-pink">{{ $patient->hospitalisations->count() }}</span>
          </a>
        </li>
        @endif
        <li>
          <a data-toggle="tab" href="#rdvs">
            <i class="blue ace-icon fa fa-calendar-o bigger-120"></i>RDV&nbsp;<span class="badge badge-info">{{ $patient->rdvs->count() }}</span>
          </a>
        </li>
        @if (!is_null($correspondants))
        <li><a data-toggle="tab" href="#homme_conf"><i class="green ace-icon fa fa-user bigger-120"></i>Homme de confiance</a></li>
        @endif
      </ul>
      <div class="tab-content no-border padding-24">
        <div id="home" class="tab-pane in active">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-sm-6">
    <h3 class="header blue lighter smaller">
        <i class="ace-icon fa fa-list smaller-90"></i>
        Sortable Accordion
    </h3>

    <div id="accordion" class="accordion-style2 ui-accordion ui-widget ui-helper-reset ui-sortable" role="tablist">
        <div class="group" style="">
            <h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-corner-all" role="tab" id="ui-id-23" aria-controls="ui-id-24" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Section 1</h3>

            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-24" aria-labelledby="ui-id-23" role="tabpanel" style="display: none;" aria-hidden="true">
                <p>
                    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                </p>
            </div>
        </div>

        <div class="group">
            <h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-state-hover ui-corner-all" role="tab" id="ui-id-25" aria-controls="ui-id-26" aria-selected="false" aria-expanded="false" tabindex="0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Section 2</h3>

            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-26" aria-labelledby="ui-id-25" role="tabpanel" aria-hidden="true" style="display: none;">
                <p>
                    Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
suscipit faucibus urna.
                </p>
            </div>
        </div>
    </div><!-- #accordion -->
</div><!-- ./span -->

</div><!-- ./row -->
@endsection