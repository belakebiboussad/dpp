<div class="row"   style="margin-top: -12px;">
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main" >
					<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="medc_table" class="table table-striped table-bordered table-hover" width=100%> 
						<thead>
						<tr>
						<th class="center"><strong>Médicament</strong></th>
						<th class="center"><strong>Forme</strong></th>
						<th class="center"><strong>Dosage</strong></th>
						<th class="center">
						<em class="fa fa-cog"></em>
						</th>
						</tr>
						</thead>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="widget-box">
		<div class="widget-body">
		<div class="widget-main"  id = "posologie">
		<div class="row">
			<div  class="col-xs-9">
				 <input type="text" id="id_medicament" name="id_medicament" hidden>
				<label for="nommedic"><strong>Nom Médicament :</strong></label>
				<input id="nommedic" class="form-control" type="text"  placeholder="Médicament" readonly/>
			</div>
			<div  class="col-xs-3">
				<label for="form-field-8">
					<strong>Forme :</strong>	
				</label>
				<input id="forme" class="form-control" type="text"  placeholder="Forme" readonly/>
			</div>
		</div>{{-- row --}}
		<div class="space-12"></div>
		<div class="row">
			  <div class="col-xs-6">
                     		           <label for="dosage">Dosage:</label>
                                	<input type="text" class="form-control" id="dosage" placeholder="Dosage..." readonly>
                            </div>
		</div>
		<div class="space-112"></div>
		<div class="space-12"></div>
                     <div class="row">
	                     	<div class="col-xs-12">
	                                <label for="posologie">Posologie:</label>
	                                {{-- <input type="text" class="form-control" id="posologie" placeholder="Posologie..."> --}}
	                                 <input type="text" class="form-control disabledElem" id="posologie_medic" placeholder="Posologie...">
	                     </div>
                     </div>     
                	<div class="space-12"></div>
                	<div class="space-12"></div>
           	<div class="row">
			<div class="col-xs-12">
				<button type="button" id="addliste" class="btn btn-success pull-right disabledElem" onclick="addmidifun()">
					Ajouter a la liste&nbsp;<i class="fa fa-mail-forward"></i>
				</button>
			</div>
		</div>
		</div>	{{-- widget-main --}}
		</div>	{{-- widget-body --}}
		</div>{{-- "widget-box --}}
	</div>{{-- col-sm-6 --}}
</div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-warning" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title text-info lighter"> Ordonnance:</h5>
			<div class="widget-toolbar widget-toolbar-light no-border pull-right" >
				<button type="button" onclick="supcolonne()" class="btn btn-transparent">
					<i class="ace-icon fa fa-trash-o orange"></i>
				</button>
				<button type="button" class="btn btn-transparent  my-right-float">
					<i class="ace-icon fa fa-pencil green"></i>
				</button>
			</div>
		</div>	{{-- widget-header --}}
		<div class="widget-body">
			<div class="widget-main">
				{{-- <div class="row">
					<div class="col-sm-5">
						<label for="dateord"><strong>Date Ordonnance :&nbsp;</strong></label>
						<input id="dateord" name="dateord" class="date-picker disabledElem" name ="dateord" type="text" data-date-format="yyyy-mm-dd" data-provide="datepicker"  value='<?php echo date("Y-m-d");?>' />
						</div>
						<div class="col-sm-3">
							<label for="dureeefois"><strong>Pendant:&nbsp;</strong></label>
							<input class="" name="dureeefois"  id ="dureeefois" type="number"  value="1" min="1"/>
						</div>
						<div class="col-sm-4">
							<select class="col-sm-6" id="foisss" name="foisss" value="Semaine">
								<option value="Jour" selected>Jour</option>
								<option value="Semaine" selected>Semaine</option>
								<option value="Mois">Mois</option>
							</select>
						</div>		 
				</div> --}}
				{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<table id="ordonnance" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th></th>
								<th hidden>id</th>
								<th>Médicament</th>
								<th>Forme</th>
								<th>Dosage</th>
								<th>Posologie</th>
								{{-- <th style="display:none;"></th> --}}
							</tr>
						</thead>
					</table>
				</div>	{{-- row --}}
				<div class="row">
					<div class="pull-right">
						<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="storeord1()">Enregistrer</button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ord" onclick="createord('{{ $patient->Nom }} {{ $patient->Prenom }}','{{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe}} {{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}}')">
									Imprimer
						</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
					</div>
				</div>
			</div>{{-- widget-main --}}
		</div>{{-- widget-body --}}
	</div>{{-- widget-box --}}
	</div>{{-- widget-container-col --}}
</div><!-- /.row -->
<div class="row">
	<div id="ord" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Ordonnance :</b></h4>
			</div>
			<div class="modal-body">
				<iframe id="ordpdf" class="preview-pane" type="application/pdf" width="100%" height="500" frameborder="0" style="position:relative;z-index:999"></iframe>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="storeord1()" >Terminer</button>
			</div>
		</div>
	</div>
</div>
</div>
