<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p><strong>Estimado usuario </strong>{{ Auth::user()->name }}</p><p>{{ Auth::user()->lastname }}</p>
    <p><strong>Mensaje:</strong> Se le hace presente que 
    la sugerencia ingresada fue aceptada con exito, 
    muchas gracias por usar COMBUY !!</p>
</body>
</html>