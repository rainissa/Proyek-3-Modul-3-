@extends('layouts.app')

@section('content')
    <h1>Daftar Kegiatan</h1>
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    <a href="{{ route('activities.create') }}">Tambah Kegiatan</a>
    <form method="GET" action="{{ route('activities.index') }}">
        <input
            type="text"
            name="search"
            placeholder="Cari kode atau judul"
            value="{{ request('search') }}"
        >
        <select name="category_id">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected((int) request('category_id') === $category->id)
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <select name="status">
            <option value="">Semua status</option>
            @foreach (['draft', 'published', 'completed'] as $statusOption)
                <option
                    value="{{ $statusOption }}"
                    @selected(request('status') === $statusOption)
                >
                    {{ ucfirst($statusOption) }}
                </option>
            @endforeach
        </select>
        <select name="sort">
            <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
            <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
        </select>
        <button type="submit">Terapkan</button>
        <a href="{{ route('activities.index') }}">Reset</a>
    </form>
    @forelse ($activities as $activity)
        <article>
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->start_at?->format('d M Y H:i') ?? 'Jadwal belum diatur' }}</p>
            <p>Status: {{ $activity->status }}</p>
            <p>Kategori: {{ $activity->category->name }}</p>
        </article>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
    {{ $activities->links() }}
@endsection
