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
    <label for="activity_date">Tanggal Kegiatan</label>
    <input
        type="date"
        id="activity_date"
        name="activity_date"
        value="{{ old('activity_date', isset($activity) ? $activity->activity_date->format('Y-m-d') : '') }}"
    >
    @error('activity_date')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="status">Status</label>
    <select name="status" id="status">
        @foreach (['Planned', 'Ongoing', 'Done'] as $status)
            <option
                value="{{ $status }}"
                @selected(old('status', $activity->status ?? 'Planned') === $status)
            >
                {{ $status }}
            </option>
        @endforeach
    </select>
    @error('status')
        <p class="error">{{ $message }}</p>
    @enderror
</div>