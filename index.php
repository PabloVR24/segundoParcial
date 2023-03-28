<!DOCTYPE html>
<html>

<head>
    <title>Ticket de Turno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #011627;
            background: radial-gradient(circle, transparent 20%, #011627 20%, #011627 80%, transparent 80%, transparent),
                radial-gradient(circle, transparent 20%, #011627 20%, #011627 80%, transparent 80%, transparent) 15px 15px,
                linear-gradient(#b89cd7 1.2000000000000002px, transparent 1.2000000000000002px) 0 -0.6000000000000001px,
                linear-gradient(90deg, #b89cd7 1.2000000000000002px, #011627 1.2000000000000002px) -0.6000000000000001px 0;
            background-size: 150px 150px, 150px 150px, 15px 15px, 15px 15px;
            margin: 250px;
            margin-right:35%;
            margin-left:35%;
        }

        h1 {
            text-align: center;
            background-color: #b89cd7;
            border-radius: 5px;
            padding: 20px;
            margin-top: 0;
        }

        button {
            font-size: 35px;
            padding: 12px;
            display: inline-block;
            margin: 15px;
            border-radius: 5px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;

        }
    </style>
</head>

<body>
    <h1>Ticket de Turno</h1>
    <div class="container">
        <div class="ADMIN">
            <button onclick="location.href='views/admin/login.php'">ADMIN</button>
            <button onclick="location.href='views/users/index.php'">USUARIO</button>
        </div>
    </div>
</body>

</html>
