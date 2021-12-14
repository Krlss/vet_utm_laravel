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
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>

    <h1>{{ $detail['title'] }}</h1>
    <p>{{ $detail['body'] }}</p>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Dueño</th>
            </tr>
        </thead>
        <tbody>
            <td>{{ $detail['data']['name'] }}</td>  
            <td>{{ $detail['data']['specie'] }}</td>  
            <td>{{ $detail['data']['race'] }}</td>  
            <td>{{ $detail['data']['user_id'] }}</td>  
        </tbody>
    </table>


</body>

</html>
