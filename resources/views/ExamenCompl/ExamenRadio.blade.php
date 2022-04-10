<div class="row">
	<div class="col-xs-12 widget-container-col" id="consultation">
		<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title"><b>Demande d'examen radiologique :</b></h5> </div>
	  </div>
		<div class="widget-body">
      <div class="widget-main"><div class="space-12 hidden-xs"></div>
	      <div class="row">
	       	<div class="col-xs-12">
	       		<label for="infosc">  <b>Informations cliniques pertinentes</b></label>
				    <textarea class="form-control" id="infosc" name="infosc"></textarea>
				    {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
	       	</div>
	        </div><div class="spcae-12"></div>
	        <div class="row">
	     		 <div class="col-xs-12">
	      			<label for="explication"><strong>	Explication de la demande de diagnostic</strong></label>
			 				<textarea class="form-control" id="explication" name="explication"></textarea>
			     	 {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
	      		</div>
	        </div><div class="space-12 hidden-xs"></div>
	        <div class="row">
	        	<div class="col-xs-12 infosup">
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
       	<div class="row"><div class="col-xs-12">@include('ExamenCompl.ModalFoms.ExamenImgModal')</div></div><div class="space-12"></div>
	      <div class="row">
			 <div class= "widget-box widget-color-blue">
			 <div class="widget-header" >
				<h5 class="widget-title bigger"><!-- <font color="black"> -->
          <i class="ace-icon fa fa-table"></i>&nbsp;Examens d'imagerie<!-- </font> -->
        </h5>
				<div class="widget-toolbar widget-toolbar-light no-border" width="5%">
           <a href="#" class="align-middle" data-toggle="modal" data-target="#ExamIgtModal">
            <i class="fa fa-plus-circle bigger-180" data-toggle="modal"></i>
          </a>
				</div>
				</div><!-- widget-header -->
				<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table nowrap dataTable table-bordered no-footer table-condensed" id="ExamsImgtab">
					 	<thead class="thin-border-bottom">
						  <tr style ="background-color: #eee;">
                  <th class ="hidden"></th>
							    <th class ="center" class="nsort" style="color; white;"><strong>Examen du</strong></th>
                   <th class ="hidden"></th>
                  <th class ="center"><strong>Type d'examen</strong></th>
								  <th class="center" width="5%"><em class="fa fa-cog"></em></th>
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