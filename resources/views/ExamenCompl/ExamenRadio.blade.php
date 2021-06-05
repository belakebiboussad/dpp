<div class="row">
	<div class="col-xs-12 widget-container-col" id="consultation">
		<div class="widget-box" id="infopatient">
			<div class="widget-header"><h5 class="widget-title"><b>Demande examen radiologique :</b></h5> </div>
	        </div><!-- widget-box -->
		<div class="widget-body">
                <div class="widget-main"><div class="space-12 hidden-xs"></div>
	        <div class="row">
	        	<div class="col-xs-12">
	        		<label for="infosc">  <b>Informations cliniques pertinentes</b></label>
					    <textarea class="form-control" id="infosc" name="infosc"></textarea>
					    {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
	        	</div>
	        </div><!-- row --><div class="spcae-12"></div>
	        <div class="row">
	     		 	<div class="col-xs-12">
	      			<label for="explication"><strong>	Explication de la demande de diagnostic</strong></label>
			 				<textarea class="form-control" id="explication" name="explication"></textarea>
			     	 {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
	      		</div>
	        </div><div class="space-12 hidden-xs"></div>
	        <div class="row">
	        <div class="col-xs-12">
	      	 	<label for="infos"><b>Informations supplémentaires pertinentes</b></label><br>
			@foreach($infossupp as $info)
			<div class="col-sm-2 col-xs-6">
			<div class="checkbox col-xs-12">
				 <label><input name="infos[]" type="checkbox" class="ace" value="{{ $info->id }}" /><span class="lbl">{{ $info->nom }}</span></label>
		    </div>
		  </div>
			@endforeach
		</div>
      		</div>
       	<div class="row"><div class="col-xs-12">@include('ExamenCompl.ModalFoms.ExamenImgModal')</div></div>
       	<div class="space-12"></div>
	      <div class="row">
			 <div class= "widget-box widget-color-blue" id="widget-box-2 col-xs-12">
			 <div class="widget-header" >
				<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Examens Imagerie</b></font></h5>
				<div class="widget-toolbar widget-toolbar-light no-border" width="5%">
				 	<a href="#"  name="btn-add" class="btn-xs tooltip-link" data-toggle="modal" data-target="#ExamIgtModal" data-original-title="Ajouter un Examen d'imagerie"><div class="fa fa-plus-circle"></div><h4><strong></strong></h4></a>
				</div>
			</div><!-- widget-header -->
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table nowrap dataTable table-bordered no-footer table-condensed" id="ExamsImgtab">
					 	 <thead class="thin-border-bottom">
							 <tr>
                  <th class ="hidden"></th>
							    <th class ="center" class="nsort" style="background-color: #eee; color; white;"><strong>Examen du </strong></th>
								  <th class ="center" style="background-color: #eee; color; white;"><strong>Type Examen</strong></th>
								   <th class="center" width="5%" style="background-color: #eee; color; white;"><em class="fa fa-cog"></em></th>
						    </tr>
							</thead>
							<tbody id="ExamsImg"></tbody>
					</table>
				</div>
			</div>
	        </div>
               </div>
      </div> 	<!-- widget-main -->
    </div><!-- widget-body -->
 	</div>	<!-- widget-container-col -->
</div><!-- row -->
<div class="row"><div id="imagExamsPdf" class="invisible">@include('consultations.EtatsSortie.demandeExamensImgPDF')</div></div>

