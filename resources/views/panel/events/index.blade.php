<!-- Ana sayfa - Etkinlik listesi -->
@extends('panel.layout.app')

@section('content')
    <div class="container">
        <h1>Etkinlikler</h1>
        <br>
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
        <!-- Arama ve filtre bölümü -->
        <div class="row mb-4 ml-2">
            <div class="col-md-8">
                <form method="GET">
                    <input type="text" name="search" placeholder="Etkinlik ara...">
                    <button type="submit">Ara</button>
                </form>
            </div>
        </div>

        <!-- Etkinlik kartları -->


        <div class="card-body">
            <h4 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Temel Tablo</font></font></h4>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Başlık</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Açıklama</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lokasyon</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Başlangıç Tarihi</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bitiş Tarihi</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ücret</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Durum</font></font></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($etkinlikler as $e)
                    <tr>

                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$e->title}}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$e->location}}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$e->start_date}} </font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$e->end_date}} </font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$e->price}} </font></font></td>
                        <td><label class="badge badge-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$e->status}}</font></font></label></td>
                        <td><a href="{{route('events.index',$e->id)}}" class="btn btn-inverse-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Başvuru Yap</font></font></label></td>

                    @if($isAdmin)
                        <td><label class="btn btn-inverse-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Güncelle</font></font></label></td>
                        <td><label class="btn btn-inverse-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sil</font></font></label></td>
                        @endif




                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


               <!-- Sadece admin görebilir-->



        {{ $events->links() }} <!-- Sayfalama -->

@endsection
