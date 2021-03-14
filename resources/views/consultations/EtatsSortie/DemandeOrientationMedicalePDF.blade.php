<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title><!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/styles.css">
    <style>
      table {
          border-spacing: 0;
          width: 600px;
      }/*    table > tbody > tr > td {border: 1px solid black;  vertical-align: top; text-align: center;        }*/
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
      /*tr.noBorder td { border: 0;  }*/
    </style>
  </head>
  <body>
    <div class="ontainer-fluid"><!--<div class="row"> <div class="col-sm-12" style ="text-align: center"><h4><strong>REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE</strong></h4></div></div> -->
      <h4 class="mt-12 center">REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE</h4>
      <div class="row">
        <table border="0" cellspacing="0" cellpadding="0">
        <tr class="noBorder">
          <td rowspan="1" colspan="1" width="206" height="30" >
            <span style="text-align: left;">MINISTERE DE L'INTERIEUR ET DES COLLECTIVITES LOCALES
            </span>
          </td>
          <td rowspan="1" colspan="1" width="230" height="30"></td>
          <td id ="imagewrapper " rowspan="4" colspan="1" width="120" height="120" >
            <img src="img/logo.png" style="position: relative; display: inline-block; left: 50%; transform: translate(-50%);width:110px; height:110px" alt="logo"/>
          </td>
        </tr>
        <tr class="noBorder" >
          <td rowspan="1" colspan="1" width="206" height="30" >DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</td>
          <td rowspan="1" colspan="1" width="230" height="30" ></td><td rowspan="1" colspan="1" width="120" height="30" ></td>
         </tr>
        <tr class="noBorder">
          <td rowspan="1" colspan="1" width="206" height="30" >SERVICE CENTRALE DE LA SANTE DE L'ACTION SOCIALE ET DES SPORTS </td>
          <td rowspan="1" colspan="1" width="230" height="30" ></td>  <td  rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        <tr class="noBorder">
          <td  rowspan="1" colspan="1" width="206" height="30" >ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE</td>
          <td  rowspan="1" colspan="1" width="230" height="30" ></td><td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        <tr class="noBorder">
          <td rowspan="1" colspan="1" width="206" height="30" ></td>
          <td rowspan="2" colspan="1" width="230" height="60" >
            <div class="rectangle">
            <h4><strong>DEMANDE D'ORIENATATION MEDICALE</strong></h4>  
          </div>
          </td> <td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        <tr class="noBorder">
          <td rowspan="1" colspan="1" width="206" height="30" ></td> <td rowspan="1" colspan="1" width="230" height="30" ></td> <td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        </table>
        </div><br><br> 
        <div class="row">Chère Consœur, Cher Confrère;</div><br><br>
        <div class="row">
          Merci de prendre en charge {{ $obj->patient->getCivilite() }} <span>{{ $obj->patient->Nom }} &nbsp; {{ $obj->patient->Prenom }}</span> âgé(e) de {{ $obj->patient->getAge() }}&nbsp;ans.
        </div>
        <div class="row">
          Je vous confie ce (cette) patient(e) qui s'est présenté ce jour pour {{ $obj->motif }},
          @if(isset($obj->patient->antecedants))
            aux Antécédants de      
            @foreach ($obj->patient->antecedants as $ant)
              {{ $ant->descrioption}},
            @endforeach  
          @endif
          @if(isset($obj->examensCliniques))
           et dont l'examen clinique {{ $obj->examensCliniques->Etat}}
          @endif
          je vous le confie pour une prise en charge specialisé. 
        </div> <br><br><br>
        <div class="row">Confraternellement. </div>
        <div class="row"><div class="col-sm-12"><div class="col-sm-4"></div><div class="col-sm-4"></div> <div class="col-sm-4"></div> </div></div>
    </div>
  </body>
</html>