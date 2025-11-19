<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvingut a CursosWeb</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personal.css') }}">
</head>
<body id="welcome">
    <div class="overlay">
        <h1 class="fw-bold text-success">CursosWeb</h1>
        <p>Inscriu-te a un curs i millora les teves habilitats!</p>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" class="form-control mb-3" value="{{ old('email') }}" placeholder="Correu electrònic" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="password" name="password" class="form-control mb-3" placeholder="Contrasenya" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <p class="mt-3"><a href="{{ route('register') }}" class="text-light">Registra't aquí</a></p>
    </div>
</body>
</html>
