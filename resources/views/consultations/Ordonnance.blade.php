<div class="row"   style="margin-top: -12px;">
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main" >
					<div class="row">
					<div class="col-xs-12">
						<table id="medc_table" class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
						<th class="hidden-480 center"><strong>Médicament</strong></th>
						<th class="hidden-480 center">
						<strong>Forme</strong>
						</th>
						<th class="hidden-480 center">
						<strong>Dosage</strong>
						</th>
						<th class="hidden-480 center">
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
			
		</div>{{-- row --}}
		</div>	{{-- widget-main --}}
		</div>	{{-- widget-body --}}
		</div>{{-- "widget-box --}}
	</div>{{-- col-sm-6 --}}
</div>
<br><br>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">Ordonnance :</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<button type="button" onclick="supcolonne()" class="btn btn-white btn-danger btn-sm">
					<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
				</button>
			</div>
		</div>
		<div class="widget-body">
		<div class="widget-main">
		<div class="row">
		<div class="col-sm-12">
		<div class="widget-box">
		<div class="widget-body">
		<div class="widget-main">
		<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-5">
			<label for="dateord"><strong>Date Ordonnance :&nbsp;</strong></label>
			<input id="dateord" name="dateord" class="date-picker disabledElem" name ="dateord" type="text" data-date-format="yyyy-mm-dd" data-provide="datepicker"  value='<?php echo date("Y-m-d");?>' />
			</div>
			<div class="col-sm-3">
				<label for="dureeefois"><strong>Pendant:&nbsp;</strong></label>
				<input class="" name="dureeefois"  id ="dureeefois" type="number"  value =1 min =1/>
			</div>
			<div class="col-sm-4">
				<select class="col-sm-6" id="foisss" name="foisss" value="Semaine">
					<option value="Jour" selected>Jour</option>
					<option value="Semaine" selected>Semaine</option>
					<option value="Mois">Mois</option>
				</select>
			</div>		 
		</div>{{-- col-sm-12 --}}
		</div>	{{-- row--}}
		</div>	{{-- widget-box --}}
		</div>	{{-- widget-body --}}
		</div>{{-- widget-box --}}
		<table id="ordonnance" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Médicament</th>
				<th>Forme</th>
				<th>Quantité</th>
				<th>Posologie</th>
				<th style="display:none;"></th>
			</tr>
		</thead>
		</table>
		</fom>
		<div class="pull-right">
			<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="storeord1()">Enregistrer</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ord" onclick="createord('{{ $patient->Nom }} {{ $patient->Prenom }}','{{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe}} {{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}}')">Imprimer	</button>
			<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
		</div>{{-- pull-right --}}
		</div>{{-- col-sm-12 --}}
		</div>{{-- row --}}			
		</div>{{-- widget-main --}}
		</div>{{-- widget-body --}}
		</div>	{{-- widget-box --}}
		</div> {{-- widget-container-col --}}
</div><!-- /.row -->
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