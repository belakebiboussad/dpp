 <div class= "widget-box widget-color-blue" id="widget-box-2">
    <div class="widget-header" >
      <h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Antecedants</b></font></h5>
       	<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
						{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
					<div class="fa fa-plus-circle"></div><!-- data-target="#antecedantModal" -->
			 		<a href="#"  id="btn-add" name="btn-add" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter Garde Malade ou Homme de Confiance" >
	 					<h4><strong>Antecedant</strong></h4>
	 				</a>
	 			</div>
    </div>
		<div class="widget-body" id ="ATCDWidget">
	     <div class="widget-main no-padding">
	        <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="ants-tab">
	          <thead class="thin-border-bottom">
	            <tr class ="center">
	              <th class ="hidden"></th>
			          <th>Type</th>
			          <th>S/Type</th>
			          <th><i class="fa fa-clock-o" aria-hidden="true"></i>Date</th>
			          <th class="hidden-480">Description</th>
			          <th class="hidden-480 center"><em class="fa fa-cog"></em></th>
		          </tr>
		        </thead>
						<tbody>
						  @foreach($antecedants as $antcd)
						  <tr id="{{ 'atcd'.$antcd->id }}">
							              <td class ="hidden" >{{ $antcd->Patient_ID_Patient }}</td>
							              <td>{{ $antcd->Antecedant }}</td>
							              <td>{{ $antcd->typeAntecedant }}</td>
							              <td>{{ $antcd->date }}</td>
							              <td>{{ $antcd->descrioption }}</td>
							              <td class="center"> 
															<button type="button" class="btn btn-xs btn-info open-modal" value="{{$antcd->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
		                          <button type="button" class="btn btn-xs btn-danger delete-garde" value="{{$antcd->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
							              </td>
					    </tr>
						  @endforeach
						</tbody>
		      </table>
		 </div>
		</div>
  </div>
	<br>
	<br>	
 	<!--  {{-- <div class= "col-md-3 col-xs-3"> --}} -->