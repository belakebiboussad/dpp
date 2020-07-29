<div class="col-xs-5 col-sm-5 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Consultations</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<div class="fa fa-plus-circle"></div>
				<a href="/consultations/create/{{$patient->id}}">
					<b>Consultation </b>
				</a>
			</div>
		</div><!-- widget-header -->
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table id="consultList" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
					<thead class="thin-border-bottom">
						<tr>
							<th class="">Date</th>	
							<th class="sorting_disabled">Motif</th>
							<th class ="center sorting_disabled">Médecin Traitant</th>
							<th class ="center sorting_disabled">Service</th>
							<th class="center sorting_disabled"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($patient->consultations as $consult)
					<tr  role="row" class="even">
					  <td>{{$consult->Date_Consultation}}</td>
						<td>{{ $consult->Motif_Consultation }}</td>
						<td class ="center sorting_disabled">
							<span>{{ $consult->docteur->Nom_Employe }}{{ $consult->docteur->Prenom_Employe }}</span>
						</td>
						<td class="center sorting_disabled">
							<span >{{$consult->docteur->service->nom}}</span>
						</td>
						<td class="center sorting_disabled">
							<button class="btn btn-primary btn-xs" onclick="showConsult({{ $consult->id }},$(this));"> 
									  <i class="fa fa-hand-o-up"></i>
						  </button>		 
						</td>	
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