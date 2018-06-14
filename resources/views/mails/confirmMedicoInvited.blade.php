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

    <p>Un Cordial saludo: {{$medico->name}} {{$medico->lastName}}, usted ha sido invitad@ a unirse a nuestra pagina web de Profesionales Médicos, por el Promotor: {{$promoter->name}} {{$promoter->lastName}}, Para confirmar su cuenta debera ingresar al siguiente link. </p><a href="{{route('confirmMedico',['id'=>$user->id,'code'=>$code])}}">{{route('confirmMedico',['id'=>$user->id,'code'=>$code])}}</a>

    <p>Si usted no Solicito una cuenta en MédicosSi o no fue invitado, Simplemente omita el mensaje; de este modo la cuenta no sera verificada.</p>

</body>
</html>
