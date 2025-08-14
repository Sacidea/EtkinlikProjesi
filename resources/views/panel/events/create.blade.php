@extends('panel.layout.app')

@section('title', 'Yeni Etkinlik Oluştur')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">
            <i class="mdi mdi-calendar-plus text-primary"></i>
            Yeni Etkinlik Oluştur
        </h4>
        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="mdi mdi-arrow-left"></i> Geri Dön
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            <strong>Hata!</strong> Lütfen aşağıdaki hataları düzeltin:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}

                </div>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('events.create') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Temel Bilgiler -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="mdi mdi-information"></i> Temel Bilgiler
                                </h5>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">
                                        <i class="mdi mdi-format-title text-primary"></i>
                                        Etkinlik Başlığı <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           value="{{ old('title') }}"
                                           placeholder="Etkinlik başlığını giriniz"
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="category_id" class="form-label">
                                        <i class="mdi mdi-tag text-primary"></i>
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                            id="category_id"
                                            name="category_id"
                                            required>
                                        <option value="">Kategori Seçiniz</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Açıklama -->
                        <div class="form-group mb-4">
                            <label for="description" class="form-label">
                                <i class="mdi mdi-text text-primary"></i>
                                Etkinlik Açıklaması <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="5"
                                      placeholder="Etkinlik hakkında detaylı bilgi veriniz"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tarih ve Saat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="mdi mdi-clock"></i> Tarih ve Saat
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="start_date" class="form-label">
                                        <i class="mdi mdi-calendar-start text-primary"></i>
                                        Başlangıç Tarihi <span class="text-danger">*</span>
                                    </label>
                                    <input type="datetime-local"
                                           class="form-control @error('start_date') is-invalid @enderror"
                                           id="start_date"
                                           name="start_date"
                                           value="{{ old('start_date') }}"
                                           required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="end_date" class="form-label">
                                        <i class="mdi mdi-calendar-end text-primary"></i>
                                        Bitiş Tarihi
                                    </label>
                                    <input type="datetime-local"
                                           class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date"
                                           name="end_date"
                                           value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Konum ve Detaylar -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="mdi mdi-map-marker"></i> Konum ve Detaylar
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="location" class="form-label">
                                        <i class="mdi mdi-map-marker text-primary"></i>
                                        Etkinlik Yeri <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('location') is-invalid @enderror"
                                           id="location"
                                           name="location"
                                           value="{{ old('location') }}"
                                           placeholder="Örn: İstanbul Kongre Merkezi"
                                           required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label">
                                        <i class="mdi mdi-currency-try text-primary"></i>
                                        Ücret (TL)
                                    </label>
                                    <div class="input-group">
                                        <input type="number"
                                               class="form-control @error('price') is-invalid @enderror"
                                               id="price"
                                               name="price"
                                               value="{{ old('price', 0) }}"
                                               min="0"
                                               step="0.01"
                                               placeholder="0.00">
                                        <span class="input-group-text">₺</span>
                                    </div>
                                    <small class="form-text text-muted">Ücretsiz için 0</small>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="capacity" class="form-label">
                                        <i class="mdi mdi-account-group text-primary"></i>
                                        Kapasite
                                    </label>
                                    <input type="number"
                                           class="form-control @error('capacity') is-invalid @enderror"
                                           id="capacity"
                                           name="capacity"
                                           value="{{ old('capacity') }}"
                                           min="1"
                                           placeholder="Sınırsız">
                                    <small class="form-text text-muted">Boş = sınırsız</small>
                                    @error('capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Görsel ve Durum -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="image" class="form-label">
                                        <i class="mdi mdi-image text-primary"></i>
                                        Etkinlik Görseli
                                    </label>
                                    <input type="file"
                                           class="form-control @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           accept="image/*">
                                    <small class="form-text text-muted">JPG, PNG, GIF (Maks: 2MB)</small>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="mdi mdi-toggle-switch text-primary"></i>
                                        Etkinlik Durumu
                                    </label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="status"
                                                   id="status_active"
                                                   value="published"
                                                   {{ old('status', 'published') == 'published' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_active">
                                                <span class="badge bg-success">Aktif</span>
                                                <small class="d-block text-muted">Hemen yayınla</small>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="status"
                                                   id="status_draft"
                                                   value="draft"
                                                   {{ old('status') == 'draft' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_draft">
                                                <span class="badge bg-warning">Taslak</span>
                                                <small class="d-block text-muted">Daha sonra yayınla</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Butonlar -->
                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('events.index') }}" class="btn btn-light">
                                <i class="mdi mdi-close"></i> İptal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save"></i> Etkinliği Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bitiş tarihinin başlangıç tarihinden önce olmamasını sağla
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('end_date');
            endDateInput.min = startDate;

            // Eğer bitiş tarihi başlangıç tarihinden önceyse, bitiş tarihini sıfırla
            if (endDateInput.value && endDateInput.value < startDate) {
                endDateInput.value = '';
            }
        });

        // Dosya boyutu kontrolü
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    alert('Dosya boyutu 2MB\'dan büyük olamaz.');
                    this.value = '';
                }
            }
        });
    </script>
@endsection
