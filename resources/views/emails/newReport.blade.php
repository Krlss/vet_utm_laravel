<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica veterinaria UTM</title>
</head>

<body>

    <style>
        h1 {
            color: rgb(26, 134, 26);
        }
    </style>

    <h1>{{ $detail['title'] }}</h1>
    <p>{{ $detail['body'] }}</p>


    <div id="container">
        <p>Nombre de la mascota: {{ $detail['data']['name']}} </p>
        <p>Especie de la mascota: {{ $detail['data']['specie']}} </p>
        <p>Raza de la mascota: {{ $detail['data']['race']}}</p>
        <p>Sexo de la mascota: {{ $detail['data']['sex']}}</p>

        @if($detail['data']['fur'])
        <p>Pelaje de la mascota: {{ $detail['data']['fur']}}</p>
        @endif

        @if($detail['data']['user_id'])
        <p>CI/RUC del dueño de la mascota: {{ $detail['data']['user_id']}}</p>
        @endif

        @if($detail['data']['user_name'])
        <p>Nombres del dueño de la mascota: {{ $detail['data']['user_name']}}</p>
        @endif

        @if($detail['data']['user_lastname'])
        <p>Apellidos del dueño de la mascota: {{ $detail['data']['user_lastname']}}</p>
        @endif

        @if($detail['data']['user_email'])
        <p>Correo del dueño de la mascota: {{ $detail['data']['user_email']}} </p>
        @endif

        @if($detail['data']['user_phone'])
        <p>Teléfono del dueño de la mascota: {{ $detail['data']['user_phone']}} </p>
        @endif

        @if($detail['data']['province'])
        <p>Provincia del dueño de la mascota: {{ $detail['data']['province']}} </p>
        @endif

        @if($detail['data']['canton'])
        <p>Cantón del dueño de la mascota: {{ $detail['data']['canton']}}</p>
        @endif

        @if($detail['data']['parish'])
        <p>Parroquia del dueño de la mascota: {{ $detail['data']['parish']}}</p>
        @endif

    </div>

</body>

</html>