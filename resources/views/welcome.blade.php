<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Passport Change Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: "Times New Roman", Times, serif;
        }
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('{{ asset('images/bg.jpg') }}') no-repeat center center/cover;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            color: #212529;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .hero-card img {
            height: 90px;
            margin-bottom: 15px;
        }
        .hero-card h1 {
            font-weight: bold;
            color: #1c6b13;
        }
        .hero-card p {
            font-size: 14pt;
            margin-bottom: 25px;
        }
        .btn-custom {
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 14pt;
        }
    </style>
</head>
<body>

<div class="hero">
    <div class="hero-card">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>Welcome to Passport Change Management</h1>
        <p class="lead">
            High Commission of the People’s Republic of Bangladesh <br>
            Brunei Darussalam
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('passport.create') }}" class="btn btn-success btn-custom shadow">➕ Add New Record</a>
            <a href="{{ route('passport.index') }}" class="btn btn-primary btn-custom shadow">📂 View Records</a>
        </div>
    </div>
</div>

</body>
</html>
