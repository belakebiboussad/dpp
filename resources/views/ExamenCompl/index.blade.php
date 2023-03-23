<div id="ExamCompl" class="tabpanel">
<div class="row">
	<ul  class="nav nav-pills nav-justified navbar-custom2 list-group" id ="compl">
		<li role= "presentation" class="active" data-interest = "0">
  		<a href="#biologique" aria-controls="biologique" role="tab" data-toggle="tab" class="jumbotron">
   			<i class="fa fa-2x fa-flask fa-pull-left"></i><span class="bigger-130"> Examen Biologique</span>
      </a>
	 	 </li>
		<li role= "presentation" data-interest = "1">
  		<a href="#radiologique" aria-controls="radiologique" role="tab" data-toggle="tab" class="jumbotron" >
  			<span class="medical medical-icon-mri-pet" aria-hidden="true"></span>
        <span class="bigger-130"> Examen Radiologique</span>
    	</a>
   		</li>
   		<li role= "presentation" data-interest = "2">
     			<a href="#anapath" aria-controls="anapath" role="tab" data-toggle="tab" class="jumbotron" >
   			<span class="medical medical-icon-pathology" aria-hidden="true"></span>
        <span class="bigger-130"> Examen Anapath</span>
    			</a>
   		</li>
	</ul>
</div>
<div class="row">
	<div class= "col-md-9 col-sm-9">
		<div class="tab-content no-border">
	 		<div class="tab-pane active examsBio" id="biologique"> 
	    @foreach ( $specialite->BioExams as $exbio)
      <div class="checkbox col-xs-4"><label>
       <input name="exmsbio[]" type="checkbox" class="ace" value="{{ $exbio->id }}"  /><span class="lbl">{{ $exbio->nom }}</span></label>
      </div>
      @endforeach 
	 		</div>
	 		<div class="tab-pane" id="radiologique"> 
        @if($specialite->ImgExams->count()>0)
          @include('ExamenCompl.ExamenRadio')
        @endif
      </div>
	 		<div class="tab-pane" id="anapath">@include('ExamenCompl.examAnapath')</div>
	 		</div>
	 </div>
	 <div class= "col-md-3 col-sm-3">
			<div class="row">
        <button type="button" class="btn btn-primary btn-lg btn-block requestPrint" value ="{{ $obj->id }}" data-field="consultation_id" disabled>
       
          <div class="fa fa-print bigger-120"></div><span class="bigger-110">Imprimer</span>
				</button>
			</div><div class="space-12"></div>
			@if(! isset($hosp))
					@include('consultations.actions')	
				@endif
		</div>
</div>
</div><div class="row"><canvas id="dos" height="1%"><img id='itf'/></canvas></div>
<script> 
  function examsImgSave(patientName, ipp, med,fieldName, fieldValue){ 
   var infos = [] , ExamsImg = [], types = [];
    $('.infosup input.ace:checkbox:checked').each(function(index, value) {
      infos.push($(this).val());
    });
    var arrayLignes = document.getElementById("ExamsImg").rows;
    for(var i=0; i< arrayLignes.length ; i++)
    {   
      ExamsImg[i] = arrayLignes[i].cells[0].innerHTML;
      types [i] = arrayLignes[i].cells[2].innerHTML;  
    }
    var formData = {
      _token         : CSRF_TOKEN,
      infosc : $("#infosc").val(),
      explication   : $("#explication").val(),
      infos          : JSON.stringify(infos),
      ExamsImg          : JSON.stringify(ExamsImg),
      types          : JSON.stringify(types),
    };
    formData[fieldName] = fieldValue;
    var type = "POST";
    url ="{{ route('demandeexr.store') }}";
    $.ajax({
      type: type,
      url: url,
      data: formData,
      success: function (data) {
        examsImgprint(patientName, ipp, med);
      }
    });  
  }
  function examsImgprint(patientName,ipp,med)
  {
    var fileName ='examsImg-' + patientName +'.pdf'; 
    $("#infoSupPertinante").text('');
    ol = document.getElementById('listImgExam');
    ol.innerHTML = '';
    var len = $(".infosup :checkbox:checked").length;
    if($('.infosup input[type="checkbox"]').is(':checked')){
        $('#infoSupPertinante').append("<h4><b>Informations supplémentaires pertinentes :</b></h4>")
        $('.infosup input.ace:checkbox:checked').each(function(index, value) {
          if(index != len-1)
            $('#infoSupPertinante').append( this.nextElementSibling.innerHTML + " / ");
          else
            $('#infoSupPertinante').append( this.nextElementSibling.innerHTML);
        });
     }else
        $("#infoSupPertinante").text('');
      $("#ExamsImgtab tbody tr").each(function(){
        $("ol").append('<li><span class="pieshare"></span>'+ $(this).find('td:eq(3)').text() + " du (la)"+ $(this).find('td:eq(1)').text()+'</li>');
      });        
      var pdf = new jsPDF('p', 'pt', 'a4');
      JsBarcode("#barcode",ipp,{
              format: "CODE128",
              width: 2,
              height: 30,
              textAlign: "left",
              fontSize: 12, 
              text: "IPP: " + ipp 
      });
      var canvas = document.getElementById('barcode');
      var jpegUrl = canvas.toDataURL("image/jpeg");
      pdf.addImage(jpegUrl, 'JPEG', 25, 175);
      pdf.setFontSize(12);
      pdf.text(320,730, 'Docteur : ' + med);
      generate(fileName,pdf,'imagExamsPdf');
  }
  function enableDisableElem(count)
  {
    if(count > 0)
      $(".requestPrint").removeAttr("disabled");
    else
      if($(".requestPrint").prop('disabled') == false)
        $(".requestPrint").attr('disabled','disabled');
  }
  $(function(){
    $('ul#compl li').click(function(e) 
    { 
      switch($(this).data('interest')){
        case 0:
            enableDisableElem($(document).find('input[name="exmsbio[]"]:checked').length);
            break;
        case 1:
            enableDisableElem(document.getElementById("ExamsImg").rows.length);
            break;  
      }
    });
    $(document).on('change', 'input[name="exmsbio[]"]', function (e) {
       var checkbox = $(this);
       if (checkbox.is(':checked'))
        {
          if($(".requestPrint").prop('disabled') == true)
            $(".requestPrint").removeAttr("disabled");
         }else
        {
          var total = $(document).find('input[name="exmsbio[]"]:checked').length;
          if(total< 1)
            $(".requestPrint").attr('disabled','disabled');
        }
    });
    $(".requestPrint").click(function (e) {
      var interest = $('ul#compl').find('li.active').data('interest');
      switch(interest){
        case 0:
          examsBioSave('{{ $obj->patient->full_name }}', '{{ $obj->patient->IPP}}','{{ Auth::user()->employ->full_name }}',$(this).data('field'),$(this).val());
            break;
        case 1:
          examsImgSave('{{ $obj->patient->full_name }}', '{{ $obj->patient->IPP}}','{{ Auth::user()->employ->full_name }}',$(this).data('field'),$(this).val());
            break;
        default :
          break;
      }
    })
  })
</script>