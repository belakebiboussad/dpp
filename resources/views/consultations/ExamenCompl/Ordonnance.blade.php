<div class="row">
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main" >
					<div class="row">
						<div class="col-xs-12">
						<table id="medc_table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
							<th class="hidden-480">Médicament</th>
							<th class="hidden-480">Forme</th>
							<th class="hidden-480">Dosage</th>
							<th class="hidden-480"></th>
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
					<div class="col-sm-8">
					<div class="col-sm-11">
					<form class="form-horizontal" role="form">
   						<div class="form-group">
     						<input type="hidden" id="medicamentId" />
     						<label for="inputType" class="col-sm-3 control-label"><strong>&nbsp;&nbsp;Médicament:</strong></label>
        						<div class="col-sm-9">
        						<input type="text" class="form-control" id="nommedic" placeholder="médicamet" readonly>
           					{{-- <mark id="nommedic"></mark> --}}
      						</div>
                                                                </div>
                                                     </form>
					</div>
					<div class="col-sm-1">
					</div>
					</div>
					<div class="col-sm-4">
					<form class="form-horizontal" role="form">
   					<div class="form-group">
     					 <label for="inputType" class="col-sm-3 control-label"><strong>&nbsp;&nbsp;Form:</strong></label>
        					<div class="col-sm-9">
           				<input type="text" class="form-control" id="forme" placeholder="Forme" readonly>
           				{{-- <mark id="forme"></mark> --}}
      					</div>
                                                      </div>
                                                     </form>
					</div> 
					</div>	
					<div class="space-6"></div>
					<br>
					<div class="row">
						 <div class="col-sm-4">
						 	
   							 <div class="form-group">
     								  <label for="inputType" class="col-sm-4 control-label"><strong>Qte : </strong></label>
        								<div class="col-sm-4">
           							 <input id="qte" class="form-control input-sm disabledElem" type="number" min =1 value ="1"/>
      							          </div>
                                                                          </div>
                                                                          
						 </div>
						 <div class="col-sm-4">
						 <form class="form-horizontal" role="form">
   							 <div class="form-group">
     								  <label for="inputType" class="col-sm-5 control-label"><strong>Nbr Prise:</strong></label>
        								<div class="col-sm-4">
           							<input id="nbprise" class="form-control disabledElem" type="number" min="1" max="4" value =1 onchange="addTable();"	/>
      							          </div>
                                                                          </div>
                                                                </form>
						 </div>
						 <div class="col-sm-4">
						  <form class="form-horizontal" role="form">
   						<div class="form-group">
     						<label for="inputType" class="col-sm-4 control-label"><strong>fois par:</strong></label>
        						<div class="col-sm-8">
           					<select id="fois" class="form-control disabledElem" id="form-field-select-4" value="Jour">
						<option value="Jour" >jour</option>
						<option value="Semaine">Semaine</option>
						<option value="Mois">Mois</option>
						</select>
      						</div>
                                                                </div>
                                                                </form>
						 </div>	
					</div>
					<br>
					<div class="row">
					<div class="col-sm-4">
   					<div class="form-group">
     					 	 <label for="inputType" class="col-sm-6 control-label"><strong>Pendant: </strong></label>
        						<div class="col-sm-4">
           					 <input id="duree" class="form-control input-sm disabledElem" type="number" min = 1 value = "1" />
      					          </div>
                                                      </div>                                        
						</div>
						<div class="col-sm-4">
						 <div class="form-group">
        						<div class="col-sm-8">
           					<select id="dureefois" class="form-control disabledElem" id="form-field-select-3"  value="Semaine">
						<option value="Jour" selected>Jour</option>
						<option value="Semaine" Selected>Semaine</option>
						<option value="Mois">Mois</option>
						</select>
      						 </div>
                                                                </div>
                                                              
						</div>
						<div class="col-sm-4">
						</div>
					</div>
					<div class="space-12"></div>
					
					<div class="row">
					<div class="col-sm-3">
   						<div class="form-group">
     							 <label for="inputType" class="col-sm-8 control-label"><strong>A prendre:</strong></label>	
                                                                </div>
                                                                          
					</div>
					<div class="col-sm-9"></div>	
					<div id ="divmodeprise">
					<table border="1" class ="disabledElem">
					<tr>
						<td colspan="1" rowspan="1" class="text-center" >Prise(1)</td>
					</tr>
					<tr>
					<td><select id="temps" class="form-control" id="form-field-select-3"> 
		               			 <option value="Le matin">Le matin</option>
		                			<option value="à midi">à midi</option>
		                			<option value="Le Soir">Le Soir</option>
	              			</select>
	              			</td>	
					</tr>
					</table>
					</div>
						
					</div>
					<div class="space-12"></div>
					<div class="row">
						<div class="col-sm-5">	
   							 <div class="form-group">
     								  <label for="inputType" class="col-sm-4 control-label"><strong>Posologie: </strong></label>
        								<div class="col-sm-8">
           							<button class="label label-success label-white middle disabledElem" onclick="posologiefun()">
								<i class="fa fa-check-square-o" aria-hidden="true"></i>
								 Générer Posologie
								</button>
      							          </div>
                                                                          </div>
						</div>
						<div class="col-sm-7">
							<form class="form-horizontal" role="form">
   							 <div class="form-group">
     								<div class="col-sm-12">
           							<input id="pos" type="text"  class="form-control input-sm" readonly/>
      							          </div>
                                                                          </div>
                                                                          </form>
						</div>
					</div>
					<div class="space-12"></div>
					<div class="row">
						<div class="col-sm-1">
						
						</div>
						<div class="col-sm-11">
							<div class="form-group">
     							<div class="col-sm-12">
           						<button class="btn id ="addDrug" btn-success disabledElem" onclick="addmidifun()">Ajouter Médicament</button>
      							</div>
                                                                          </div>
						</div>
						
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>
	

<div class="row">
	<div class="col-sm-12">
		<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">Ordonnance :</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<button type="button" onclick="supcolonne()" class="btn btn-white btn-danger btn-sm">
						<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
					</button>
					{{-- <button type="button" class="btn btn-white btn-purple btn-sm">
						<i class="ace-icon fa fa-pencil bigger-120 green"></i>
					</button> --}}
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
						<div class="widget-box">
							<div class="widget-body">
							<div class="widget-main">
								<div class="row">
					<div class="col-xs-12">
					     <div class="col-xs-3">
					    {{--   <form id="ordonnace_form" method="POST" action="{{ route('ordonnace.store') }}">
						{{ csrf_field() }} --}}
						  {{--   <input type="text" name="idcons" value="{{ $consultation->id }}" hidden> --}}
						<label><strong>Date Ordonnance :</strong></label>
						<div class="input-group">
						  <input id="dateord" name="dateord" class="form-control date-picker disabledElem" name ="dateord" type="text" data-date-format="yyyy-mm-dd" data-provide="datepicker"  value='<?php echo date("Y-m-d");?>' />
						{{-- <span class="input-group-addon disabledElem">
						<i class="fa fa-calendar bigger-110 " ></i>
						</span> --}}
								</div>
						</div>
						<div class="col-xs-9">
						<label for="form-field-8">
						<strong>Pendant:</strong>
						</label>
						<br/>
						<div class="col-xs-2">
						<input class="form-control" name="dureeefois"  id ="dureeefois" type="number"  value =1 min =1/>
						</div>
						<div class="col-xs-3">
						<select class="form-control" id="foisss" name="foisss" value="Semaine">
							<option value="Jour" selected>Jour</option>
							<option value="Semaine" selected>Semaine</option>
							<option value="Mois">Mois</option>
						</select>
						</div>
						</div>
						</div>
						</div>			
						</div>
						</div>
						</div>
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
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ord" onclick="createord('{{ $patient->Nom }} {{ $patient->Prenom }}','{{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe}} {{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}}')">
									Imprimer
							</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
</div>
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
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="storeord1()" >Termin</button>
			</div>
		</div>
	</div>
</div>