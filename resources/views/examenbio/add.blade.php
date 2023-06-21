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
  <div class="col-xs-11"> @include('examenbio.partials._show')</div>
  <div class="col-xs-1"><div id="pdfContent" class="hidden">@include('examenbio.EtatsSortie.crbClient')</div>
</div>
</div>
<div class="row"><div class="col-xs-12">@include('examenbio.uploadResFrm')</div></div>
  <div class="row">@include('examenbio.ModalFoms.CRBModal')</div>
@stop