<div>
    <label for="category_id">
        Kategori
    </label>

    <select
        id="category_id"
        name="category_id"
    >
        <option value="">
            Pilih kategori
        </option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(
                    old(
                        'category_id',
                        $activity->category_id ?? ''
                    ) == $category->id
                )
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<br>

<div>
    <label for="code">
        Kode
    </label>

    <input
        id="code"
        type="text"
        name="code"
        value="{{ old(
            'code',
            $activity->code ?? ''
        ) }}"
    >
</div>

<br>

<div>
    <label for="title">
        Judul
    </label>

    <input
        id="title"
        type="text"
        name="title"
        value="{{ old(
            'title',
            $activity->title ?? ''
        ) }}"
    >
</div>

<br>

<div>
    <label for="description">
        Deskripsi
    </label>

    <textarea
        id="description"
        name="description"
    >{{ old(
        'description',
        $activity->description ?? ''
    ) }}</textarea>
</div>

<br>

<div>
    <label for="start_at">
        Waktu Mulai
    </label>

    <input
        id="start_at"
        type="datetime-local"
        name="start_at"
        value="{{ old(
            'start_at',
            isset($activity) && $activity->start_at
                ? $activity->start_at->format('Y-m-d\TH:i')
                : ''
        ) }}"
    >
</div>

<br>

<div>
    <label for="end_at">
        Waktu Selesai
    </label>

    <input
        id="end_at"
        type="datetime-local"
        name="end_at"
        value="{{ old(
            'end_at',
            isset($activity) && $activity->end_at
                ? $activity->end_at->format('Y-m-d\TH:i')
                : ''
        ) }}"
    >
</div>

<br>

<div>
    <label for="location">
        Lokasi
    </label>

    <input
        id="location"
        type="text"
        name="location"
        value="{{ old(
            'location',
            $activity->location ?? ''
        ) }}"
    >
</div>

<br>

<div>
    <label for="capacity">
        Kapasitas
    </label>

    <input
        id="capacity"
        type="number"
        name="capacity"
        min="1"
        max="500"
        value="{{ old(
            'capacity',
            $activity->capacity ?? ''
        ) }}"
    >
</div>

<br>

<div>
    <label for="poster">
        Poster
    </label>

    <input
        id="poster"
        type="file"
        name="poster"
        accept="image/*"
    >
</div>

<br>

<button type="submit">
    Simpan
</button>