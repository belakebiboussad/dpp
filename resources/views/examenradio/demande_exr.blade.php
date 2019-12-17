<!DOCTYPE html>
<html>
<head>
  <title>Demande examens biologiques</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
    }
    .section
    {
      margin-bottom: 20px;
    }
    .sec-gauche
    {
      float: left;
    }
    .sec-droite
    {
      float: right;
    }
    .center
    {
      text-align: center;
    }
    .col-sm-12
    {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <h3 class="center">Direction Générale de la Sûreté Nationale</h3>
  <h4 class="center">HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES"</h4>
  <h4 class="center">Tél : 23-93-34</h4>
  <br><br>
  <div class="center">
    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($demande->consultation->patient->code_barre, 'C128')}}" alt="barcode" />
  </div>
  <br><br>
  <div class="page-header" width="100%">
   <div class="row">
    <div class="col-sm-12">
      <div class="widget-box">
        <div class="widget-body">
          <div class="widget-main">
            <label class="inline">
            <span class="blue"><strong>Nom :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Nom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Prenom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Dat_Naissance }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }} ans</span>
          </label>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div> <!-- page-header -->
  <div class="content">
      <div class="col-sm-12">
        <div class="col-xs-12 widget-container-col" id="consultation">
          <div class="widget-box" id="infopatient">
            <div class="widget-header">
              <h4 class="widget-title center "><b>Demande d'un examen radiologique</b></h4>
            </div>
            <div class="widget-body">
              <div class="widget-main">
                <div class="row">
                  <div class="col-xs-12">
                    <br>
                    <div>
                      <label for="infosc">
                        <b>Informations cliniques pertinentes</b>
                      </label>
                      <textarea class="form-control" id="infosc" name="infosc" >{{ $demande->InfosCliniques }}</textarea>
                    </div>
                      
                    <br>
                       
                    <div>
                              <label for="infos">
                                <b>Informations supplémentaires pertinentes</b>
                              </label>
                              <textarea class="form-control" id="infosc" name="infosc" >{{ $demande->Explecations }}</textarea> 
                    </div>              
                     
                  
                    <br>
                    <div>
                        <label><b>Informations supplémentaires pertinentes</b></label>
                        <div>
                          <ul class="list-inline">
                              @foreach($demande->infossuppdemande as $index => $info)
                                  <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                               
                              @endforeach
                          </ul>    
                        </div>
                    </div>
                    
                    <div>
                         <label><b>Examen(s) proposé(s)</b></label>
                        <div>
                          <table class="table table-borderless">
                         
                            
                              @foreach($demande->examensradios as $index => $examen)
                                <tr>
                                  <td class="center">{{ $index + 1 }}</td>
                                  <td>{{ $examen->nom }}</td>
                                </tr>
                              @endforeach
                          
                          </table>
                        </div>
                  </div>
                  <div>
                    <label>
                      <b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</b>
                    </label>
                    <div>
                      <table class="table table-borderless">
                        
                          @foreach($demande->examensrelatifsdemande as $index => $exm)
                            <tr>
                              <td class="center">{{ $index + 1 }}</td>
                              <td>{{ $exm->nom }}</td>
                            </tr>
                          @endforeach
                        
                      </table>
                    </div>
                  </div>  
                   
              </div>
            </div><!-- .row -->
          </div>  
        </div>
      </div>
  </div>
  </div>
</div><!-- container-fluid -->
</body>
</html>