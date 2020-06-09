@extends('app_dele')
@section('main-content')
<?php  $id=$colloques[0]->id; ?>
<form id="detail_coll" class="form-horizontal" role="form" method="POST" action="{{route('colloque.update',$id)}}">
	{{ csrf_field() }}{{ method_field('PUT') }}
<div class="col-xs-12 page-header">
	<div class="col-xs-12">
		<h1>			
			Déroulement du Colloque de la semaine du <?php 
				$d=$colloques[0]->date_colloque.' monday next week';
			 
							echo(date('d M Y',strtotime($d)-1));
								?>
		</h1>
	</div>
</div><!-- /.page-header -->
<div class="col-xs-12">
	<select id="demh" multiple="multiple" name="demh[]" hidden="">
	</select>
	<select id="medt" multiple="multiple" name="medt[]" hidden="">
	</select>
	<select id="prio" multiple="multiple" name="prio[]" hidden="">
	</select>
	<select id="observation" multiple="multiple" name="observation[]" hidden="">
	</select>
	<div class="col-md-offset-9 col-md-9">
		<button class="btn btn-info" type="submit" >
			<i class="ace-icon fa fa-check bigger-110"></i>
				    Valider
		</button>
				&nbsp; &nbsp; &nbsp; &nbsp;
		<button class="btn" type="reset">
			<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
		</button>
	</div>
</div>		
<div class="col-xs-12 widget-container-col" id="widget-container-col-1"><br/>
	<div class="col-xs-7 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste Des demandes d'hospitalisation :
				</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class='table_borderWrap'>
						<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
							<thead class="thin-border-bottom">
								<tr>
									<th style="display: none;"></th>
									<th class="center">
										<label class="pos-rel">
											<input type="checkbox" class="ace" />
											<span class="lbl"></span>
										</label>
									</th>
									<!--<th class="detail-col">Details</th>-->
									<th class="detail-col">Patient</th>
									<th>Motif De La Demande</th>
									<th>Degré/date</th>
									<th>Medcin traitant</th>
									<th>Ordre de priorité</th>
									<th>Observ ation</th>
								</tr>
							</thead>
							<tbody>
								@foreach( $demandes as $i=>$demande)
								@if($demande->etat == "En attente")
								<tr>
									<td style="display: none;">{{$demande->id}}</td>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" class="ace" />
											<span class="lbl"></span>
										</label>
									</td>
									<td><div class="action-buttons">
											<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
												<i class="ace-icon fa fa-angle-double-down"></i>
												<span class="sr-only">Details</span>
											</a> {{ $demande->Nom}} {{$demande->Prenom}}</div></td>
									<!--<td>{{ $demande->Nom }} {{$demande->Prenom }}</td>-->
									<td>{{$demande->motif}}</td>
									<td>@if($demande->degree_urgence == 'Haut')
										<span class="label label-sm label-danger"style="color: black;">
											<strong>H</strong>
										</span>
										@elseif($demande->degree_urgence == 'Moyen')
										<span class="label label-sm label-warning"style="color: black;">
											<strong>M</strong>
										</span>
										@else
										<span class="label label-sm label-success"style="color: black;">
											<strong>F</strong>
										</span>
										@endif <br/>{{$demande->Date_demande}}</td>
									<td><select id="MedT" data-placeholder="selectionnez le medecin traitant..."
									class="selectpicker show-menu-arrow place_holder " style=" width: 60px"><option value="" selected disabled>selectionnez le medecin traitant..."</option>@foreach ($medecins as $medecin)<option value="{{$medecin->id}}" >{{$medecin->Nom_Employe}} {{$medecin->Prenom_Employe}}</option>@endforeach</select></td>
									<td><div class="btn-group" data-toggle="radio">
										<label class="btn btn-default">
											<input type="radio" id="{{$i}}p1" name="prop{{$i}}" value="1" />1</label><label class="btn btn-default"><input type="radio" id="{{$i}}p2" name="prop{{$i}}" value="2" />2</label><label class="btn btn-default"><input type="radio" id="{{$i}}p3" name="prop{{$i}}" value="3" />3</label></div></td>
									<td><textarea class="width-100" resize="none"></textarea></td>

								</tr>
								<tr class="detail-row">
									<td colspan="8">
										<div class="table-detail">
											<div class="row">
												<div class="col-xs-7 col-sm-7">
													<div class="space visible-xs"></div>
													<div class="profile-user-info profile-user-info-striped">
														<div class="profile-info-row">
															<div class="profile-info-name"> Patient </div>
															<div class="profile-info-value">
																<span>{{ $demande->Nom}} {{$demande->Prenom}}</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Age</div>
															<div class="profile-info-value">
																<span>{{Jenssegers\Date\Date::parse($demande->Dat_Naissance)->age }} ans</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">Service </div>
															<div class="profile-info-value">
																<span>{{$demande->service}}</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">  	Specialité </div>
															<div class="profile-info-value">
																<span>{{$demande-> 	specialite}}</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">Motif</div>
															<div class="profile-info-value">
																<span>{{$demande->motif}}</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Date de demande</div>
															<div class="profile-info-value">
																<span>{{ App\modeles\consultation::where("id",$demande->id_consultation)->get()->first()->Date_Consultation  }}</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">  	Degree d'urgence</div>
															<div class="profile-info-value">
																<span>@if($demande->degree_urgence == 'Haut')
																	<span class="label label-sm label-danger"style="color: black;"><strong>H</strong>
																	</span>
																	@elseif($demande->degree_urgence == 'Moyen')
																	<span class="label label-sm label-warning"style="color: black;"><strong>M</strong>
																	</span>
																	@else
																	<span class="label label-sm label-success"style="color: black;"><strong>F</strong>
																	</span>
																@endif</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">  	Etablie par Dr</div>
															<div class="profile-info-value">
																<span>{{$demande->Nom_Employe}} {{$demande->Prenom_Employe}}</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xs-5 col-sm-5">
													<div class="space visible-xs"></div>
													<h4 class="header blue lighter less-margin">Description</h4>
													<div class="space-6"></div>
													<form>
														<fieldset>
															<textarea class="width-100" resize="none" readonly>{{$demande->description}}</textarea>
														</fieldset>
													</form>
												</div>							
											</div>
										</div>
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-2 widget-container-col" id="widget-container-col-3" >
		<div class="hidden-sm hidden-xs action-buttons">
			      @for ($i = 0; $i < 10; $i++)
                  <br/>
                  @endfor
			<a class="blue" href="#" onclick="suppligne();">
				<i class="ace-icon fa fa-arrow-left bigger-300"></i>
			</a>
			<a class="blue" href="#" onclick="ajouterligne();" >
				<i class="ace-icon fa fa-arrow-right bigger-300"></i>
			</a>
		</div>
		
	</div>
	<div class="col-xs-3 widget-container-col" id="widget-container-col-4">
		<div class="widget-box widget-color-blue" id="widget-box-4">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste des hopitalisations à programmer cette semaine
				</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class='table_borderWrap'>
						<table class="table table-striped table-bordered table-hover" id="table2" aria-describedby="table2_info" role="grid">
							<thead class="thin-border-bottom">
								<tr >
									<th style="display: none;"></th>
									<th class="center">
										<label class="pos-rel">
											<input type="checkbox" class="ace" />
											<span class="lbl"></span>
										</label>
									</th>
									<!--<th class="detail-col">Details</th>-->
									<th>Patient</th>
									<th>Medecin traitant</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>





		
@endsection