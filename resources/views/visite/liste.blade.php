<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Visites</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a href="/visite/create/{{ $hosp->id}}"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
			</div>
		</div><!-- widget-header -->
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table id="consultList" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
					<thead class="thin-border-bottom">
						<tr>
							<th class="">Date</th>
							<th class ="center sorting_disabled">Médecin</th>
							<th class ="center sorting_disabled">Actes</th>
							<th class ="center sorting_disabled">Traitements</th>
							<th class ="center sorting_disabled">Examens Biologique</th>
							<th class ="center sorting_disabled">Examens Imageries</th>
							<th class="center sorting_disabled"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					 @foreach($hosp->visites as $visite)
					<tr  role="row" class="even">
						 <td>{{ $visite->date }}</td>
						 <td class ="center sorting_disabled">{{ $visite->medecin->nom }}&nbsp;{{ $visite->medecin->prenom }}</td>
						<td class="text-primary">
						 	@foreach($visite->actes as $acte)
						 		{{ $acte->nom }} <br>
						 	@endforeach
						 </td>
						 <td class="text-primary">
							@foreach($visite->traitements as $trait)
								{{ $trait->medicament->nom }} <br>
							@endforeach
						 </td>
						 <td>
						 @if(isset($visite->demandeexmbio))
							 @foreach($visite->demandeexmbio->examensbios as $index => $exm)
							 	{{ $exm->nom }}
							 	@if(! $loop->last)  , @endif
							 @endforeach 
						@endif  
						 </td>
						 <td></td>
						<td class="center sorting_disabled"><a href="{{ route('visites.show', $visite->id) }}"><i class="fa fa-eye"></i></a></td>
					</tr>
					@endforeach 
					</tbody>
				</table>
			</div>
		</div><!-- widget-body -->
	</div>
</div>
<div class="col-sm-7" id="consultDetail">

</div>