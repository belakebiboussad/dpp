<div class="row">
	<div class="col-sm-12 widget-container-col ui-sortable">
		<div class="widget-box transparent ui-sortable-handle">
		<div class="widget-header">
		<div class="widget-toolbar no-border">
			<ul class="nav nav-tabs" id="myTab2">
			@foreach($specialites as $specialiteB)
			<li  @if ($loop->first) class="active" @endif>
      	<a data-toggle="tab" href="#{{ $specialiteB->id }}"><b>{{ $specialiteB->nom }}</b></a>
			</li>
			@endforeach
			</ul>
		</div>
		</div>{{-- header --}}
		<div class="widget-body">
		<div class="widget-main padding-12 no-padding-left no-padding-right">
		<div class="tab-content examsBio">
			@foreach($specialites as $specialiteB)
				<div id="{{ $specialiteB->id }}" class="tab-pane @if ($loop->first) in active @endif">
				<div class="row">
		   	@foreach($specialiteB->examensbio as $exbio)
		    <div class="col-xs-2">
		    <div class="checkbox">
           <label>
          <input name="exmsbio[]" type="checkbox" class="ace" value="{{ $exbio->id }}" {{ (in_array($exbio->id, $specialite->BioExams()->pluck('id')->toArray()))? 'checked' : '' }}/><span class="lbl">{{ $exbio->nom }} </span> 
          </label>
        </div>       
		    </div>
		    @endforeach
		    </div>
				</div>
			@endforeach
		</div>
		</div>
		</div>
		</div>
	</div>
</div>