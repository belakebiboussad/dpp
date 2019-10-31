<!--model pop-up -->
<div id="{{$admission->id_admission}}" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">confirmer l'entrée du patient:</h4>
				</div>
				<div class="modal-body">
					<p><span  style="color: blue;"><strong >{{ $admission->Nom }} {{$admission->Prenom }}</strong></span></p>
					<p>le  &quot;<span  style="color: orange;"><strong>{{ $admission->date_RDVh }}</strong></span>&quot; à <span  style="color: red;"><strong>{{Date("H:i:s")}}</strong></span></p>			
				</div>
			  <form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="{{route('hospitalisation.store')}}">{{ csrf_field() }}
			    	<input id="id_ad" type="text" name="id_ad" value="{{$admission->id_admission}}" hidden>
			    	<input id="id_RDV" type="text" name="id_RDV" value="{{$admission->idRDV}}" hidden>
			    	<div class="modal-footer">
			    			<button type="button" class="btn btn-default" data-dismiss="modal">
			      			 <i class="ace-icon fa fa-undo bigger-120"></i>
			        								Fermer
			        							</button>
			        							<button  type="submit" class="btn btn-success" >
			        								  <i class="ace-icon fa fa-check bigger-120"></i>
			        								Valider
			        							</button>
			      							</div> 
			      							</form>
			   							 </div>
			  							</div>
										</div>		