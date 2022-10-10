<div class="row"><div class="col-sm-12">
  <h3 class="header smaller lighter blue">Vaccins</h3></div>
  </div>
<div class="row">
 	<div class= "widget-box widget-color-pink">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
        <font color="black"> <i class="ace-icon fa fa-table"></i>
        &nbsp;<b>Vaccins</b></font></h5>
		 	<div class="widget-toolbar widget-toolbar-light no-border">
				<a id ="vaccAdd" data-target="#vaccinModal" class="btn-xs align-middle" data-toggle="modal"><i class="fa fa-plus-circle bigger-180"></i></a>
			</div>
	 	</div>
	 	<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id ="vaccsTab">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">Nom</th>
						  <th class="center" ><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>
								<strong>Date</strong>
							</th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						{{--
            @foreach($patient->vaccins as $vac)
						<tr id="{{ 'vaccin'.$vac->id }}">
							<td>{{ $vac->nom}}</td>
							<td>{{ $vac->pivot->date}}</td>
							<td class="center">
								<button type="button" class="btn btn-xs btn-info open-modalVacc" value="{{ $vac->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-Vacc" value="{{ $vac->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button> 
							</td>
						</tr>
						@endforeach
            --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">@include('antecedents.ModalFoms.vaccinsModal')</div> 