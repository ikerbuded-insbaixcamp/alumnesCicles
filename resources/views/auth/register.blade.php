<!DOCTYPE html>
<html lang="an">
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
        <p>És el teu torn! Uneix-te a nosaltres!</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" class="form-control mb-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nom" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            <input type="text" name="address" class="form-control mb-3 @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Adreça" required>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            <input type="date" name="birth_date" class="form-control mb-3 @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required>
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            <input type="text" name="phone_number" class="form-control mb-3 @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="Telèfon" required>
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            <input type="email" name="email" class="form-control mb-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Correu electrònic" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            <input type="password" name="password" class="form-control mb-3 @error('password') is-invalid @enderror" placeholder="Contrasenya" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirma la contrasenya" required>
            
            <button type="submit" class="btn btn-primary w-100">Registra't</button>
        </form>
        <p class="mt-3"><a href="{{ route('welcome') }}" class="text-light">Ja estàs registrat? Inicia sessió</a></p>
    </div>
</body>
</html>
