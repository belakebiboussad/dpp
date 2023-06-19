@extends('app')
@section('page-script')
<script>
  function CRBSave()
  { 
    $("#crb").val($("#crbm").val());
  }
  function CRBPrint()
  {
    CRBSave();
    var fileName ='compteRendBiolog-'+'{{ $demande->imageable->patient->Nom}}'+'-'+'{{ $demande->imageable->patient->Prenom}}'+'.pdf';
    $("#crbPDF").text($("#crbm").val());
    var pdf = new jsPDF('p', 'pt', 'a4');
    generate(fileName,pdf,'pdfContent'); 
  }
  $(function(){
    $(".open-AddCRBilog").click(function () {
      jQuery('#crbSave').val("add");
      $('#addCRBDialog').modal('show');
    });
    imgToBase64("{{ asset('/img/entete.jpg') }}", function(base64) {
      base64Img = base64; 
    });
    imgToBase64("{{ asset('/img/footer.jpg') }}", function(base64) {
            footer64Img = base64; 
   });    
  })
  $(function(){
    $('#resultat').change(function(){
        $('#crb-add').removeAttr('disabled');
    });
    /*
    $("button").click(function (event) {
      which = '';str ='send';
      which = $(this).attr("id");
      var which = $.trim(which);var str = $.trim(str);
      if(which==str)
         return true;
    });
    */
   })
</script>
@stop
@section('main-content')
<div class="row">@include('patient._patientInfo',['patient'=>$demande->imageable->patient]) </div>
<div class="page-header"><h1>Demande d'examen biologique</h1>
  <div class="pull-right">
    @if(Auth::user()->is(11))
   <a href="{{ route('home')}}" class="btn btn-xs btn-white"><i class="fa fa-search"></i> Rechercher</a>
    @else
    <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning"><i class="ace-icon fa fa-backward"></i> precedant</a>
    @endif
        <a href="/dbToPDF/{{ $demande->id }}" target="_blank" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print"></i> Imprimer</a>
  </div>
</div><hr>
<div class="row">
 <div class="col-xs-11">
  <div class="widget-box">
    <div class="widget-header"><h4 class="widget-title">Détails de la demande</h4></div>
    <div class="widget-body">
      <div class="widget-main">
        <div class="row">
         <div class="col-xs-12">
            <div class="user-profile row">
              <div class="col-xs-12 col-sm-8 center">
              <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name">Date </div>
        <div class="profile-info-value"><span>{{ $demande->imageable->date->format('d/m/Y') }}</span></div>
       </div>
        </div>
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row"><div class="profile-info-name">Etat </div>
              <div class="profile-info-value">{!! $formatStat
($demande) !!}</div>
            </div>
          </div>
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row"><div class="profile-info-name"> Demandeur </div>
              <div class="profile-info-value"><span class="editable" id="username">{{ $demande->imageable->medecin->full_name }}</span></div>
            </div>
          </div>
            </div><!-- col-xs-12 col-sm-3 center   -->
            </div><br/><!-- user-profile row -->
            @include('examenbio.uploadResFrm')
          </div><!-- col-xs-12 -->
        </div><!-- row -->
        </div><!-- widget-main -->
      </div><!-- widget-body -->
    </div><!-- widget-box -->
  </div><!-- col-xs-12 -->
  <div class="col-xs-1"><div id="pdfContent" class="hidden">@include('examenbio.EtatsSortie.crbClient')</div> </div>
</div><!-- row -->
<div class="row">@include('examenbio.ModalFoms.CRBModal')</div>
@stop