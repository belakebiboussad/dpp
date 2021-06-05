<div class="col-sm-12 widget-container-col ui-sortable" id="widget-container-col-13">
<div class="widget-box transparent ui-sortable-handle" id="widget-box-13">
<div class="widget-header">
<h4 class="widget-title lighter"></h4>
<div class="widget-toolbar no-border">
	<ul class="nav nav-tabs" id="myTab2">
	@foreach($specialitesExamBiolo as $specialite)
	<li  @if ($loop->first) class="active" @endif>
		<a data-toggle="tab" href="#{{ $specialite->specialite }}"><strong>{{ $specialite->specialite }}</strong></a>
	</li>
	@endforeach
	</ul>
</div>
</div>{{-- header --}}
<div class="widget-body">
<div class="widget-main padding-12 no-padding-left no-padding-right">
<div class="tab-content padding-4">
	<div id="home2" class="tab-pane in active">
	</div>
	@foreach($specialitesExamBiolo as $specialite)
		<div id="{{ $specialite->specialite }}" class="tab-pane @if ($loop->first) in active @endif">
			<div class="row">
    		@foreach($specialite->examensbio as $exbio)
        <div class="col-xs-3">
             <div class="checkbox">
                  <label>
  		                <input name="exm[]" type="checkbox" class="ace" value="{{ $exbio->id }}" />
       			     <span class="lbl">{{ $exbio->nom_examen }} </span> 
                  </label>
             </div>
        </div>
      		  @endforeach
    		</div>{{-- row --}}
		</div>
	@endforeach
</div>
</div>
</div>{{-- widget-body --}}
</div>{{-- widget-box --}}
</div>