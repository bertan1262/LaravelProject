{{--
    ORTAK FORM — form.blade.php
    Hem create.blade.php hem edit.blade.php tarafından @include ile kullanılır.
    $product değişkeni edit'te dolu, create'te null gelir.
    old() ile hata sonrası değerlerin kaybolmaması sağlanır.
--}}

<div class="row g-4">

    {{-- SOL KOLON --}}
    <div class="col-lg-8">

        {{-- Temel Bilgiler --}}
        <div class="admin-card mb-4">
            <div class="card-header">
                <i class="bi bi-info-circle me-2"></i>Temel Bilgiler
            </div>
            <div class="card-body p-4">

                {{-- Kategori --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Kategori Seçin --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->full_path }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Başlık --}}
                <div class="mb-3">
                    <label for="title" class="form-label">
                        Ürün Adı (title) <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Ürün adını girin"
                           value="{{ old('title', $product->title ?? '') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Anahtar Kelimeler --}}
                <div class="mb-3">
                    <label for="keywords" class="form-label">
                        Anahtar Kelimeler (keywords)
                        <small class="text-muted fw-normal">— SEO için</small>
                    </label>
                    <input type="text" name="keywords" id="keywords"
                           class="form-control @error('keywords') is-invalid @enderror"
                           placeholder="Ör: telefon, akıllı telefon, samsung"
                           value="{{ old('keywords', $product->keywords ?? '') }}">
                    @error('keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Açıklama (SEO) --}}
                <div class="mb-3">
                    <label for="description" class="form-label">
                        Kısa Açıklama (description)
                        <small class="text-muted fw-normal">— SEO meta açıklama</small>
                    </label>
                    <input type="text" name="description" id="description"
                           class="form-control @error('description') is-invalid @enderror"
                           placeholder="Kısa ürün açıklaması"
                           value="{{ old('description', $product->description ?? '') }}">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Detaylı Açıklama (CKEditor) --}}
                <div class="mb-0">
                    <label for="detail" class="form-label">
                        Detaylı Açıklama (detail)
                    </label>
                    <textarea name="detail" id="detail"
                              class="form-control @error('detail') is-invalid @enderror"
                              rows="8">{{ old('detail', $product->detail ?? '') }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

    </div>

    {{-- SAĞ KOLON --}}
    <div class="col-lg-4">

        {{-- Durum --}}
        <div class="admin-card mb-4">
            <div class="card-header">
                <i class="bi bi-toggle-on me-2"></i>Durum
            </div>
            <div class="card-body p-4">
                <select name="status" id="status"
                        class="form-select @error('status') is-invalid @enderror">
                    <option value="0" {{ old('status', $product->status ?? 0) == 0 ? 'selected' : '' }}>
                        Pasif (False)
                    </option>
                    <option value="1" {{ old('status', $product->status ?? 0) == 1 ? 'selected' : '' }}>
                        Aktif (True)
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Fiyat & Stok --}}
        <div class="admin-card mb-4">
            <div class="card-header">
                <i class="bi bi-currency-dollar me-2"></i>Fiyat & Stok
            </div>
            <div class="card-body p-4">

                {{-- Fiyat --}}
                <div class="mb-3">
                    <label for="price" class="form-label">
                        Fiyat (₺) <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">₺</span>
                        <input type="number" name="price" id="price" step="0.01" min="0"
                               class="form-control @error('price') is-invalid @enderror"
                               placeholder="0.00"
                               value="{{ old('price', $product->price ?? '') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Stok --}}
                <div class="mb-3">
                    <label for="stock" class="form-label">
                        Stok Miktarı <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="stock" id="stock" min="0"
                           class="form-control @error('stock') is-invalid @enderror"
                           placeholder="0"
                           value="{{ old('stock', $product->stock ?? 0) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Min Stok --}}
                <div class="mb-3">
                    <label for="minstock" class="form-label">
                        Min. Stok Sınırı
                        <small class="text-muted fw-normal">— kritik eşik</small>
                    </label>
                    <input type="number" name="minstock" id="minstock" min="0"
                           class="form-control @error('minstock') is-invalid @enderror"
                           placeholder="0"
                           value="{{ old('minstock', $product->minstock ?? 0) }}">
                    @error('minstock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- İndirim --}}
                <div class="mb-0">
                    <label for="discount" class="form-label">İndirim (%)</label>
                    <div class="input-group">
                        <input type="number" name="discount" id="discount" min="0" max="100"
                               class="form-control @error('discount') is-invalid @enderror"
                               placeholder="0"
                               value="{{ old('discount', $product->discount ?? 0) }}">
                        <span class="input-group-text">%</span>
                        @error('discount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        {{-- Resim --}}
        <div class="admin-card">
            <div class="card-header">
                <i class="bi bi-image me-2"></i>Ürün Görseli
            </div>
            <div class="card-body p-4">

                {{-- Mevcut resim göster (edit'te) --}}
                @if(!empty($product->image))
                    <div class="mb-3 text-center">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="Mevcut resim"
                             class="img-fluid rounded"
                             style="max-height: 140px;">
                        <p class="text-muted small mt-1">Mevcut resim</p>
                    </div>
                @endif

                <input type="file" name="image" id="image" accept="image/*"
                       class="form-control @error('image') is-invalid @enderror">
                <div class="form-text text-muted mt-1">
                    <i class="bi bi-info-circle me-1"></i>
                    JPG, PNG, GIF, WEBP — Max 2MB
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                {{-- Resim önizleme --}}
                <div id="image-preview" class="mt-3 text-center d-none">
                    <img id="preview-img" src="#" alt="Önizleme"
                         class="img-fluid rounded"
                         style="max-height: 140px;">
                    <p class="text-muted small mt-1">Yeni seçilen resim</p>
                </div>

            </div>
        </div>

    </div>

</div>

<script>
    // Resim önizleme
    document.getElementById('image').addEventListener('change', function () {
        const file  = this.files[0];
        const wrap  = document.getElementById('image-preview');
        const img   = document.getElementById('preview-img');
        if (file) {
            const reader = new FileReader();
            reader.onload = e => { img.src = e.target.result; wrap.classList.remove('d-none'); };
            reader.readAsDataURL(file);
        } else {
            wrap.classList.add('d-none');
        }
    });
</script>
