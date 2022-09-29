<div class="widget-box">
  <div class="widget-header">
  <h5 class="widget-title"><i class="ace-icon fa fa-bed"></i>Détails :</h5>
</div>
<div class="widget-body">
  <div class="widget-main">   
    <div class="jumbotron text-center"><h2>{{ $lit->nom }}</h2>  
      <p>
        Numéro :{{ $lit->num  }}<br>
        Bloqué :<span>{{ $lit->bloq == 1 ? "Oui" : "Non" }}</span><br>
        Affecté :<span> {{ $lit->affectation == 1 ? "Oui" : "Non" }}</span><br>
        Chambre :{{ $lit->salle->nom }}<br>
        Service :{{ $lit->salle->Service->nom }}
      </p>
    </div>
  </div>
  </div>
</div>