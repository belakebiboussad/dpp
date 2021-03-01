 	<div class="row">
			<a data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link col-sm-12" data-toggle="modal">
	 		<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
		</a>
		</div><div class="space-12"></div>
  <div class="row">
			<a data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link col-sm-12" data-toggle="modal">
		  <div class="fa fa-plus-circle"></div><span class="bigger-110">&nbsp;Rendez-vous</span>
		</a>
		</div><div class="space-12"></div>
 	<div class="row">
		<a data-target="#demandehosp" class="btn btn-primary btn-lg tooltip-link col-sm-12" data-toggle="modal">
  	  <div class="fa fa-plus-circle"></div><span class="bigger-110">Hospitalisation</span>
			 </a>
	</div><div class="space-12"></div>
  <div class="row">
		<a class="btn btn-primary btn-lg tooltip-link col-sm-12" data-toggle="modal" data-target="#lettreorient" onclick="lettreoriet('{{ $employe->nom }}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
			<div class="fa fa-plus-circle"></div> <span class="bigger-110">Orientation</span> 
		</a>
	</div>