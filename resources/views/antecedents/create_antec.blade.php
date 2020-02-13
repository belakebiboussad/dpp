@extends('app_med')
@section('main-content')
	<div class="page-header">
		<h1 style="display: inline;"><strong>Ajouter Antécédant Pour :</strong> 
		{{-- {{ $patient->Nom }} {{ $patient->Prenom }}</h1> --}}
		  @include('patient._patientInfo')
		<div class="pull-right"> </div>
	</div>
	 	<div class= "col-md-6 col-xs-6">
        		 @include('consultations.Antecedant')
        	</div>
        	<div class= "col-md-6 col-xs-6">
        		<div class="widget-box widget-color-GhostWhite  ui-sortable-handle" id="widget-box-11" >
        		     <div class="widget-header" >
                        <h6 class="widget-title">
                        	<font color="black">
                        		<b>Antecedants</b>
                        	</font>
                        </h6>
                        <div class="widget-toolbar">
                            <a href="#">
                               <i class="ace-icon fa fa-check"></i>
                               Valider
                            </a>
                   	</div>
                     </div>
		<div class="widget-body" id ="ATCDWidget">
	                      <div class="widget-main no-padding">
	                            <table class="table table-striped table-bordered table-hover" id="ants-tab">
	                              	<thead class="thin-border-bottom">
	                                	<tr>
		                                 	<th>Type</th>
		                                  	<th><i class="fa fa-clock-o" aria-hidden="true"></i>Date</th>
		                                  	<th class="hidden-480">Description</th>
		                                  	<th class="hidden-480"></th>
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
					<div class="space-12"></div>
				</div>{{-- widget-main --}}
				</div>	
				</div>
				<div style="text-align: center;">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						Enregistrer
					</button>
						&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
						Annuler
					</button>
				</div>
			</div>														
	</form>
@endsection