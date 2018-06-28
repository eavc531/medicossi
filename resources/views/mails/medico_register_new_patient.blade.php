<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Notificación Su Cuenta MédicosSi Creada"</h2>

    <p>Un Cordial saludo: {{$patient->nameComplete}}, un usario de la plataforma Médicossi, el Profesional Médico: {{$medico->name}} {{$medico->lastName}}, cuyo numero de identificaion es:{{$medico->identification}} le a asignado una cuenta Médicossi, plataforma que le permite ubicar Profesionales médicos por categorias, agendar citas con estos de forma eficiente,y estar al tanto de sus citas pendientes.

    <p><strong>Sus Datos de Usuario para poder ingresar a su cuenta son los Siguientes:</strong></p>
    <p><strong>Correo: </strong>{{$patient->email}}</p>
    <p><strong>Contraseña:</strong>{{$user->password_send}}</p>

    <p>Cuenta Creada en la fecha: {{\Carbon\Carbon::now()}}</p>

    <p>Feliz Dia</p>
</body>
</html>
