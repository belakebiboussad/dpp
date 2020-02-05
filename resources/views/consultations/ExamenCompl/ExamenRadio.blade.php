<div class="row">
	<div class="col-xs-12 widget-container-col" id="consultation">
		<div class="widget-box" id="infopatient">
			<div class="widget-header">
	         	  <h5 class="widget-title"><b>Demande d'un examen radiologique :</b></h5>
	          </div>
			</div><!-- widget-box -->
			<div class="widget-body">
        <div class="widget-main">
        	<div class="row">
        		<div class="col-xs-12">
        			<label for="infosc">
				        <b>Informations cliniques pertinentes</b>
				      </label>
				      <textarea class="form-control" id="infosc" name="infosc"></textarea>
				      {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
        		</div>
          </div><!-- row -->
          <div class="row">
          	<div class="col-xs-12">
          		<label for="explication">
				 				<strong>	Explication de la demande de diagnostic</strong>
				      </label>
				      <textarea class="form-control" id="explication" name="explication"></textarea>
				      {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
          	</div>
          </div>
          <div class="row">
          	<div class="col-xs-12">
          		<label for="infos">
				        <b>Informations supplémentaires pertinentes</b>
				      </label>
				      <br>
				      @foreach($infossupp as $info)
				      <div class="col-xs-2">
				       	<div class="checkbox">
				         	<label>
				           	<input name="infos[]" type="checkbox" class="ace" value="{{ $info->id }}" />
				            <span class="lbl">{{ $info->nom }}</span>
				          </label>
				        </div>
				      </div>
				      @endforeach
				    
				  </div>
        </div>
        <div class="row">
        	<div class="col-sm12">
        		<label for="explication"><b>Examen(s) proposé(s)</b></label>
			      <br>
			      <select id="examensradio" name="examensradio[]" multiple="multiple" data-maximum-selection-length="1" class="select2" data-placeholder="Séléctionner..." >
						  @foreach($examensradio as $examenradio)
				      <option value="{{ $examenradio->id }}">
				        {{ $examenradio->nom }}
				      </option>
				      @endforeach
						</select>
        	</div>
        </div>
        <div class="row">
        	<div class="col-sm-12">
        		<label for="infos"><b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</b></label>
        		<div class="imgsEx">
	        		@foreach($examens as $examen)
					      <div class="col-xs-2">
					        <div class="checkbox">
						        <label>
						         	<input name="exmns" type="checkbox" class="ace" value="{{ $examen->id }}" />
						         	<span class="lbl">{{ $examen->nom }}</span>
						        </label>
					        </div>
					      </div>
				      @endforeach
        		</div>
        	</div>
        </div><!-- row -->
        <div class="row">
        	<div class= "widget-box widget-color-blue" id="widget-box-2 col-xs-12">
            <div class="widget-header" >
						  <h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Examens Imagerie</b></font></h5>
						  <div class="widget-toolbar widget-toolbar-light no-border" width="20%">
						    <div class="fa fa-plus-circle"></div>
								<a href="#" id="btn-addImgExam" name="btn-add" class="btn-xs tooltip-link disabledElem"><h4><strong>Ajouter</strong></h4></a>
							</div>
						</div><!-- widget-header -->
						<div class="widget-body" id ="">
							<div class="widget-main no-padding">
								<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="ants-tab">
								  <thead class="thin-border-bottom">
								   	<tr>
	                  	<th class ="hidden"></th>
										  <th class ="center"><strong>Examen du </strong></th>
										  <th class ="center"><strong>Type Examen</strong></th>
										  <th class="nsort" class ="center"><em class="fa fa-cog"></em></th>
									  </tr>
								  </thead>
								  <tbody id="ExamsImg">
								       	
								  </tbody>
								</table>
							</div>
						</div>
          </div>
				</div>
      </div> 	<!-- widget-main -->
    </div><!-- widget-body -->
 	</div>	<!-- widget-container-col -->
</div><!-- row -->