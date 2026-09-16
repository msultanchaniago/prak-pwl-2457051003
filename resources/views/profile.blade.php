<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 60px;
            background-color: #ffffff;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #333;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-box {
            width: 300px;
            background-color: #e0e0e0;
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 4px;
            font-size: 18px;
            text-align: center;
            color: #1e40af;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="avatar">
        <img src="{{ asset('images/foto.png~') }}" alt="Foto Profil">
    </div>

    <div class="info-box">{{ $nama }}</div>
    <div class="info-box">{{ $kelas }}</div>
    <div class="info-box">{{ $npm }}</div>

</body>
</html>