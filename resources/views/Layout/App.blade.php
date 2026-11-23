<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Nilai - Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">SIAKAD Nilai</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="{{ route('dashboard') }}">Rekap (View & SP)</a>
            <a class="nav-link" href="{{ route('guru.index') }}">Guru</a>
            <a class="nav-link" href="{{ route('siswa.index') }}">Siswa</a>
            <a class="nav-link" href="{{ route('mapel.index') }}">Mapel</a>
            <a class="nav-link" href="{{ route('guru-mapel.index') }}">Setting Guru Mapel</a>
            <a class="nav-link" href="{{ route('nilai.index') }}">Nilai</a>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="d-flex">
            @csrf
            <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
        </form>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>