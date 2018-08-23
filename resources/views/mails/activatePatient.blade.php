<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

      <h2>"Verificación por correo electrónico de MédicosSi"</h2>

      <p>Un Cordial saludo: {{$user->name}} {{$user->lastName}}, Para Confirmar Su Cuenta de Red Medica debe Ingresar a la Ruta: </p><a href="{{route('confirmPatient',['id'=>\Hashids::encode($user->id),'code'=>$code])}}">{{route('confirmPatient',['id'=>\Hashids::encode($user->id),'code'=>$code])}}</a>

      <p>Si recibiste un correo electrónico de verificación de cuenta por error, es posible que otro usuario haya ingresado tu dirección de correo electrónico mientras intentaba crear una cuenta para otra dirección. Si no solicitaste la cuenta, no es necesario que realices ninguna acción. Simplemente, omite el mensaje; la cuenta no se verificará.</p>


</body>
</html>
