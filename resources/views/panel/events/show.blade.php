<!-- Etkinlik detay sayfası -->
@extends('panel.layout.app')

@section('title', $event->title)

@section('content')
    <div class="container">


        <!-- Admin ise özel butonlar göster -->
        @if($isAdmin)
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-blue-800">Admin Panel</h3>
                <p class="text-blue-600">Admin olarak özel yetkilere sahipsiniz.</p>
            </div>
        @endif



        <div class="row">
            <div class="col-md-8">
                <h1>{{ $event->title }}</h1>
                <img src="{{ $event->image }}" class="img-fluid mb-3">
                <p>{{ $event->description }}</p>

                <div class="event-details">
                    <p><i class="fas fa-calendar"></i> {{ $event->start_date->format('d.m.Y H:i') }}</p>
                    <p><i class="fas fa-map-marker"></i> {{ $event->location }}</p>
                    <p><i class="fas fa-money-bill"></i>
                        @if($event->price > 0)
                            {{ $event->price }} TL
                        @else
                            Ücretsiz
                        @endif
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Başvuru formu veya durumu -->
                @auth
                    @if($userRegistration)
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
