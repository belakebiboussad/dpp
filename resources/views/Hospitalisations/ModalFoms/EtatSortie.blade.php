<div id="EtatSortie" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
	  	<div class="modal-header">
	    		<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Générer un document patient</h4>
	  	</div>
	  	<div class="modal-body">
	  		<input type="hidden" id="hospID" value="">
	  		<div class="row"> <div class="col-xs-12"><h4 class="header blue bolder smaller">Sélectionner Le document </h4></div></div>
				<div class="hr hr-dotted"></div>
				<div style="width:100%;">
			    <div id = "parent">         
			     <ol class="rounded-list btn-group btn-group-vertical" role="group">
				  	@foreach($etatsortie as $etat)
				  		<li class="btn-group" role="group" style="padding-top: 5px">{{-- href="docStatePrint/{{$etat->id}}" target="_blank" --}}
				  		<br/>
				  		@switch($etat->id)
				  			@case (1)
				  				<button type="button" id="selctetat" class="btn btn-primary btn-lg"><strong>{{ $etat->titre}}</strong></button>
				  				@break
				  			@case (2)
				  				<button type="button" id="selctetat" class="btn btn-success btn-lg" width="100%"><strong>{{ $etat->titre}}</strong></button> 
				  				@break
				  			@case (3)
				  				<button type="button" id="selctetat" class="btn btn-info btn-lg"><strong>{{ $etat->titre}}</strong></button> 
				  				@break
				  			@case (4)
				  				<button type="button" id="selctetat" class="btn btn-danger btn-lg"><strong>{{ $etat->titre}}</strong></button> 
				  				@break
				  		@endswitch
		        	</li>
 {{-- <button id="selctetat" class ="btn btn-primary btn-lg" value ="{{ $etat->titre}}">{{ $etat->titre}}</button>
  --}}    	  		  @endforeach 
					  </ol>
					</div> 
			</div>   
	  	</div>
	  	<div class="modal-footer">
	  		<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
			</div>
		</div>
	</div>
</div>	  