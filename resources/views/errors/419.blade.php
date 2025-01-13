<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Expired</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
        }
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
            display: inline-block;
        }
        .content h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content p {
            font-size: 18px;
            color: #666;
        }
        .content a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>419</h1>
        <p>Maaf, Sesi sudah kadaluwarsa.</p>
        <a href="{{ url('/login') }}">Klik untuk Login</a>
    </div>
</body>
</html>
