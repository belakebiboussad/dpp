<div class="row">
	<div class="col-sm-12 widget-container-col">
	@foreach($specialites as $specialite)
          <div class="widget-box transparent" id="widget-box-12">
            	<div class="widget-header">
		          <h4 class="widget-title lighter"> 
		                {{ $specialite->nom }}
		          </h4>
           	</div>
          </div>
     @endforeach     
	</div>  {{-- widget-container-col --}}
</div>{{-- row --}}