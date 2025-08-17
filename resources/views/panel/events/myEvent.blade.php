<!-- Orgaanizer Etkinlik Yönetimi -->
@extends('panel.layout.app')

@section('content')
    <div class="container">
        <h1>Organizasyonlarınız</h1>

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

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Etkinlik</th>

                    <th>Etkinlik Yeri</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                    <th>Ücret</th>
                    <th>Kapasite</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @auth
                    @foreach($events as $myEvent)
                        <tr>
                            <td>{{ $myEvent->title }}</td>

                            <td>{{ $myEvent->location }}</td>
                            <td>{{ $myEvent->start_date->format('d/m/Y H:i') }}</td>
                            <td>{{ $myEvent->end_date->format('d/m/Y H:i') }}</td>
                             <td>{{ $myEvent->price }} TL</td>
                             <td>{{ $myEvent->max_participants }} </td>
                            <td>
                            <span class="badge badge-{{$myEvent->status === 'published' ? 'success' : ($myEvent->status === 'rejected' ? 'warning' : '') }}">
                                {{ ucfirst($myEvent->status) }}<!--ucfirst string in ilk karakterini büyük harfe çevirir-->
                            </span>
                            </td>



                            <td>

                                <a href="{{ route('events.updatePage', $myEvent->id) }}" class="btn btn-sm btn-primary">Güncelle</a>


                                <form method="POST" action="{{ route('organizer.events.delete', $myEvent->id) }}" style="display:inline;">
                                    @csrf

                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                </form>



                            </td>
                        </tr>
                    @endforeach
                @endauth
                </tbody>
            </table>
        </div>

    </div>
@endsection













