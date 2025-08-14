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

                    <a href="#" class="list-group-item list-group-item-action list-group-item-info">Etkinlik: {{ $myRegistration->event->title}}</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-light">BaşLangıç Tarihi: {{  $myRegistration->created_at->format('d.m.Y H:i') }}</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-light">Başvuru Durumu: {{ $myRegistration->status }}</a>

                    @if($myRegistration->status == 'pending')
                        <form method="post" action="{{route('myRegistrationCancel', $myRegistrations=$myRegistration->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg">İptal Et</button>
                        </form>
                    @else
                        <form method="post" action="{{route('myRegistrationCancel', $myRegistrations=$myRegistration->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-lg">İptal Et</button>
                        </form>
                    @endif


        </div>

</div>
    @endforeach

    <script>
        function showWarning(status, id) {
            const warningDiv = document.getElementById('warning-' + id);
            if (warningDiv.style.display === 'none') {
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        }
    </script>
@endsection
