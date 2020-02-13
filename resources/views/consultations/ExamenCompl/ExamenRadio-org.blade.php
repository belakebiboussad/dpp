<div class="row">
	<div class="space-12"></div>
	<div class="col-xs-9">
		<div class="space-12"></div>
		<label for="infclinpert">
			 {{-- <span class="badge"><strong>Informations cliniques pertinentes:</strong></span> --}}
			 <h3>Example Informations cliniques pertinentes:</h3>
		</label>
		<div class="space-12"></div>
		 <textarea class="form-control" id="infclinpert" name="infclinpert" placeholder="Informations cliniques pertinentes"></textarea>
	</div>
	
	<div class="col-xs-9">
		<div class="space-12"></div>
		<label for="expdemdiag" >
			{{-- <strong>Explication de la demande de diagnostic:</strong> --}}
			<h3>Explication de la demande de diagnostic:</h3>
			<br><br>
		</label>
		<textarea class="form-control" id="expdemdiag" name="expdemdiag" placeholder="Explication de la demande de diagnostic"></textarea>
		<div class="space-9"></div>
	</div> 
	<div class="col-xs-9">
		<div class="space-12"></div>
		 <h3 class="header smaller lighter blue">
				Informations supplémentaires pertinentes
				<div class="space-12"></div>
		</h3>
		<div class="space-9"></div>
		<br><br>
		<div class="row">
			<div class="col-sm-3">
				
				<label>
					<input name="Allergie" value="Allergie" type="checkbox" class="ace input-lg"/>
					<span class="lbl">Allergie</span>
				</label>
				
			</div>
			<div class="col-sm-3">
				<label>
					<input name="Diabete" value="Diabète" type="checkbox" class="ace input-lg"/>
					<span class="lbl">Diabète</span>
				</label>
			</div>
			<div class="col-sm-4">
				<label>
					<input name="insufRenale" value="Insuffisance rénale" type="checkbox" class="ace input-lg"/>
					<span class="lbl">Insuffisance rénale</span>
				</label>
			</div>
		</div>
		
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-3">
				<label>
					<input name="grossesse" value="Grossesse" type="checkbox" class="ace input-lg"/>
					<span class="lbl"> Grossesse</span>
				</label>
			</div>
			<div class="col-sm-2">
				<label>
					<input name="implant" value="Implant" type="checkbox" class="ace input-lg"/>
					<span class="lbl">Implant</span>
				</label>
			</div>
		</div>
		<div class="space-12"></div><br><br>
		<div class="col-sm-3">
			<label for="form-field-8">
				Autre						
			</label>
			<input type="text" name="autrepatho" id="autrepatho" data-role="tagsinput" placeholder="Autre..." />
		</div>
		<div class="space-12"></div>
	</div>
	<div class="col-sm-9">
		<div class="space-12"></div>
		<label for="edd">
			<h3>Examen(s) proposé(s)</h3>
		</label>
			<textarea class="form-control" id="edd" name="edd" placeholder="Explication de la demande de diagnostic"></textarea>
	</div>
	<div class="row">	
		<input type="text" name="" id ="selectedoption" value="qscc" placeholder="" hidden>
	</div>
	<div class="col-sm-9">
		<div class="space-12"></div>
		<h4 class="header smaller lighter blue">
		Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic
		</h4>
	</div>
	<div class="col-xs-12">
		<div class="row">
			<div class="col-sm-6">
				<label>
					<div class="space-12"></div>
					<input  type="radio" id ="RX" name="imagerie[]"  value="RX"  class="ace input-lg" onchange = "Shows('RX')" />
					<span class="lbl">&nbsp;Radio Standard (RX)</span>
				</label>
				<div class="space-2"></div>
		            	<div class="btn-group hidden" id ="multiselectRX" >
					<button type="button" class="multiselect dropdown-toggle btn btn-white btn-primary" data-toggle="dropdown"aria-expanded="false">selectionner <b class="caret"></b>
					</button>
					<ul class="multiselect-container dropdown-menu">
					          	<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" name=examRad[RX][] value="8" class ="imgExam" data-checkbox-text="Radio du thorax"/>Thorax
						           </label>
						           </a>
					           </li>
					           <li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" name=examRad[RX][] value="9" class ="imgExam" data-checkbox-text="Radio du l'abdomen"/>Abdomen
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox"  name=examRad[RX][] value="10" class ="imgExam" data-checkbox-text="Radio du rachis lombaire"/>Rachis Lombaire
						          </label>
						          </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						            <input type="checkbox" name="examRad[RX][]" value="11" class ="imgExam" data-checkbox-text="Radio du bassin"/>Bassin
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" name="examRad[RX][]" value="12" class ="imgExam" data-checkbox-text="Radio du la hanche"/>Hanche
						           </label>
						           </a>
						</li>
						<li>
						           <div class="col-sm-12">
							<input type="text" name="examRad[AutRX][]" id="examRadAutr" data-role="tagsinput" placeholder="Autre Radio..." />
							</div>
						</li>
					</ul>
			      	</div>
			</div>	
			<div class="col-sm-6">
				<label>
					<div class="space-12"></div>
					<input    type="radio" name="imagerie[]"
						onchange = "Shows('Echographie')" class="ace input-lg"/>
					<span class="lbl">&nbsp; Echographie</span>
				</label>
				<div class="space-2"></div>
		   		<div class="btn-group hidden" id ="multiselectEchographie" >
					<button type="button" class="multiselect dropdown-toggle btn btn-white btn-primary" data-toggle="dropdown" title="cervicale , mammaire, musculo-tendineuse,D,Autre" aria-expanded="false">selectionner <b class="caret"></b>
				           </button>
				           <ul class="multiselect-container dropdown-menu">
				             	<li>
						           <a href="javascript:void(0);">
					              	<label class="checkbox">
				              	  	<input type="checkbox" name="examRad[ECHO][]" value="23" class ="imgExam" data-checkbox-text="Echographie cervicale"/>Cervicale
						           </label>
						           </a>
				              	</li>
				              	<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" name="examRad[ECHO][]" value="24" class ="imgExam" data-checkbox-text="Echographie mammaire"/>Mammaire
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
					             	<label class="checkbox">
					             	<input type="checkbox" name="examRad[ECHO][]" value="25" class ="imgExam" data-checkbox-text="Echographie musculo-tendineuse"/>Musculo-tendineuse
					             	</label>
						           </a>
						</li>
						<li>
						         	<a href="javascript:void(0);">
					             	<label class="checkbox">
					             	<input type="checkbox" name="examRad[ECHO][]" value="26" class ="imgExam" data-checkbox-text="Echographie thyroïdienne"/>Thyroïdienne
					             		</label>
						             	</a>
						</li>
						<li>
						          	<a href="javascript:void(0);">
						          		<label class="checkbox">
						          		<input type="checkbox" name="examRad[ECHO][]" value="27" class ="imgExam" data-checkbox-text="Echographie abdominales"/> Abdominales
						           	</label>
						           </a>
						</li>
						<li>
						          	{{-- <a href="javascript:void(0);">
						          		<label class="checkbox">
						           	<input type="checkbox" value="other"> Autre</label>
						           </a> --}}
						           <div class="col-sm-12">
							<input type="text" name="examRad[AutECHO][]" id="examRadAutECHO" data-role="tagsinput" placeholder="Autre Echographe..." />
							</div>
						</li>
					</ul>
			       	</div>
			</div>	
		</div>
		<div class="space-12"></div>	
		<div class="row">
			<div class="col-sm-6">
				<label>
					<input type="radio" id = "CT"  name="imagerie[]" value=""  class="ace input-lg" onchange = "Shows('CT')"/>
					<span class="lbl">&nbsp;Scanner</span>				
				</label>
				<div class="space-2"></div>
		            	<div class="btn-group hidden" id ="multiselect" >
					<button type="button" class="multiselect dropdown-toggle btn btn-white btn-primary" data-toggle="dropdown" title="cardiaquee , rein, vessie,genaux,tete,Autre" aria-expanded="false">selectionner <b class="caret"></b>
					</button>
					<ul class="multiselect-container dropdown-menu scroll-menu scroll-menu-2x">
					        	<li >
					           <a href="javascript:void(0);">
					           <label class="checkbox">
					           <input  type="checkbox" name="examRad[CT][]" value="1" class ="imgExam" data-checkbox-text="Scanner encéphalique" />Encéphalique</label>
					           </a>
					          	</li>
					           <li>
						<a href="javascript:void(0);">
						<label class="checkbox">
						<input type="checkbox" name="examRad[CT][]" value="2" class ="imgExam" data-checkbox-text="Scanner  ORL" />ORL</label>
						</a>
						</li>
						<li>
						<a href="javascript:void(0);">
						<label class="checkbox">
						<input type="checkbox" name="examRad[CT][]" value="3" class ="imgExam" data-checkbox-text="Scanner thoracique">Thoracique</label>
						</a>
						</li>
						<li>
						<a href="javascript:void(0);">
						<label class="checkbox">
						<input type="checkbox"  name="examRad[CT][]"value="4" class ="imgExam" data-checkbox-text="Scanner cardiaque"/>Cardiaque</label>
						 </a>
						 </li>
						<li>
						<a href="javascript:void(0);">
						<label class="checkbox">
						<input type="checkbox"  name="examRad[CT][]"value="5" class ="imgExam" data-checkbox-text="Scanner abdominal"/>Abdominal
						</label>
						</a>
						</li>
						<li>
						<a href="javascript:void(0);">
						<label class="checkbox">
						 <input type="checkbox"  name="examRad[CT][]" value="6" class ="imgExam" data-checkbox-text="Scanner pelvien"/>Pelvien
						</label>
						</a>
						</li>
						<li>
						<a href="javascript:void(0);">
						<label class="checkbox">
						 <input type="checkbox" name="examRad[CT][]"value="7" class ="imgExam" data-checkbox-text="Scanner rachidien"/> Rachidien
						</label>
						</a>
						</li>
						<li>
						<div class="col-sm-12" id ="AutreScanner">
							<input type="text" name="examRad[AutCT][]" id="examRadAutCT" data-role="tagsinput" placeholder="Autre Scanner..." />
						</div>
						</li>
					</ul>
			       	</div>
			       		
		        	</div>
			<div class="col-sm-6">
				<label id="target">
					<input  type="radio" id="RMN" name="imagerie[]" value="RMN"  class="ace input-lg"  onchange =Shows('RMN') />
					<span class="lbl">&nbsp; RMN</span>
				</label>
				<div class="space-2"></div>
		                     	<div class="btn-group hidden" id ="multiselectRMN" >
				           <button type="button" class="multiselect dropdown-toggle btn btn-white btn-primary" data-toggle="dropdown" title="Autre" aria-expanded="false">selectionner <b class="caret"></b>
				           </button>
				           <ul class="multiselect-container dropdown-menu">
				             	<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" value="13" name="examRad[RMN][]" class ="imgExam" data-checkbox-text="IRM du Rachis cervical">Rachis cervical
						           </label>
						           </a>
					           </li>
					           <li>
						           <a href="javascript:void(0);">
							<label class="checkbox">
						           <input type="checkbox" value="14" name="examRad[RMN][]" class ="imgExam" data-checkbox-text="IRM du Rachis lombaire"/>Rachis lombaire
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" value="15" name="examRad[RMN][]" class ="imgExam" data-checkbox-text="IRM du Rachis dorsal"/> Rachis dorsal
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" value="16" name="examRad[RMN][]" class ="imgExam" data-checkbox-text="IRM du Genou"/>Genou
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" value="17" name="examRad[RMN][]" class ="imgExam" data-checkbox-text="IRM du la Cheville"/>Cheville
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" value="18" name="examRad[RMN][]" class ="imgExam" data-checkbox-text="IRM du Coude"/>Coude
						           </label>
						           </a>
						</li>
						<li >
						           <a href="javascript:void(0);">
						           <label class="checkbox">
						           <input type="checkbox" value="19" name="examRad[RMN][]" class ="imgExam" data-checkbox-text="IRM Cérébral"/>Cérébral
						           </label>
						           </a>
						</li>
						<li>
						           <a href="javascript:void(0);">
						             	<label class="checkbox">
						             	<input type="checkbox" name="examRad[RMN][]" value="20" class ="imgExam" data-checkbox-text="IRM d'ORL"/>ORL
						             	</label>
						             	</a>
						</li>
						<li>
						          	<a href="javascript:void(0);">
						             	<label class="checkbox">
						             	<input type="checkbox" name="examRad[RMN][]" value="21" class ="imgExam" data-checkbox-text="IRM Abdominal"/>Abdominal
						             	</label>
						           </a>
						</li>
						<li>
						         	<a href="javascript:void(0);">
						             	<label class="checkbox">
						             	<input type="checkbox" name="examRad[RMN][]" value="22" class ="imgExam" data-checkbox-text=" IRM du Pelvien"/>Pelvien
						             	</label>
						          	</a>
						</li>					          
						<li>
						<div class="col-sm-12">
						<input type="text" name="examRad[AutRMN][]" id="examRadAutRMN" data-role="tagsinput" placeholder="Autre IRM..." />
						</div>
						</li>
					</ul>
			       	</div>
			</div>
		</div>	{{-- end row --}}
		<div class="space-12"></div>

		</div>
		
	<br>	
</div>
<div class="space-12"></div>

