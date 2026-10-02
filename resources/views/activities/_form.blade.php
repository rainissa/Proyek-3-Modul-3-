<div>
    <label for="category_id">Kategori</label>
    <select name="category_id" id="category_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected((int) old('category_id', $activity->category_id ?? 0) === $category->id)
            >
                {{$category->name}}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="error">{{ $message}}</p>
    @enderror
</div>
<div>
    <label for="code">Kode</label>
    <input
        type="text"
        id="code"
        name="code"
        value="{{ old('code', $activity->code ?? '') }}"
    >
    @error('code')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="title">Judul</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $activity->title ?? '') }}"
    >
    @error('title')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="description">Deskripsi</label>
    <textarea id="description" name="description">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="start_at">Waktu Mulai</label>
    <input
        type="datetime-local"
        id="start_at"
        name="start_at"
        value="{{ old('start_at', isset($activity) && $activity->start_at ? $activity->start_at->format('Y-m-d\TH:i') : '') }}"
    >
    @error('start_at')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="end_at">Waktu Selesai</label>
    <input
        type="datetime-local"
        id="end_at"
        name="end_at"
        value="{{ old('end_at', isset($activity) && $activity->end_at ? $activity->end_at->format('Y-m-d\TH:i') : '') }}"
    >
    @error('end_at')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="location">Lokasi</label>
    <input
        type="text"
        id="location"
        name="location"
        value="{{ old('location', $activity->location ?? '') }}"
    >
    @error('location')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="capacity">Kapasitas</label>
    <input
        type="number"
        id="capacity"
        name="capacity"
        value="{{ old('capacity', $activity->capacity ?? '') }}"
    >
    @error('capacity')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="poster">Poster Kegiatan (Opsional)</label>
    <input
        type="file"
        id="poster"
        name="poster"
        accept="image/jpeg,image/png,image/webp"
    >
    @error('poster')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
@if (isset($activity) && $activity->poster_path)
    <div>
        <p>Poster saat ini:</p>
        <img
            src="{{ asset('storage/' . $activity->poster_path) }}"
            alt="Poster {{ $activity->title }}"
            width="200"
        >
    </div>
@endif