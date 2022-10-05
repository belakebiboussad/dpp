<div class="row">
  <div class="col-sm-12">
	<div class="col-sm-5 col-xs-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Consultations</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a href="/consultations/create/{{ $patient->id }}" class="align-middle">
          <i class="fa fa-plus-circle bigger-180"></i></a>
      </div>
		</div><!-- widget-header -->
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="display table-responsive tablist" id=""> <!-- consultList -->
					<thead >
						<tr>
							<th class="center" width="12%">Date</th>	
							<th class ="center sorting_disabled" width="30%">Médecin Consultant</th>
              <th class ="center sorting_disabled">Motif</th>
							<th class ="center sorting_disabled" width="14%"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($patient->Consultations as $consult)
					<tr id ="{{ $consult->id }}">
					   <td width="12%">{{ \Carbon\Carbon::parse($consult->date)->format('d/m/y') }}</td>
						 <td width="30%">{{ $consult->medecin->full_name }}</td>
             <td><small>{{ $consult->motif }}</small></td>
						<td class="center" width="14%">
              <button class="btn btn-primary btn-xs" onclick="showConsult({{ $consult->id }});"><i class="ace-icon fa fa-eye-slash fa-xs"></i></button>
              <a href = "{{ route('consultations.show',$consult->id)}}" style="cursor:pointer" class="btn btn-success btn-xs" data-toggle="tooltip" title="voir consultation"><i class="ace-icon fa fa-hand-o-up fa-xs fa-2xs"></i></a>
            </td>	
					</tr>
					@endforeach
					</tbody>
			</table>
			</div>
			</div>
		</div>
	</div>
  <div class="vspace-12-sm"></div><div class="col-sm-7 col-xs-12" id="consultDetail"></div>
 </div>
</div>