<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Notificación Creacion de Su Cuenta MédicosSi Asistente"</h2>

    <p>Un Cordial saludo: {{$assistant->nameComplete}}, un usario de la plataforma Médicossi, el Profesional Médico: {{$medico->name}} {{$medico->lastName}}, cuyo numero de identificaion es:{{$medico->identification}} le a asignado una cuenta como asistente en Médicossi , este tipo de cuenta le permitira gestionar cuentas de médicos que soliciten su servicio.

    <p><strong>Sus Datos de Usuario para poder ingresar a su cuenta como asistente son los Siguientes:</strong></p>
    <p><strong>Correo: </strong>{{$user->email}}</p>
    <p><strong>Contraseña: </strong>{{$pass}}</p>

    <p>Cuenta Creada en la fecha: {{\Carbon\Carbon::now()}}</p>

    <p>Feliz Dia</p>
</body>
</html>
