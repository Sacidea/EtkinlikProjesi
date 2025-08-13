<!-- Yeni etkinlik oluşturma sayfası -->
@extends('panel.layout.app')

@section('title', 'Yeni Etkinlik Oluştur')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <i class="fas fa-plus-circle ml-5"></i> Yeni Etkinlik Oluştur
                        </h2>
                    </div>
                    <div class="card-body ml-5 p-3 ">
                        <!-- Hata mesajları -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('events.create') }}" enctype="multipart/form-data">
                            @csrf


                            <!-- Etkinlik Başlığı -->
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading"></i>
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

                            <!-- Etkinlik Açıklaması -->
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left"></i> Etkinlik Açıklaması
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="start_date" class="form-label">
                                            <i class="fas fa-calendar"></i> Başlangıç Tarihi
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
                                            <i class="fas fa-calendar-check"></i> Bitiş Tarihi
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

                            <!-- Konum -->
                            <div class="form-group mb-3">
                                <label for="location" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i> Etkinlik Yeri
                                </label>
                                <input type="text"
                                       class="form-control @error('location') is-invalid @enderror"
                                       id="location"
                                       name="location"
                                       value="{{ old('location') }}"
                                       placeholder="Örn: İstanbul Kongre Merkezi, Ankara Üniversitesi Konferans Salonu"
                                       required>
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fiyat -->
                            <div class="form-group mb-3">
                                <label for="price" class="form-label">
                                    <i class="fas fa-money-bill"></i> Etkinlik Ücreti (TL)
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
                                    <span class="input-group-text">TL</span>
                                </div>
                                <small class="form-text text-muted">Ücretsiz etkinlikler için 0 yazınız</small>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kapasite -->
                            <div class="form-group mb-3">
                                <label for="capacity" class="form-label">
                                    <i class="fas fa-users"></i> Etkinlik Kapasitesi
                                </label>
                                <input type="number"
                                       class="form-control @error('capacity') is-invalid @enderror"
                                       id="capacity"
                                       name="capacity"
                                       value="{{ old('capacity') }}"
                                       min="1"
                                       placeholder="Maksimum katılımcı sayısı">
                                <small class="form-text text-muted">Boş bırakırsanız sınırsız kapasite olur</small>
                                @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Etkinlik Görseli -->
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">
                                    <i class="fas fa-image"></i> Etkinlik Görseli
                                </label>
                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       accept="image/*">
                                <small class="form-text text-muted">JPG, PNG veya GIF formatında görsel yükleyebilirsiniz (Maks: 2MB)</small>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="form-group mb-3">
                                <label for="category_id" class="form-label">
                                    <i class="fas fa-tag"></i> Kategori
                                </label>
                                <select class="form-control @error('category_id') is-invalid @enderror "
                                        id="category_id"
                                        name="category_id">
                                    <option value="" disabled>Kategori Seçiniz</option>

                                    @foreach($categories as $k)

                                    <option value="{{$k->id}}"  >{{$k->name}}</option>
                                        @endforeach
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Durum -->
                            <div class="form-group mb-4">
                                <label class="form-label">
                                    <i class="fas fa-toggle-on"></i> Etkinlik Durumu
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="status"
                                           id="status_active"
                                           value="published"
                                        {{ old('status', 'published') == 'published' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_active">
                                        <span class="badge bg-success p-1  " >Aktif</span> - Etkinlik hemen yayınlanır
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
                                        <span class="badge bg-warning p-1">Taslak</span> - Daha sonra yayınlamak için bekler
                                    </label>
                                </div>
                            </div>

                            <!-- Butonlar -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('events.index') }}" class="btn btn-secondary me-md-2 btn-lg">
                                    <i class="fas fa-times"></i> İptal
                                </a>
                                <button type="submit" class="btn btn-info btn-lg">
                                    <i class="fas fa-save"></i> Etkinliği Kaydet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
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
