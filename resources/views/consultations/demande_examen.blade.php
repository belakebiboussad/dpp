@extends('app_med')
@section('main-content')
<div class="page-header">
	<h1><strong>DEMANDE EXAMEN / CERTIFICAT :</strong></h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Patient :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<label class="inline">
						<span class="blue"><strong>Nom :</strong></span>
						<span class="lbl"> {{ $patient->Nom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Prénom :</strong></span>
						<span class="lbl"> {{ $patient->Prenom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Sexe :</strong></span>
						<span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Date Naissance :</strong></span>
						<span class="lbl"> {{ $patient->Dat_Naissance }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Age :</strong></span>
						<span class="lbl"> {{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">INFO DEMANDE :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<form>
						<div class="col-sm-12">
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#home">
											<i class="red ace-icon fa fa-file-pdf-o bigger-120"></i>
											Examen Biologique
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#messages">
											<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
											Examen Radiologique
										</a>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" class="dropdown-toggle" href="#">
											Examen anapath &nbsp;
											<i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
										</a>
										<ul class="dropdown-menu dropdown-info">
											<li>
												<a data-toggle="tab" href="#dropdown1">@fat</a>
											</li>
											<li>
												<a data-toggle="tab" href="#dropdown2">@mdo</a>
											</li>
										</ul>
									</li>
								</ul>
								<div class="tab-content">
									<div id="home" class="tab-pane fade in active">
										<div class="row">
											<div class="col-sm-12">
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input id="ex1" name="ex1" value="Groupe sanguin" type="checkbox" class="ace" />
															<span class="lbl"> Groupe sanguin</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex2" value="Taux de prothrombine (TP)" type="checkbox" class="ace" />
															<span class="lbl"> Taux de prothrombine (TP)</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex3" value="FNS avec équilibre leucocytaire" type="checkbox" class="ace"/>
															<span class="lbl"> FNS avec équilibre leucocytaire</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex4" value="TCK-INR" type="checkbox" class="ace"/>
															<span class="lbl"> TCK-INR</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex5" value="Glycémie à jeun" type="checkbox" class="ace" />
															<span class="lbl"> Glycémie à jeun</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex6" value="VS, CRP, Fibrinogéne" type="checkbox" class="ace" />
															<span class="lbl"> VS, CRP, Fibrinogéne</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex7" value="Hémoglobine glyquée (HbA1c)" type="checkbox" class="ace" />
															<span class="lbl"> Hémoglobine glyquée (HbA1c)</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex8" value="Fer sérique" type="checkbox" class="ace" />
															<span class="lbl"> Fer sérique</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex9" value="Cholestérol total" type="checkbox" class="ace" />
															<span class="lbl"> Cholestérol total</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex10" value="Natrémie (Na+)" type="checkbox" class="ace" />
															<span class="lbl"> Natrémie (Na+)</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex11" value="HDL Cholestérol" type="checkbox" class="ace" />
															<span class="lbl"> HDL Cholestérol</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex12" value="Kaliémie (K+)" type="checkbox" class="ace"/>
															<span class="lbl"> Kaliémie (K+)</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex13" value="LDL Cholestérol" type="checkbox" class="ace" />
															<span class="lbl"> LDL Cholestérol</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex14" value="Calcémie" type="checkbox" class="ace"/>
															<span class="lbl"> Calcémie</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex15" value="Trglycérides" type="checkbox" class="ace" />
															<span class="lbl"> Trglycérides</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex16" value="Phosphorémie" type="checkbox" class="ace"/>
															<span class="lbl"> Phosphorémie</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex17" value="Urée sanguine" type="checkbox" class="ace" />
															<span class="lbl"> Urée sanguine</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex18" value="Magnésémie" type="checkbox" class="ace" />
															<span class="lbl"> Magnésémie</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex19" value="Créatinine" type="checkbox" class="ace" />
															<span class="lbl"> Créatinine</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex20" value="ECBU" type="checkbox" class="ace"/>
															<span class="lbl"> ECBU</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex21" value="Acide urique" type="checkbox" class="ace" />
															<span class="lbl"> Acide urique</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex22" value="Chimie des urines" type="checkbox" class="ace" />
															<span class="lbl"> Chimie des urines</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex23" value="Bilirubine : Total-conjuguée-libre" type="checkbox" class="ace" />
															<span class="lbl"> Bilirubine : Total-conjuguée-libre</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex24" value="Proténinurie des 24H" type="checkbox" class="ace" />
															<span class="lbl"> Proténinurie des 24H</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex25" value="Transaminases (ASAT, ALAT)" type="checkbox" class="ace" />
															<span class="lbl"> Transaminases (ASAT, ALAT)</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex26" value="Microalbuminurie" type="checkbox" class="ace" />
															<span class="lbl"> Microalbuminurie</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex27" value="CPK" type="checkbox" class="ace"/>
															<span class="lbl"> CPK</span>
														</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox">
														<label>
															<input name="ex28" value="Phosphatases alcalines" type="checkbox" class="ace" />
															<span class="lbl"> Phosphatases alcalines</span>
														</label>
													</div>
												</div>
												<div class="col-sm-12">
													<label for="form-field-8">
														<strong>Autre</strong>
													</label>
													<input type="text" id="autr" name="tags" id="fo" data-role="tagsinput" placeholder="Aure..." />
												</div>
												<div class="center">
														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dexbio" onclick="createexbio('{{$patient->Nom}}','{{$patient->Prenom}}')">Valider</button>
												</div>
											</div>
										</div>
									</div>
									<div id="messages" class="tab-pane fade">
										<div class="row">
											<div class="col-sm-12">
												<div>
													<label for="icp">
														<strong>Informations cliniques pertinentes</strong>
													</label>
													<textarea class="form-control" id="icp" name="icp" placeholder="Informations cliniques pertinentes"></textarea>
												</div>
												<br/>
												<div>
													<label for="edd">
														<strong>Explication de la demande de diagnostic</strong>
													</label>
													<textarea class="form-control" id="edd" name="edd" placeholder="Explication de la demande de diagnostic"></textarea>
												</div>
												<h4 class="header smaller lighter blue">
													Informations supplémentaires pertinentes
												</h4>
												<div class="col-sm-3">
													<label>
														<input name="insp1" value="Allergie" type="checkbox" class="ace" />
														<span class="lbl"> Allergie</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label>
														<input name="insp2" value="Diabète" type="checkbox" class="ace" />
														<span class="lbl"> Diabète</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label>
														<input name="insp3" value="Insuffisance rénale" type="checkbox" class="ace" />
														<span class="lbl"> Insuffisance rénale</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label>
														<input name="insp4" value="Grossesse" type="checkbox" class="ace" />
														<span class="lbl"> Grossesse</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label>
														<input name="insp5" value="Implant" type="checkbox" class="ace" />
														<span class="lbl"> Implant</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label for="form-field-8">
														Autre												
													</label>
													<input type="text" name="tags" id="fo" data-role="tagsinput" placeholder="Autre..." />
												</div>
												<br/><br/>
												<div class="col-sm-12">
													<label for="edd">
														<strong>Examen(s) proposé(s)</strong>
													</label>
													<textarea class="form-control" id="edd" name="edd" placeholder="Explication de la demande de diagnostic"></textarea>
												</div>
												<br/><br/><br/><br/><br/><br/>
												<h4 class="header smaller lighter blue">
													Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic
												</h4>
												<div class="col-sm-3">
													<label>
														<input name="insp1" value="Allergie" type="checkbox" class="ace" />
														<span class="lbl"> CT</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label>
														<input name="insp2" value="Allergie" type="checkbox" class="ace" />
														<span class="lbl"> RMN</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label>
														<input name="insp3" value="Allergie" type="checkbox" class="ace" />
														<span class="lbl"> RX</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label>
														<input name="insp4" value="Allergie" type="checkbox" class="ace" />
														<span class="lbl"> Echographie</span>
													</label>
												</div>
												<div class="col-sm-3">
													<label for="form-field-8">
														Autre												
													</label>
													<input type="text" name="tags2" id="fo2" data-role="tagsinput" placeholder="Autre..." />
												</div>
											</div>
										</div>
									</div>
									<div id="dropdown1" class="tab-pane fade">
										<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
									</div>
									<div id="dropdown2" class="tab-pane fade">
										<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>
									</div>
								</div>
							</div>
						</div>
						<br/><br/><br/><br/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="dexbio" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Demande Examen Biologique :</h4>
			</div>
			<div class="modal-body">
				<iframe id="exbiopdf" class="preview-pane" type="application/pdf" width="100%" height="500" frameborder="0" style="position:relative;z-index:999"></iframe>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection