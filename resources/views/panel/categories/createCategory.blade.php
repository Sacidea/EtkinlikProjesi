@extends('panel.layout.app')

@section('title', 'Yeni Kategori Oluştur')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">
            <i class="mdi mdi-plus-circle text-primary"></i>
            Yeni Kategori Oluştur
        </h4>
        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="mdi mdi-arrow-left"></i> Geri Dön
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            <strong>Hata!</strong> Lütfen aşağıdaki hataları düzeltin:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle"></i>
            <strong>Başarılı!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.create') }}" method="post">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">
                                        <i class="mdi mdi-tag text-primary"></i>
                                        Kategori Adı <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror" 
                                        placeholder="Kategori adını giriniz"
                                        value="{{ old('name') }}"
                                        required
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="slug" class="form-label">
                                        <i class="mdi mdi-link text-primary"></i>
                                        Slug
                                    </label>
                                    <input 
                                        type="text" 
                                        name="slug" 
                                        id="slug"
                                        class="form-control @error('slug') is-invalid @enderror" 
                                        placeholder="kategori-slug"
                                        value="{{ old('slug') }}"
                                    >
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label">
                                <i class="mdi mdi-text text-primary"></i>
                                Açıklama
                            </label>
                            <textarea 
                                name="description" 
                                id="description"
                                class="form-control @error('description') is-invalid @enderror" 
                                rows="4"
                                placeholder="Kategori açıklamasını giriniz"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('events.index') }}" class="btn btn-light">
                                <i class="mdi mdi-close"></i> İptal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save"></i> Kategori Oluştur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Kategori adından otomatik slug oluşturma
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const slug = name
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
