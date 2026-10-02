@extends('layouts.app')

@section('content')
    <h1>Sampah Kegiatan</h1>
    @forelse ($activities as $activity)
        <article>
            <h2>{{ $activity->title }}</h2>
            <p>Kode: {{ $activity->code }}</p>
            <p>Kategori: {{ $activity->category->name }}</p>
            <p>Dihapus: {{ $activity->deleted_at->format('d M Y H:i') }}</p>
            <form method="POST" action="{{ route('activities.restore', $activity) }}">
                @csrf
                <button type="submit">Pulihkan</button>
            </form>
        </article>
    @empty
        <p>Tidak ada kegiatan yang dihapus.</p>
    @endforelse
    {{ $activities->links() }}
    <a href="{{ route('activities.index') }}">Kembali</a>
@endsection