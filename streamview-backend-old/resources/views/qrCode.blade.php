<html>
<head>
	<title></title>
</head>
<body>
    
<div class="visible-print text-center">
	<h1>Laravel 5.7 - QR Code Generator Example</h1>
     
    {!! QrCode::size(250)->generate('25 USD'); !!}
     
    
</div>
    
</body>
</html>