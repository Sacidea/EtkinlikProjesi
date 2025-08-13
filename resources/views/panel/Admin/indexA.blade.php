@extends('panel.layout.app')

@section('title', 'Yeni kategori Oluştur')

@section('content')

    <div class="card-header">
        Kategori Oluştur

    </div>  @if($errors->any())
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

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ETKİNLİK  YÖNETİMİ</font></font></h4>
                <p class="card-description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font><code>.table-bordered</code>
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">#</font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Etkinlik </font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Başlangıç Tarihi</font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bitiş Tarihi</font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Başvuru Sayısı</font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Durum</font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Açıklama</font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Organizer</font></font></th>
                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">İşlemler</font></font></th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($event_registrations as $registration)
                            <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font></td>
                            <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->name}}</font></font></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->created_at}}</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->update_at}}</font></font></td>


                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->total_registrations}}</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->status}}</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->notes}}</font></font></td>

                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->organizer_name}}</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$registration->statuses}}</font></font></td>







                        </tr>
@endforeach




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





@endsection
