<!-- Ana sayfa - Etkinlik listesi -->
@extends('panel.layout.app')

@section('content')
    <div class="container">
        <h1>Etkinlikler</h1>

        <br>
        <hr>
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e)
                    {{$e}}<br>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Arama bölümü -->
        <div class="row mb-4 ml-2">
            <div class="col-md-8">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Etkinlik ara...">
                        <button type="submit" class="btn btn-primary">Ara</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Etkinlik kartları -->
        <div class="row">
            @foreach($etkinlikler as $e)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($e->image)
                            <img src="{{ asset('panel/assets/images/'.$e->image) }}"
                                 alt="Event Image"
                                 class="card-img-top"
                                 style="object-fit: cover; height: 200px;">
                        @else
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center"
                                 style="height: 200px;">
                                Resim bulunamadı
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $e->title }}</h5>
                            <div class="card-text">
                                <p><strong>Başlangıç:</strong> {{ $e->start_date }}</p>
                                <p><strong>Bitiş:</strong> {{ $e->end_date }}</p>
                                <p><strong>Lokasyon:</strong> {{ $e->location }}</p>
                                <p><strong>Ücret:</strong> {{ $e->price }} TL</p>
                            </div>
                        </div>

                        <div class="card-footer bg-gray-dark">
                            <a href="{{ route('events.showPage', ['event' => $e->id]) }}"
                               class="btn btn-info btn-block">
                                Etkinlik Detayları
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Sayfalama -->

    </div>
@endsection
