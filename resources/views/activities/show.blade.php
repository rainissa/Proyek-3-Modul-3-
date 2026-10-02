@extends('layouts.app')

@section('content')
    <h1>{{ $activity->title }}</h1>
    @if ($activity->poster_path)
        <div>
            <h2>Poster Kegiatan</h2>
            <img
                src="{{ asset('storage/' . $activity->poster_path) }}"
                alt="Poster {{ $activity->title }}"
                style="max-width: 400px; height: auto;"
            >
        </div>
    @endif
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif
    <p>{{ $activity->description }}</p>
    <p>Mulai: {{ $activity->start_at?->format('d M Y H:i') ?? '-' }}</p>
    <p>Selesai: {{ $activity->end_at?->format('d M Y H:i') ?? '-' }}</p>
    <p>Lokasi: {{ $activity->location ?? '-' }}</p>
    <p>Kapasitas: {{ $activity->capacity ?? '-' }}</p>
    <p>Pendaftar: {{ $activity->registered_count }} / {{ $activity->capacity ?? '-' }}</p>
    <p>Kode: {{ $activity->code }}</p>
    <p>Kategori: {{ $activity->category->name }}</p>
    <p>Status: {{ $activity->status }}</p>
    <form method="POST" action="{{ route('activities.publish', $activity) }}">
        @csrf
        <button type="submit">Publikasikan</button>
    </form>
    <form method="POST" action="{{ route('activities.complete', $activity) }}">
        @csrf
        <button type="submit">Selesaikan</button>
    </form>
    <h2>Daftar Peserta</h2>
    <form method="POST" action="{{ route('registrations.store', $activity) }}">
        @csrf
        <label for="participant_name">Nama</label>
        <input type="text" id="participant_name" name="participant_name" value="{{ old('participant_name') }}">
        @error('participant_name')
            <p class="error">{{ $message }}</p>
        @enderror
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror
        <button type="submit">Daftar</button>
    </form>
    <a href="{{ route('activities.edit', $activity) }}">Ubah</a>
    <form method="POST" action="{{ route('activities.destroy', $activity) }}" onsubmit="return confirm('Hapus kegiatan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
    <a href="{{ route('activities.index') }}">Kembali</a>
@endsection