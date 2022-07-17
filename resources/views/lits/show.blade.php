<div class="widget-box">
        <div class="widget-header">
          <h5 class="widget-title"><i class="ace-icon fa fa-bed bigger-120"></i>Détails :</h5>
        </div>
        <div class="widget-body">
              <div class="widget-main">   
                      <div class="jumbotron text-center">
                            <h2>{{ $lit->nom }}</h2>
                            <p>
                                    <strong>Numéro : </strong> {{ $lit->num  }}<br>
                                    <strong>Bloqué :</strong><span>{{ $lit->bloq == 1 ? "Oui" : "Non" }}</span><br>
                                    <strong>Affecté :</strong><span> {{ $lit->affectation == 1 ? "Oui" : "Non" }}</span><br>
                                    <strong>Chambre :</strong>{{ $lit->salle->nom }}<br>
                                    <strong>Service :</strong>{{ $lit->salle->Service->nom }}
                              </p>
                      </div>
              </div>
          </div>
</div>