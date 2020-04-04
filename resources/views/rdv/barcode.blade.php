<!-- barcodegenerator.blade.php --> 

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel Barcode Generator Tutorial With Example </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
   </head>
<body>
   <h2>Laravel Barcode Generator Tutorial With Example</h2><br/>
<div class="container text-center">
   <h2>Two-Dimensional (2D) Barcode Types</h2><br/>
  {{--  <div>{!!DNS2D::getBarcodeHTML(335553, 'QRCODE')!!}</div></br>
   <div>{!!DNS2D::getBarcodeHTML(142535, 'PDF417')!!}</div></br> --}}
   	{{--   <div style ="width:200px;height:200px">{!!DNS2D::getBarcodeHTML(142535, 'PDF417')!!}</div></br> --}}
   	 {{--  {!! DNS2D::getBarcodeHTML(142535,  'PDF417' ,1.5  ,1.5) !!} --}}
   	  	{!! DNS2D::getBarcodeHTML(142535,  'PDF417' ,2  ,2) !!}
   	  		{!! DNS2D::getBarcodePNGPath(142535,  'PDF417' ,2  ,2) !!}
</body>
</html>