<div id="accordion" class="accordion-style1 panel-group " style="margin-right: -1%;">
            <div class="row">
		<div class="col-sm-12">
		<div class="widget-box">
		<div class="widget-header" >
                        		<h4 class="widget-title">
                        			<font color="black"><strong>Interogatoire</strong></font>                        			
                        		</h4>
                        	</div>		
               	<div class="widget-body">
			<div class="widget-main">
			<div class="row">
			<div class="col-xs-12">
				<label for="Motif_Consultation"><strong>Motif de la Consultation :</strong></label>
				<textarea type="text" id="Motif_Consultation" style="width:100%; height: 8%;" readonly >{{ $consultation->Motif_Consultation }}</textarea>
			</div>
			</div>{{-- row	 --}}
			@if(isset($consultation->histoire_maladie))
			<div class="row">
			<div class="col-xs-12">
				<label for="histoire_maladie"><strong>Histoire de la maladie :</strong></label>
				<textarea type="text" id="histoire_maladie" style="width:100%; height: 8%;" readonly >{{ $consultation->histoire_maladie }}</textarea>
			</div>
			</div>
			@endif
			@if(isset($consultation->Diagnostic))
			<div class="row">
				<div class="col-xs-12">
				<label for="Diagnostic"><strong>Diagnostic:</strong></label>
				<textarea type="text" id="Diagnostic" style="width: 100%; height: 8%;" readonly >{{ $consultation->Diagnostic }}</textarea>
				</div>
			</div>
			@endif
			@if(isset($consultation->Resume_OBS))
			<div class="row">
			<div class="col-xs-12">
			<label for="Resume_OBS"><span class="bigger-120"><b>Résumé:</b></span></label><textarea type="text" id="Resume_OBS" style="width: 100%; height: 10%;" readonly >{{ $consultation->Resume_OBS }}</textarea>
			</div>
			</div>
			@endif
			</div>{{-- widget-main--}}
			</div>{{-- widgetbody --}}
			</div>	{{-- widgetbox --}}
	             </div>
	</div>
	<div class="row">
		<div class="col-sm-12 widget-container-col ui-sortable" id ="widget-container-col-11">
		<div class="widget-box transparent ui-sortable-handle" id="widget-box-13">
		<div class="widget-header">
		<h4 class="widget-title lighter">Tabs With Scroll</h4>
		<div class="widget-toolbar no-border">
		<ul class="nav nav-tabs" id="myTab2">
		<li class="">
		<a data-toggle="tab" href="#home2" aria-expanded="false">Examen Clinique</a>
		</li>
		<li class="">
		<a data-toggle="tab" href="#profile2" aria-expanded="false">Examens Radiologique</a>
		</li>
		<li class="active">
		<a data-toggle="tab" href="#info2" aria-expanded="true">Examen Bioloique</a>
		</li>
		</ul>
		</div>
			</div>{{-- header --}}
			</div>{{-- widget-box transparent ui-sortable-handle --}}
		</div>{{-- col-sm-6 widget-container-col ui-sortable --}}
	</div>
	</div>
	