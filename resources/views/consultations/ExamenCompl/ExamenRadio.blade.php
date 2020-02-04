<div class="row">
	<div class="col-xs-12">
		 <div class="col-xs-12 widget-container-col" id="consultation">
       	<div class="widget-box" id="infopatient">
          <div class="widget-header">
         	  <h5 class="widget-title"><b>Demande d'un examen radiologique :</b></h5>
          </div>
         	<div class="widget-body">
          	<div class="widget-main">
          		<div class="row">
          			<div class="col-xs-12">
           				<div>
                    <label for="infosc">
				              <b>Informations cliniques pertinentes</b>
				            </label>
				            <textarea class="form-control" id="infosc" name="infosc"></textarea>
				                    	{!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
				          </div>
				        <!--   <br> -->
				          <div>
				            <label for="explication">
				              <b>Explication de la demande de diagnostic</b>
				            </label>
				            <textarea class="form-control" id="explication" name="explication"></textarea>
				              {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
				          </div>
				          <br>
				          <div>
				            <label for="infos">
				              <b>Informations supplémentaires pertinentes</b>
				            </label>
				            <div class="row">
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
			              {!! $errors->first('infos', '<small class="alert-danger"><b>:message</b></small>')!!}
			            </div>
			            <!-- <br> -->
			            <div>
			              <label for="explication"><b>Examen(s) proposé(s)</b></label>
			              <br>
			         			<select id="examensradio" name="examensradio[]" class="select2" multiple="multiple" data-maximum-selection-length="1" data-placeholder="Séléctionner...">
							      @foreach($examensradio as $examenradio)
				              <option value="{{ $examenradio->id }}">
				                {{ $examenradio->nom }}
				              </option>
				            @endforeach
									</select>
				          <!-- / -->
			          	</div>
			          	<!-- <br> -->
			           	<div>
                  	<label for="infos"><b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</b></label>
                    <div class="row">
			                @foreach($examens as $examen)
				              <div class="col-xs-2">
				                <div class="checkbox">
					                <label>
					                 	<input name="exmns[]" type="checkbox" class="ace" value="{{ $examen->id }}" />
					                 	<span class="lbl"> 
					                   	{{ $examen->nom }}
					                 	</span>
					                </label>
				                </div>
				              </div>
			                @endforeach
                    </div>
                  </div>
                  <br>
                  <div class="row">
                  	<div class= "widget-box widget-color-blue" id="widget-box-2 col-xs-12">
                  	  <div class="widget-header" >
										      <h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Actes Médicaux</b></font></h5>
										       	<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
															<div class="fa fa-plus-circle"></div>
															<a href="#" id="btn-add" name="btn-add" class="btn-xs tooltip-link disabledElem" data-toggle="tooltip" data-original-title="Ajouter un Antecedant" >
	 															<h4><strong>Ajouter</strong></h4>
	 														</a>
														</div>
										  </div><!-- widget-header -->
                  	</div>
                  </div>
                </div> {{-- col-sm-12 --}}
              </div>{{-- row --}}
            </div> {{-- widget-main --}}
          </div> {{-- widget-body --}}
			</div>	{{-- widget-box --}}
		</div>{{-- widget-container --}}
	</div>

</div>{{-- row --}}
<div class="space-12"></div>