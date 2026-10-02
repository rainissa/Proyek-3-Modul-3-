@extends('layouts.app')

@section('content')
    <h1>{{ $activity->title }}</h1>
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
    <a href="{{ route('activities.edit', $activity) }}">Ubah</a>
    <form method="POST" action="{{ route('activities.destroy', $activity) }}" onsubmit="return confirm('Hapus kegiatan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
    <a href="{{ route('activities.index') }}">Kembali</a>
@endsection