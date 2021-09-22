<div id="ExamCompl" class="tabpanel">
<div class="row">
	<ul  class="nav nav-pills nav-justified navbar-custom2 list-group" id ="compl">
		<li role= "presentation" class="active" data-interest = "0">
	    		<a href="#biologique" aria-controls="biologique" role="tab" data-toggle="tab" class="jumbotron">
	     			<i class="fa fa-2x fa-flask deep-purple-text"></i><span class="bigger-130">Examen Biologique</span>	
	   		 </a>
	 	 </li>
		<li role= "presentation" data-interest = "1">
  			<a href="#radiologique" aria-controls="radiologique" role="tab" data-toggle="tab" class="jumbotron">
  			<span class="medical medical-icon-mri-pet" aria-hidden="true"></span><span class="bigger-130">Examen Radiologique</span>
    	 		</a>
   		</li>
   		<li role= "presentation" data-interest = "2">
     			<a href="#anapath" aria-controls="anapath" role="tab" data-toggle="tab" class="jumbotron">
   			<span class="medical medical-icon-pathology" aria-hidden="true"></span><span class="bigger-130"> Examen Anapath</span>
    			</a>
   		</li>
	</ul>
</div>
<div class="row">
	<div class= "col-md-9 col-sm-9">
		<div class="tab-content" style = "border-style: none;">
	 		<div class="tab-pane active" id="biologique">
	 	{{-- 	@if($bioExam) --}}
	 	@foreach ($specialite->exmsbio as $exbio)
	 	{{$exbio }}
	 	  {{-- 	  	<div class="checkbox col-xs-4">
	 	    	<label>
			<input name="exmsbio[]" type="checkbox" class="ace" value="{{ $exbio }}"  />
	 		    <span class="lbl">{{ App\modeles\examenbiologique::FindOrFail($exbio)->nom }}</span> 
	 		  </label>
	 		  </div> --}}
	 		@endforeach
	 		{{-- @endif --}}
	 		</div>
	 		</div>
	 		</div>
	 		</div>
</div>