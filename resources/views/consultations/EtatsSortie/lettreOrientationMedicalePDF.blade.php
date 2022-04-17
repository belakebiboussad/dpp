<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lettre d'orientation médicale</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
      @page {
        /*  margin: 5px 100px 25px 100px;*/
        margin: 20px 100px 80px;
      }
      table {
          border-spacing: 0;
          width: 600px;
      }
      table > tbody > tr > td > div {
          margin: 0 auto;
          border: 0px red solid;
      }
      .pagination-centered {
            text-align: center;
      }
      .rectangle {
        width:90%;
        height:70px;/*background:#ccc;*/
        border:3px solid black;
        position: relative;
        line-height: 20px;
        padding-top: 5px;
        text-align: center;
      }
     
    </style>
  </head>
  <body>
    <div>
      <div class="mt-12">       
        <h4 class="center">REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE</h4>
        <div>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr class="noBorder">
            <td rowspan="1" colspan="1" width="206" height="30" >
              <span>MINISTERE DE L'INTERIEUR ET DES COLLECTIVITES LOCALES</span><!-- style="text-align: left;" -->
            </td>
            <td rowspan="1" colspan="1" width="230" height="30"></td>
            <td id ="imagewrapper " rowspan="4" colspan="1" width="120" height="120" >
              <img src="img/{{ $etablissement->logo }}" style="position: relative; display: inline-block; left: 50%; transform: translate(-50%);width:110px; height:110px" alt="logo"/>
            </td>
          </tr>
          <tr class="noBorder" >
            <td rowspan="1" colspan="1" width="206" height="30" >{{ $etablissement->tutelle }}</td>
            <td rowspan="1" colspan="1" width="230" height="30" ></td><td rowspan="1" colspan="1" width="120" height="30" ></td>
          </tr>
          <tr class="noBorder">
            <td rowspan="1" colspan="1" width="206" height="30" >SERVICE CENTRALE DE LA SANTE DE L'ACTION SOCIALE ET DES SPORTS </td>
            <td rowspan="1" colspan="1" width="230" height="30" ></td>  <td  rowspan="1" colspan="1" width="120" height="30" ></td>
          </tr>
          <tr class="noBorder">
            <td  rowspan="1" colspan="1" width="206" height="30" >{{ $etablissement->nom }}</td>
            <td  rowspan="1" colspan="1" width="230" height="30" ></td><td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        <tr class="noBorder">
          <td rowspan="1" colspan="1" width="206" height="30" ></td>
          <td rowspan="2" colspan="1" width="230" height="60" >
            <div class="rectangle">
            <h4><strong>{{ $etat->nom}}</strong></h4><!-- DEMANDE D'ORIENATATION MEDICALE -->
          </div>
          </td> <td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        <tr class="noBorder">
          <td rowspan="1" colspan="1" width="206" height="30" ></td> <td rowspan="1" colspan="1" width="230" height="30" ></td> <td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        </table>
        </div>
      </div><br><br> 
      <div>Chère Consœur, Cher Confrère;</div><br><br>
        <div>
          Merci de prendre en charge {{ $obj->patient->getCivilite() }} <span>{{ $obj->patient->full_name }}</span> âgé(e) de {{ $obj->patient->age }}&nbsp;ans.
        </div>
        <div>
          Je vous confie ce (cette) patient(e) qui s'est présenté ce jour a notre service pour Motif "{{ $obj->motif }}",
          @if($obj->patient->antecedants->count() >0)
            aux Antécédants suivants:  <br/><br/>
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th class="center">Type</th>
                  <th class="center">Date</th>
                  <th class="center">Description</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($obj->patient->antecedants as $ant)
                <tr>
                <td>{{ $ant->stypeatcd}}</td>
                <td>{{  $ant->date }}</td> 
                <td>{{ $ant->description}}</td>
                </tr>
               @endforeach  
              </tbody>
            </table>    
          @endif
          @isset($obj->examensCliniques)
           et dont l'examen clinique: <br/><br/>
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th class="center">Taille</th>
                  <th class="center">Poids</th>
                  <th class="center">Températeur</th>
                  <th class="center">Etat</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <td>{{ $obj->examensCliniques->taille}}</td>
                <td>{{  $obj->examensCliniques->poids }}</td> 
                <td>{{ $obj->examensCliniques->temp}}</td>
                <td>{{ $obj->examensCliniques->Etat}}</td>
                </tr>
              </tbody>
            </table>
          @endisset
          je vous le confie pour une prise en charge specialisé. 
        </div> <br><br><br>
        <div>Confraternellement. </div>
      <footer>
        <img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/>
      </footer>
    </div>
  </body>
</html>