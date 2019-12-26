
 <div class= "widget-box widget-color-blue" id="widget-box-2">
          <div class="widget-header" >
              	<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Antecedants</b></font></h5>
              	<div class="widget-toolbar widget-toolbar-light no-border">
		{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
			<div class="fa fa-plus-circle"></div>
			<a href="#" data-target="#gardeMalade" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter Garde Malade ou Homme de Confiance" >
				<strong>Ajouter un Antecedant</strong>
			</a>
		</div>
            </div>
	<div class="widget-body" id ="ATCDWidget">
	           <div class="widget-main no-padding">
	                      <table class="table nowrap dataTable no-footer" id="ants-tab">
	                              	<thead class="thin-border-bottom">
	                           		 <tr class ="center">
	                           		           <th></th>
			                                 <th>Type</th>
			                                 <th>S/Type</th>
			                                  <th><i class="fa fa-clock-o" aria-hidden="true"></i>Date</th>
			                                  <th class="hidden-480">Description</th>
			                                  <th class="hidden-480"></th>
		                                </tr>
		                      </thead>
				 <tbody>
				 @foreach($antecedants as $antcd)
				 <tr id="{{ 'atcd'.$antcd->id }}">
					              <td >{{ $antcd->Patient_ID_Patient }}</td>
					              <td>{{ $antcd->Antecedant }}</td>
					              <td>{{ $antcd->typeAntecedant }}</td>
					              <td>{{ $antcd->date }}</td>
					              <td>{{ $antcd->descrioption }}</td>
					              <td></td>
			           </tr>
				  @endforeach
				 </tbody>
		           </table>
		 </div>
		   </div>
  </div>
			<!--  {{-- <div class= "col-md-3 col-xs-3"> --}} -->