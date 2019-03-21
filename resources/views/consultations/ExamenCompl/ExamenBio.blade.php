<div class="row">
	<div class="col-sm-12 widget-container-col">
	@foreach($specialitesExamBiolo as $specialite)
          <div class="widget-box transparent" id="widget-box-12">
            	<div class="widget-header">
		          <h4 class="widget-title lighter"> 
		                {{ $specialite->specialite }}
		          </h4>
           	</div>
			<div class="widget-body">
              		<div class="widget-main padding-6 no-padding-left no-padding-right">
               			<div class="space-6"></div>
                  		<div class="row">
                  		@foreach($specialite->examensbio as $exbio)
			                <div class="col-xs-3">
			                     <div class="checkbox">
			                          <label>
			          		                <input name="exm[]" type="checkbox" class="ace" value="{{ $exbio->id }}" />
			               			     <span class="lbl">{{ $exbio->nom_examen }}   </span> 
			                          </label>
			                     </div>
			                </div>
                      @endforeach
                  		</div>{{-- row --}}
                     </div>{{-- widget-main --}}
                </div>	{{-- widget-body --}}
          </div> {{-- widget-box --}}
     @endforeach     
	</div>  {{-- widget-container-col --}}
</div>{{-- row --}}