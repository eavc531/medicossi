<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Reestablecimiento de Contraseña MédicosSi"</h2>

    <p>Un Cordial saludo: {{$nameUser}}, este es un mensaje de confirmación para reestablecer su contraseña, para continuar con el proceso acceda al siguiente link: </p><a href="{{route('confirm_restore_pass',['id'=>\Hashids::encode($user->id),'code'=>$code])}}">{{route('confirm_restart_pass',['id'=>\Hashids::encode($user->id),'code'=>$code])}}</a>

    <p>Si usted no Solicito el Reestablecimiento de su contraseña, omita el mensaje y verifique que otra persona este intentando entra su cuenta Médicossi asociada a su correo electrónico: {{$user->email}}</p>

    <p>Feliz Dia</p>

</body>
</html>
