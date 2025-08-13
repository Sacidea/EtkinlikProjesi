@extends('panel.layout.app')

@section('title', $event->title ?? 'Başvurularım')

@section('content')

    <h1>Başvurularınız</h1>
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

    @foreach($myRegistrations as $myRegistration)

    <div class="card mt-5">

        <div class="list-group">

                    <a href="#" class="list-group-item list-group-item-action list-group-item-info">{{ $myRegistration->event->title}}</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{  $myRegistration->created_at->format('d.m.Y H:i') }}</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ $myRegistration->status }}</a>


        </div>

</div>
    @endforeach

@endsection
