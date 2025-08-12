@extends('panel.layout.app')

@section('title', $event->title ?? 'Etkinlik Detayı')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <h1>{{ $event->title ?? 'Etkinlik Başlığı' }}</h1>

                @if($event->image)
                    <img src="{{ asset($event->image) }}"
                         alt="Event Image"
                         style="max-width: 500px;">
                @else
                    <p>Resim bulunamadı</p>
                @endif

                <p>{{ $event->description ?? 'Açıklama yok' }}</p>

                <div class="event-details">
                    <p><i class="fas fa-calendar"></i> {{ $event->start_date }}</p>
                    <p><i class="fas fa-calendar"></i> {{ $event->end_date }}</p>
                    <p><i class="fas fa-map-marker"></i> {{ $event->location ?? 'Lokasyon belirtilmemiş' }}</p>
                    <p><i class="fas fa-money-bill"></i>
                        {{ $event->price > 0 ? $event->price . ' TL' : 'Ücretsiz' }}
                    </p>
                </div>
            </div>

            <div class="col-md-9">
                @auth
                    @if($userRegistration ?? false)
                        <div class="alert alert-info">
                            Başvuru Durumunuz: {{ $userRegistration->status }}
                        </div>
                    @else
                        <form method="POST" action="{{ route('events.register', $event) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg">Başvuru Yap</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Başvuru için giriş yapın</a>
                @endauth
            </div>
        </div>
    </div>




@endsection
