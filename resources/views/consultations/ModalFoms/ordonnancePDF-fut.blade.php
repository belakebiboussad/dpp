<!DOCTYPE html>
<html>
  <head>  
    <title>Ordonnance-{{ $patient->Nom }}-{{ $patient->Prenom }}</title>
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/print.css') }}"/>
    <style>
    .page-header, .page-header-space {
      height: 149px;
    }
    .page-footer, .page-footer-space {
      height: 70px;
    }
    .page-footer {
      position: fixed;
      bottom: 0;
      width: 100%;
     /* border-top: 1px solid black;*/ /* for demo */
     /* background: yellow;*/ /* for demo */
    }
    .page-footer:after {
      /*counter-increment: page;
      content: counter(page)*/
    }
    .page-header {
      position: fixed;
      top: 0mm;
      width: 100%;
     /* border-bottom: 1px solid black;*/ /* for demo */
     /* background: yellow;*/ /* for demo */
    }
    .page {
      page-break-after: always;
    }

    @page {
      margin: 10mm
    }

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   button {display: none;}
   body {margin: 0;}
}
  </style>
</head>

<body>

  <div class="page-header" style="text-align: center">
    <div class="row mt-13 center"><img src='{{ asset("img/entete.png") }}' alt="Entete" width="100%"/></div>
  </div>
  <div class="page-footer">
    <img src='{{ asset("img/footer.png") }}' alt="footer" width="100%"/>
  </div>
  <table>
    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>  <!--*** CONTENT GOES HERE ***-->
          <div class="page">
           
          </div>
          <div class="page">PAGE 2</div>
          <div class="page" style="line-height: 3;">
          dfd
          </div>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>
  </table>
</body>
</html>