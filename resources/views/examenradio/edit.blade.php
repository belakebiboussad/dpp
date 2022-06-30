@extends('app')
@section('page-script')
@include('examenradio.scripts.imgRequestdJS')
<script>
 $(function(){
    $('body').on('click', '.exam-Delete', function (e) {  
            event.preventDefault();
            var exam_id = $(this).val(); 
             $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') }
             });
            url='{{ route("examRad.destroy",":slug") }}';
            url = url.replace(':slug',exam_id);
           $.ajax({
                type: "GET",
                 url : url,
                   dataType: 'json',
                    success: function (data) {
                           $("#exm-" + data.id).remove(); 
                    },
                    error: function (data) {
                           console.log('Error:', data); 
                     } 
            });
    });
    $("#requestImgEdit").submit(function(e){//event.preventDefault();
      var arrayLignes = document.getElementById("ExamsImg").rows;
      addExamsImg(this);
      $("#requestImgEdit").submit();
    });
 })
  </script>
@endsection
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo',['patient'=>$demande->consultation->patient])</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6"><h3><strong>Modifier la demande d'examen Radiologique :</strong></h3></div>
    <div class="col-sm-6 pull-right">
      <a href="/drToPDF/{{ $demande->consultation->demandExmImg->id }}" target="_blank" class="btn btn-sm btn-primary pull-right">
       <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>&nbsp;&nbsp;
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    </div>
  </div><hr>
  	<div class="row">
	<div class="col-xs-12 widget-container-col" id="consultation">
		<div class="widget-box" id="infopatient">
			<div class="widget-header"><h5 class="widget-title"><b><strong>Demande d'examen radiologique :</strong></b></h5> </div>
	        </div><!-- widget-box -->
		<div class="widget-body">
    <form class="form-horizontal" id="requestImgEdit" method="POST" action="{{ route('demandeexr.update',$demande->id) }}" > 
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <input type="hidden" name="demande_id" value="{{ $demande->id }}" >
                <div class="widget-main"><div class="space-12 hidden-xs"></div>
	        <div class="row">
	        	<div class="col-xs-12">
	        		<label for="infosc">  <b>Informations cliniques pertinentes</b></label>
			        <textarea class="form-control" id="infosc" name="infosc">{{ $demande->InfosCliniques}}</textarea>
					    {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
	        	</div>
	        </div><div class="space-12 hidden-xs"></div>
	        <div class="row">
     		 	<div class="col-xs-12">
      			<label for="explication"><strong>	Explication de la demande de diagnostic</strong></label>
		 				<textarea class="form-control" id="explication" name="explication" >{{ $demande->Explecations}}</textarea>
		     	 {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
	      		</div>
	        </div><div class="space-12 hidden-xs"></div>
	        <div class="row">
	             <div class="col-xs-12">
	      	 	        <label for="infos"><b>Informations supplémentaires pertinentes</b></label><br>
				@foreach($infossupp as $info)
				<div class="col-sm-2 col-xs-6">
				        <div class="checkbox col-xs-12">
					 <label><input name="infos[]" type="checkbox" class="ace" value="{{ $info->id }}"   {{ (in_array($info->id, $demande->infos))? 'checked' : '' }} /> <span class="lbl">{{ $info->nom }}</span></label>
                                    </div>
				</div>
				@endforeach
			</div>
      		</div>
       	      <div class="row"><div class="col-xs-12">@include('ExamenCompl.ModalFoms.ExamenImgModal')</div></div>  <div class="space-12"></div>
	      <div class="row">
			 <div class= "widget-box widget-color-blue" id="widget-box-2 col-xs-12">
			 <div class="widget-header" >
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Examens Imagerie</h5>
				<div class="widget-toolbar widget-toolbar-light no-border" width="5%">
          <a href="#" class="align-middle" data-toggle="modal" data-target="#ExamIgtModal">
            <i class="fa fa-plus-circle bigger-180" data-toggle="modal"></i>
          </a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="ExamsImgtab">
				 	  <thead class="thin-border-bottom">
						 <tr>
                <th class ="hidden"></th>
						    <th class ="center" class="nsort"><strong>Examen du</strong></th>
							  <th class ="hidden"></th>
                <th class ="center"><strong>Type d'examen</strong></th>
							  <th class="center" width="5%"><em class="fa fa-cog"></em></th>
					    </tr>
						</thead>
						  <tbody id="ExamsImg">
                @foreach ($demande->examensradios as $index => $ex)
                  <tr id="{{ 'exm-'.$ex->id }}">
                    <td id="idExamen" hidden>{{ $ex->Examen->id }}</td>
                    <td>{{ $ex->Examen->nom }}</td>
                    <td hidden id="types">{{ $ex->Type->id }}</td>  
                    <td>{{ $ex->Type->nom }}</td>
                    <td class="center">
                     <button  data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger exam-Delete" value="{{ $ex->id }}"> <i class="ace-icon fa fa-trash-o"></i></button> 
                   </td>
                </tr>
                @endforeach   
              </tbody>
					</table>
				</div>
			</div>
	        </div>
               </div>
      </div> 	<!-- widget-main -->
      <div class="row">
        <div class="col-sm12">
          <div class="center" style="bottom:0px;">
            <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>
         </div>
          </div>
        </div>
        </form>
    </div><!-- widget-body -->
 	</div>	<!-- widget-container-col -->
</div><!-- row -->
			</div>

 </div>
@endsection