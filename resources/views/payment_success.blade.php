<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 400px;
            width: 100%;
            text-align: center;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            padding: 15px 25px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="header">
            Pago Exitoso
        </div>
        <div class="content">
            <p>ID de Pago: {{ $result['id'] }}</p>
            <p>Estado: {{ $result['status'] }}</p>
            <p>Monto: {{ $result['purchase_units'][0]['payments']['captures'][0]['amount']['value'] }}</p>
            <p>Moneda: {{ $result['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'] }}</p>
            <a href="{{ route('reservas_realizadas') }}" class="button">Volver a Inicio</a>
        </div>
    </div>
</body>
</html>
