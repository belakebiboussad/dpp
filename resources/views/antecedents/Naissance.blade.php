<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Etat à la Naissance</h3></div></div>
<div class="row">
	<div class= "widget-box widget-color-pink">
		<div class="widget-header">
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Etats à la Naissance</b></font></h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a id ="condAdd" class="btn-xs align-middle @if(count($exmonth) == 3) hidden @endif" data-toggle="modal" data-target="#condModal">
					<i class="fa fa-plus-circle bigger-180"></i>
				</a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="bcondTab">
					<thead class="thin-border-bottom">
					  <tr>
					  	<th>Mois</th>
					  	<th>Score APGAR</th>
					  	<th>Nombre de Cris</th>
					  	<th>Poids</th>
					  	<th>Taille</th>
					  	<th>Périmètre crânien</th>
					  	<th>Placenta</th>
					  	<th class = "center"><em class="fa fa-cog"></em></th>
					  </tr>
			  	</thead>
			  	<tbody>
			  	  @foreach($patient->birthConditions as $key=>$cond)
			  		<tr id="{{ 'bcond'.$cond->id }}">
			  			<td>{{ $cond->month }}</td>
			  			<td>{{ $cond->apgar }}</td>
			  			<td>
			  				@if($loop->first)
			  					{{ $cond->shoutnbr }}
			  				@else
			  					/
			  				@endif
			  			</td>
			  			<td>{{ $cond->bbWeight }}</td>
			  			<td>{{ $cond->bbHeight }}</td>
			  			<td>{{ $cond->pcran }}</td>
			  			<td>{{ $cond->placenta }}</td>
			  			<td class = "center">
			  				<button type="button" class="btn btn-xs btn-info open-modalBCond" value="{{ $cond->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-BCond" value="{{ $cond->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button> 
			  			</td>
			  		</tr>
			  		@endforeach
			  	</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">@include('antecedents.ModalFoms.birhtCondModal')</div>