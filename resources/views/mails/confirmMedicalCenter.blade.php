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

      <p>Un Cordial saludo: {{$medicalCenter->nameAdmin}} , Para Confirmar el registro del Centro Medico: {{$medicalCenter->tradename}},
        debe Ingresar a la Ruta: </p>
        <a href="{{route('confirmMedicalCenter',['id'=>\Hashids::encode($medicalCenter->id),'code'=>$code])}}">{{route('confirmMedicalCenter',['id'=>\Hashids::encode($medicalCenter->id),'code'=>$code])}}</a>

      <p>Si usted no Solicito una cuenta en MédicosSi, Simplemente omita el mensaje; de este modo la cuenta no sera verificada.</p>


</body>
</html>
