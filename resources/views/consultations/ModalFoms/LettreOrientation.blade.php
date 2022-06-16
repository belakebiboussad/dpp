<style type="text/css" media="screen">
td
{
 max-width: 100px;
 overflow: hidden;
 text-overflow: ellipsis;
 white-space: nowrap;
}
</style>
<div id="lettreorient" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Orientation du patient</h4></div>
			<div class="modal-body">
			  <div class="row">
			    <div class="col-xs-12">
				    <div class= "widget-box widget-color-green">
            <div class="widget-header">
               <h5 class="widget-title bigger lighter">
                  <i class="ace-icon fa fa-table"></i>&nbsp;<b>Lettres d'orientation</b></h5>
              <div class="widget-toolbar widget-toolbar-light no-border">
                <a id="orientation-add" class="btn-xs align-middle" data-toggle="modal"><i class="fa fa-plus-circle bigger-180"></i></a>
              </div>
            </div>
            <div class="widget-body">
              <div class="widget-main no-padding">
                <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="orientationsList">
                  <thead class="thin-border-bottom">
                    <tr>
                    <th class ="hidden"></th>
                    <th class="center"><strong><span style="font-size:14px;">Spécialité</span></strong></th>
                    <th class="center">
                      <strong><span style="font-size:14px;">Motif de consultation</span></strong>
                    </th>
                    <th class="center hidden-480"><span style="font-size:14px;"><strong>Examen général</strong></span></th>
                    <th class="center"><em class="fa fa-cog"></em></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
		      </div>
				</div><!-- row -->
        <div class="space-12"></div> 
        <div class="row">
          <div class="col-xs-12">
            <div class= "widget-box widget-color-info">
              <div class="widget-header">
               <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>&nbsp;<b>Certificat Medical Descriptif</b></h5>
                <div class="widget-toolbar widget-toolbar-light no-border">
                  <a id="certifDescrip-add" class="btn-xs align-middle" data-toggle="modal"><i class="fa fa-plus-circle bigger-180"></i></a>
                </div>
              </div><!-- widget-header -->
              <div class="widget-main no-padding">
                <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="certificatDescrList">
                  <thead class="thin-border-bottom">
                    <tr class ="center">
                      <th class="center">Examen Clinique</th>
                      <th class="center" width="6%">Chronique ?</th>
                      <th class="center" width="5%"><em class="fa fa-cog"></em></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div><!-- widget-box -->
          </div><!-- col-sm-12 -->
        </div><!-- row -->
      </div>{{-- modal-body --}}
		  <div class="modal-footer">
          <div class="col-sm-12">
			    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="OrientationSave()"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
				  <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			  </div>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}
@include('consultations.ModalFoms.LettreOrientationAdd')@include('consultations.ModalFoms.certificatDescriptif')
<script>
/*function orLetterPrintOrg(nomP,prenomP,ageP,ipp,ett,etn,etadr,ettel,etlogo) {
      $('#OrientLetterPdf').removeAttr('hidden');$("#orSpecialite").text($( "#specialiteOrient option:selected" ).text().trim());
      $("#motifCons").text($( "#motifC" ).val());$("#motifO").text($( "#motifOrient" ).val());
      var element = document.getElementById('OrientLetterPdf');var options = {filename:'lettreOrient-'+nomP+'-'+nomP+'.pdf'
      };var exporter = new html2pdf(element, options);$("#OrientLetterPdf").attr("hidden",true);
      exporter.getPdf(true).then((pdf) => {console.log('pdf file downloaded');});
      exporter.getPdf(false).then((pdf) => {console.log('doing something before downloading pdf file'); pdf.save();});}*/
    $(function(){
      imgToBase64("{{ asset('/img/entete.jpg') }}", function(base64) {
        base64Img = base64; 
      });
      imgToBase64("{{ asset('/img/footer.jpg') }}", function(base64) {
        footer64Img = base64; 
      });   
      $('#LettreOrientationAdd').on('hidden.bs.modal', function (e) {  
      $(this).find("input:not([type=button]),textarea,select,text")
        .val('')
        .end().find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
    });
    $('#orientation-add').click(function () {//ADD Orientation
        $('#orientationSave').val("add");
        $('#modalFormDataOroient').trigger("reset");
        $('#orientCrudModal').html("Ajouter une  lettre d'orientation");
        jQuery('#LettreOrientationAdd').modal('show');
    });
    $('#orientationSave').click(function (e) {//save Orientation
       e.preventDefault();
      var formData = {
         _token          : CSRF_TOKEN,
        consultation_id  : '{{ $consult->id }}',
        specialite       : $("#specialiteOrient").val(),
        motif            : $("#motifC").val(), 
        examen           : $("#motifOrient").val(),
      };
      var type = "POST" , url = '';
      var state = $(this).val(); 
      if ( state == "update") {
        type = "PUT";
        url = '{{ route("orientLetter.update", ":slug") }}'; 
        url = url.replace(':slug',$("#orient_id").val());
      }else
        url ="{{ route('orientLetter.store') }}";
      $.ajax({
          type: type,
          url: url,
          data: formData,
          success: function (data) {
            var orientation ='<tr id="'+ data.id + '"><td>'+ data.specialite.nom +'</td><td>'+ data.motif +'</td><td>'+ data.examen +'</td><td class="center">';
            orientation += '<button type="button" class="btn btn-xs btn-info open-Orient" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
            orientation += '<button type="button" class="btn btn-xs btn-success" id ="orientationPrint" value="' + data.id + '"><i class="ace-icon fa fa-print"></i></button>&nbsp;';
            orientation += '<button class="btn btn-xs btn-danger delete-orient" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
            if(state == "update")
              $("#" + data.id).replaceWith(orientation);
            else
              $("#orientationsList").append(orientation);
            $('#LettreOrientationAdd').trigger("reset");
          }
      });
    });
    $('body').on('click', '.open-Orient', function (event) {
      event.preventDefault();
      var id = $(this).val();
      $.get('/orientLetter/'+id+'/edit', function (data) {
         $('#orient_id').val(data.id);
        $("#specialiteOrient").val(data.specialite.id).change();
        $("#motifC").val(data.motif);
        $("#motifOrient").val(data.examen);
        $('#orientationSave').val("update");
        $('#orientationSave').attr('data-id',data.id);
        $('#orientCrudModal').html("Modifier la  lettre d'orientation") 
        $('#LettreOrientationAdd').modal('show');
      }); 
    });
    $('body').on('click', '#orientationPrint', function (event) {
        var fileName ='orientLetter-'+'{{ $patient->Nom}}'+'-'+'{{ $patient->Prenom}}'+'.pdf';
        var tr = document.getElementById($(this).val());
        $("#motifCons").text(tr.cells[1].innerHTML);
        $("#motifO").text(tr.cells[2].innerHTML);
        var ipp = '{{ $patient->IPP }}';
        var pdf = new jsPDF('p', 'pt', 'a4');
        JsBarcode("#barcode",ipp,{
          format: "CODE128",
          width: 2,
          height: 30,
          textAlign: "left",
          fontSize: 12, 
          font: "OCR-B",
          text: "IPP: " + ipp 
        });
        var canvas = document.getElementById('barcode');
        var jpegUrl = canvas.toDataURL("image/jpeg");
        pdf.addImage(jpegUrl, 'JPEG', 25, 175);
        pdf.setFontSize(12);//pdf.text(120,30, 'Cher confrére');
        pdf.text(320,730, 'Respectueusement');
        generate(fileName,pdf,'OrientLetterPdf'); 
    });
     $('body').on('click', '.delete-orient', function (event) {
      event.preventDefault();
      var formData = {_token: CSRF_TOKEN };
      var id =$(this).val();
      $.ajax({
          type: "DELETE",
          url: '/orientLetter/' + id,
          data: formData,
          success: function (data) {
            $("#"+id).remove();
          }
      });
    });
    $('#certifDescrip-add').click(function (e) {
      $('#decriptifSave').val("add");
      $('#modalFormDescript').trigger("reset");
      $('#CertifDescrAdd').modal('show');
    });
    $('#decriptifSave').click(function (e) {//ADD Orientation
      e.preventDefault();
      var formData = {
        _token          : CSRF_TOKEN,
        consultation_id  : '{{ $consult->id }}',
        examen           : $("#examClin").val(),
        isChronic : $("#isChronic").is(":checked") ? 1:0,
      };
      var type = "POST" , url = '';
      var state = $(this).val(); 
      if ( state == "update") {
        type = "PUT";
        url = '{{ route("certifDescrip.update", ":slug") }}'; 
        url = url.replace(':slug',$("#decript_id").val());
      }else
        url ="{{ route('certifDescrip.store') }}";
       $.ajax({
          type: type,
          url: url,
          data: formData,
          success: function (data) {
            var isChronic = data.isChronic != 0 ? 'Oui' : 'Non';
            var certificat ='<tr id ="descript-'+ data.id +'"><td>'+ data.examen +'</td><td>' + isChronic + '</td><td>';
            certificat += '<button type="button" class="btn btn-xs btn-info open-Desc" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
            //certificat += '<button type="button" class="btn btn-xs btn-success" id ="descriptPrint" value="' + data.id + '"><i class="ace-icon fa fa-print"></i></button>&nbsp;';
            certificat += '<a href="/printCertifDescrip/' + data.id +'" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-print"></i>&nbsp;</a>';
            certificat += '<button type="button" class="btn btn-xs btn-danger delete-Desc" value="' + data.id + '" data-confirm = "Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
            if(state == "update")
              $("#descript-" + data.id).replaceWith(certificat);
            else
              $("#certificatDescrList").append(certificat);
            if(!$('#certifDescrip-add').hasClass('hidden'))
              $('#certifDescrip-add').addClass('hidden');
            $('#modalFormDescript').trigger("reset");
          }
      });
    });
    $('body').on('click', '.open-Desc', function (event) {
      event.preventDefault();
      var id = $(this).val();
      $.get('/certifDescrip/'+id+'/edit', function (data) {
        $('#decript_id').val(data.id);
        $("#examClin").val(data.examen);
        if(data.isChronic)
          $('#isChronic').prop('checked', true);
        $('#DescripCrudModal').html("Modifier le Certificat descriptf"); 
        $('#decriptifSave').val("update"); 
        $('#CertifDescrAdd').modal('show');
      });
    });
    /*$('body').on('click', '#descriptPrint', function (event) {
        var fileName ='certifDescrip-'+'{{ $patient->Nom}}'+'-'+'{{ $patient->Prenom}}'+'.pdf';
        var tr = document.getElementById("descript-" + $(this).val());
        $("#examen").text(tr.cells[0].innerHTML);$("#motifO").text(tr.cells[2].innerHTML);
        
        pdf.setFontSize(12); pdf.text(320,730, 'Respectueusement');generate(fileName,pdf,'certificatDescrPdf');});*/     
    $('body').on('click', '.delete-Desc', function (event) {
      event.preventDefault();
      var formData = {_token: CSRF_TOKEN };
      var id =$(this).val();
      $.ajax({
          type: "DELETE",
          url: '/certifDescrip/' + id,
          data: formData,
          success: function (data) {
            $("#descript-"+id).remove();
            $('#certifDescrip-add').removeClass('hidden');
          }
      });
    });
}) 
</script>