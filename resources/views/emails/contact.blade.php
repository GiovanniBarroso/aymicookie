<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
            color: #333;
        }

        .content p {
            margin: 10px 0;
            font-size: 14px;
        }

        .content strong {
            color: #222;
        }

        .btn {
            display: inline-block;
            background-color: #E85C0D;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #cf4a0c;
        }

        .footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 12px;
            font-size: 12px;
        }

        .footer a {
            color: #E85C0D;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            📩 Nuevo Mensaje de Contacto - Ay Mi Cookie
        </div>

        <!-- Contenido -->
        <div class="content">
            <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
            <p><strong>Correo Electrónico:</strong> <a href="mailto:{{ $data['email'] }}"
                    style="color:#E85C0D;">{{ $data['email'] }}</a></p>
            <p><strong>Asunto:</strong> {{ $data['subject'] }}</p>
            <p><strong>Mensaje:</strong></p>
            <p style="background: #f8f8f8; padding: 10px; border-left: 4px solid #E85C0D;">{{ $data['message'] }}</p>

            <!-- Botón de respuesta -->
            <a href="mailto:{{ $data['email'] }}" class="btn">Responder al Usuario</a>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            © 2025 Ay Mi Cookie - <a href="#">Política de Privacidad</a>
        </div>
    </div>
</body>

</html>
