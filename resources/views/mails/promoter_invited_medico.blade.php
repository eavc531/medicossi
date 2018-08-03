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

    <p>Un Cordial saludo: {{$medico->nameComplete}}, un Promotor de la plataforma Médicossi, con el nombre de: {{$promoter->name}} {{$promoter->lastName}}, con numero de identificaión: {{$medico->identification}} le a asignado una cuenta Médicossi, plataforma que le permitira agilizar su trabajo como Profesional Médico, permitiendole agendar citas online, imprimir notas médicas
prediseñadas, organizar sus citas, ser ubicado por pacientes a travez de busqueda online, entre otras acciones.

    <p><strong>Sus Datos de Usuario para poder ingresar a su cuenta Médicossi son los Siguientes:</strong></p>
    <p><strong>Correo: </strong>{{$medico->email}}</p>
    <p><strong>Contraseña:</strong>{{$code}}</p>

    <p>Cuenta Creada en la fecha: {{\Carbon\Carbon::now()}}</p>

    <p>Feliz Dia</p>
</body>
</html>
