@extends('layouts.app')

@section('content')
    <h1>Daftar Kategori</h1>
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif
    @forelse ($categories as $category)
        <article>
            <h2>{{ $category->name }}</h2>
            <p>Jumlah kegiatan: {{ $category->activities_count }}</p>
            <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </article>
    @empty
        <p>Belum ada kategori.</p>
    @endforelse
@endsection