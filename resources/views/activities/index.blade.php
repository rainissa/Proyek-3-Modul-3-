@extends('layouts.app')

@section('content')
    <h1>Daftar Kegiatan</h1>
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    <a href="{{ route('activities.create') }}">Tambah Kegiatan</a>
    <div>
        <a href="{{ route('activities.index') }}">Semua</a>
        <a href="{{ route('activities.index', ['status' => 'Planned']) }}">Planned</a>
        <a href="{{ route('activities.index', ['status' => 'Ongoing']) }}">Ongoing</a>
        <a href="{{ route('activities.index', ['status' => 'Done']) }}">Done</a>
    </div>
    @forelse ($activities as $activity)
        <article>
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->activity_date->format('d M Y') }}</p>
            <p>Status: {{ $activity->status }}</p>
        </article>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
@endsection
