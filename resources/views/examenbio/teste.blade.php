@extends('app_laboanalyses')
@section('style')
<style>
h3.b {
  word-spacing: 3px !important;
}
@CHARSET "UTF-8";
    .page-break {
      page-break-after: always;
      page-break-inside: avoid;
      clear:both;
    }
    .page-break-before {
      page-break-before: always;
      page-break-inside: avoid;
      clear:both;
    }
    #pdfContent{
      position: absolute; 
      left: 20px; 
      top: 50px; 
      bottom: 0; 
      overflow: auto; 
      width: 600px;
    }
</style>
@endsection
@section('page-script')
<script>
var base64Img = null;
imgToBase64('img/entete.png', function(base64) {
    base64Img = base64; 
});

margins = {
  top: 100,
  bottom: 40,
  left: 30,
  width: 350
};
function generate()
{
  var pdf = new jsPDF('p', 'pt', 'a4');
  pdf.setFontSize(18);
  pdf.fromHTML(document.getElementById('html-2-pdfwrapper'), 
    margins.left, // x coord
    margins.top,
    {
      // y coord
      width: margins.width// max width of content on PDF
    },function(dispose) {
      headerFooterFormatting(pdf, pdf.internal.getNumberOfPages());
      }, 
        margins);
  var iframe = document.createElement('iframe');
  iframe.setAttribute('style','position:absolute;right:0; top:0; bottom:0; height:100%; width:350px; padding:20px;');
  document.body.appendChild(iframe);
  iframe.src = pdf.output('datauristring');
}
function headerFooterFormatting(doc, totalPages)
{
    for(var i = totalPages; i >= 1; i--)
    {
        doc.setPage(i);                            
        footer(doc, i, totalPages);
        doc.page++;
    }
}
// You could either use a function similar to this or pre convert an image with for example http://dopiaza.org/tools/datauri
// http://stackoverflow.com/questions/6150289/how-to-convert-image-into-base64-string-using-javascript
function imgToBase64(url, callback, imgVariable) {
 
    if (!window.FileReader) {
        callback(null);
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.responseType = 'blob';
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
      imgVariable = reader.result.replace('text/xml', 'image/jpeg');
            callback(imgVariable);
        };
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.send();
};

function footer(doc, pageNumber, totalPages){
    var str = "Page " + pageNumber + " of " + totalPages
    doc.setFontSize(10);
    doc.text(str, margins.left, doc.internal.pageSize.height - 20);
};
</script>
@endsection
@section('main-content')
<div class="row" width="100%"> @include('patient._patientInfo',$patient) </div>
<div class="row">
  <div class="col-md-5 col-sm-5"><h3>Demande d'examen biologique</h3></div>
  <div class="col-md-7 col-sm-7">
    <a href="/dbToPDF/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right"><i class="ace-icon fa fa-print"></i>&nbsp;Imprimer</a>&nbsp;&nbsp;
    @if('Auth::user()->role_id ' == 11)
    <a href="/home" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    @else
    <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    @endif
  </div>
</div><hr>
<div class="row">
  <div class="col-xs-11">
    <div class="widget-box">
      <div class="widget-header"><h4 class="widget-title">Détails de la demande :</h4></div>
      <div class="widget-body">
        <div class="widget-main">
        <div class="row">
          <div class="col-xs-12">
            <div class="user-profile row">
              <div class="col-xs-12 col-sm-3 center">
              <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                  <div class="profile-info-name">Date : </div>
                  <div class="profile-info-value"><span class="editable">
                  @if(isset($demande->consultation))
                    {{  (\Carbon\Carbon::parse($demande->consultation->Date_Consultation))->format('d/m/Y') }}
                  @else
                    {{  (\Carbon\Carbon::parse($demande->visite->date))->format('d/m/Y') }}
                  @endif 
                  </span></div>
                </div>
              </div><!-- striped -->
              <div class="profile-user-info profile-user-info-striped">
                 <div class="profile-info-row">
                  <div class="profile-info-name">Etat :</div>
                  <div class="profile-info-value">
                      @if($demande->etat == null)
                        <span class="badge badge-success">En Cours
                      @elseif($demande->etat == 1)
                        <span class="badge badge-primary">Validé  
                      @elseif($demande->etat == 0)
                        <span class="badge badge-warning">Rejeté
                      @endif
                      </span>
                  </div>
                </div>
              </div><!-- striped   -->
              <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                  <div class="profile-info-name"> Demandeur : </div>
                  <div class="profile-info-value">
                    <span class="editable" id="username">{{ $medecin->nom }} {{ $medecin->prenom }}</span>
                  </div>
                </div>
              </div><!-- striped   -->
            </div><!-- col-xs-12 col-sm-3 center   -->
            </div><br/><!-- user-profile row -->
            <form class="form-horizontal" id ="cerbForm" method="POST" action="/uploadresultat" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
            <input type="hidden" name="crb" id ="crb"> 
            <div class="user-profile row">
              <div class="col-xs-12 col-sm-12 center">
                <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="center" width="5%">#</th>
                    <th class="center" width="30%">Nom Examen</th>
                    <th class="center" width="15%">Class Examen</th>
                    <th class="center" width="40%">Attacher le Résultat:</th>
                    <th class="center" width="10%"><em class="fa fa-cog"></em></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($demande->examensbios as $index => $exm)
                  <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $exm->nom_examen }}</td>
                    <td>{{ $exm->Specialite->specialite }}</td>
                    @if($loop->first)
                    <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
                      <input type="file" class="form-control" id="resultat" name="resultat" alt="Résultat du l'éxamen" accept="image/*,.pdf" required/> 
                    </td>
                    @endif
                    @if($loop->first)
                    <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
                      @if($demande->etat == null)
                      <button type="button" class="btn btn-md btn-success open-AddCRBilog" data-toggle="modal" title="ajouter un Compte Rendu" data-id="{{ $demande->id }}" id ="crb-add-{{ $demande->id }}" @if( isset($exm->pivot->crb)) hidden @endif">
                        <i class="glyphicon glyphicon-plus glyphicon glyphicon-white"></i>
                      </button>
                      @endif
                    </td>
                    @endif 
                  </tr>
                  @endforeach                         
                </tbody>
                </table>
              </div>
            </div><br>
            <div class="row">
              <div class="col-xs-12 col-sm-12 center">
                <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
               </div>
            </div>
          </form>
          </div><!-- col-xs-12 -->
        </div><!-- row -->
        </div><!-- widget-main -->
      </div><!-- widget-body -->
    </div><!-- widget-box -->
  </div><!-- col-xs-12 -->
  <div class="col-xs-1"><div id="pdfContent" class="hidden">@include('examenbio.EtatsSortie.crbClient')</div></div>
</div><!-- row -->
 
<div class="row text-center">@include('examenbio.CRBModal')</div> 
@endsection