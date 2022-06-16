<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lettre d'orientation médicale</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
      @page {/*  margin: 5px 100px 25px 100px;*/
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
            <td rowspan="1" colspan="1" width="230" height="30" >
              <span>MINISTERE DE L'INTERIEUR ET DES COLLECTIVITES LOCALES</span>
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
          <td rowspan="2" colspan="1" width="250" height="60" >
            <div class="rectangle"><h4>Certificat MEDICAL DESCRIPTIF</h4></div>
          </td>
          <td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        <tr class="noBorder">
          <td rowspan="1" colspan="1" width="206" height="30" ></td><td rowspan="1" colspan="1" width="230" height="30" ></td> <td rowspan="1" colspan="1" width="120" height="30" ></td>
        </tr>
        </table>
        </div>
      </div>
    </div>
  </body>
</html>
