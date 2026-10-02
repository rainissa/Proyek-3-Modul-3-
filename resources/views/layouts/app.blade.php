<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity Manager</title>
</head>
<body>
    <nav>
    <a href="{{ route('activities.index') }}">Kegiatan</a>
    <a href="{{ route('categories.index') }}">Kategori</a>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>