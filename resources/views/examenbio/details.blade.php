@extends('app_laboanalyses')
@section('style')
<style>
h3.b {
  word-spacing: 3px !important;
}
#footer {
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    width:100%;
    height:100px;
}

#footerContainer {
    position:relative;
    width:100%;
    height:100px;
}

#imginthefooter {       
    background: url(img/footer.png) no-repeat;
    width:100px;
    height:300px;
    top: -108px;  /* Position element */
    right: 150px; /* Position element */ 
    position: absolute;
}​​​​​​​​​
</style>
@endsection
@section('page-script')
<script>
  function CRBave()
  { 
    $("#crb").val($("#crbm").val());
  }
  // function CRBPrint()
  // {
  //   var formData = {
  //       pid:'{{ $patient->id }}',
  //       mid:'{{ $medecin->id }}',
  //       crb:$("#crbm").val(),
  //   };
  //   $.ajaxSetup({
  //         headers: {
  //           'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
  //         }
  //     });
  //   $.ajax({
  //       type: "POST",
  //       url: "/crbprint",
  //       data:formData,//contentType: "application/j-son;charset=UTF-8",

  //       //dataType: "json",
  //       success: function (data,status, xhr) {      
  //        //   $('#iframe-pdf').contents().find('html').html(data.html);
  //       //     alert($('#iframe-pdf').contents().find('html').html());
  //       // $("#crbBioaModal").modal();

  //       },  
  //       error: function (data) {
  //         console.log('Error:', data);

  //       }
  //   });

  // }
  function CRBPrint()
  {
    var crbm = $("#crbm").val();
    $("#crbPDF").text(crbm);
    $("#pdfContent").removeClass('hidden');
    var element = document.getElementById('pdfContent');
    var options = {
      filename: 'crb-'+'{{ $patient->Nom }}'+'-'+"{{ $patient->Prenom }}"+".pdf",
       image: {type: 'jpeg', quality: 1},
      html2canvas: {dpi: 72, letterRendering: true},
      jsPDF: {unit: 'mm', format: 'a4', orientation: 'landscape'},
          
    };

     //  var exporter = new html2pdf(element, options);// Create instance of html2pdf class
     // $("#pdfContent").addClass('hidden'); //$("#pdfContent").removeAttr('disabled');
    
    //  exporter.getPdf(true).then((pdf) => {// Download the PDF or...
    //        console.log('pdf file downloaded');
    //  });
    // exporter.getPdf(false).then((pdf) => {// Get the jsPDF object to work with it
    //   console.log('doing something before downloading pdf file');
    //   pdf.save();
    // }); 
  
    // Get the element to print
    var element = document.getElementById('pdfContent');
    // Define optional configuration
    var options = {
      filename: 'my-file.pdf'
    };

    // Create instance of html2pdf class
    var exporter = new html2pdf(element, options);

    // Download the PDF or...
    exporter.getPdf(true).then((pdf) => {
      console.log('pdf file downloaded');
    });

    // Get the jsPDF object to work with it
    exporter.getPdf(false).then((pdf) => {
      console.log('doing something before downloading pdf file');
      pdf.save();
    });

// You can also use static methods for one time use...
options.source = element;
options.download = true;
html2pdf.getPdf(options);

  }
  $(function(){
    $(".open-AddCRBilog").click(function () {//jQuery('#CRBForm').trigger("reset");
        jQuery('#crbSave').val("add");
        $('#addCRBDialog').modal('show');
    });
  })
  $('document').ready(function(){
    $("button").click(function (event) {
         which = '';
         str ='send';
         which = $(this).attr("id");
         var which = $.trim(which);
         var str = $.trim(str);
         if(which==str){
          return true;
        }
    });
});
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
  {{-- <div class="row"> @include('examenbio.ModalFoms.crbprint')</div> --}}
  <object id="pdfviewer" data="/files/sample.pdf" type="application/pdf" style="width:100%;height:500px;"></object>
<div class="row text-center">@include('examenbio.CRBModal')</div> 
@endsection