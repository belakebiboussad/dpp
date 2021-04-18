<div class="row">
	<div class="col-sm-5 col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Consultations</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">{{-- <div class="fa fa-plus-circle"></div> --}}{{-- <b>Consultation </b> --}}
				<a href="/consultations/create/{{$patient->id}}"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
			</div>
		</div><!-- widget-header -->
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table id="consultList" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">Date</th>	
							<th class ="center sorting_disabled">Médecin Traitant</th>
							<th class ="center sorting_disabled">Service</th>
							<th class="center sorting_disabled"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($patient->Consultations as $consult)
					<tr  role="row" class="even">
					      <td>{{$consult->Date_Consultation}}</td>
						<td>{{ $consult->docteur->nom }}{{ $consult->docteur->prenom }}</td>
						<td>{{$consult->docteur->Service->nom}}</td>
						<td>
							<button class="btn btn-primary btn-xs" onclick="showConsult({{ $consult->id }});"><i class="fa fa-hand-o-up"></i></button>		 
						</td>	
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div><!-- widget-body -->
	</div>
	</div><div class="col-sm-7 col-xs-12" id="consultDetail"></div>
</div>