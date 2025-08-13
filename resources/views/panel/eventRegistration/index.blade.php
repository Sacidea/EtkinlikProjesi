@extends('panel.layout.app')

@section('content')
    <div class="container">
        <h2>Etkinliklerime Yapılan Başvurular</h2>

        @if($registrations->isEmpty())
            <p>Henüz başvuru bulunmuyor.</p>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Etkinlik</th>
                        <th>Başvuran</th>
                        <th>Durum</th>
                        <th>Başvuru Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @auth
                    @foreach($registrations as $registration)
                        <tr>
                            <td>{{ $registration->event->title }}</td>
                            <td>{{ $registration->user->name }}</td>
                            <td>
                            <span class="badge badge-{{ $registration->status === 'approved' ? 'success' : ($registration->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($registration->status) }}//ucfirst string in ilk karakterini büyük harfe çevirir
                            </span>
                            </td>
                            <td>{{ $registration->registered_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($registration->status === 'pending')<!--Sadece onay bekleyenleri getir-->
                                    <form method="POST" action="{{ route('event-registrations.update-status', $registration) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-success">Onayla</button>
                                    </form>

                                    <form method="POST" action="{{ route('event-registrations.update-status', $registration) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-sm btn-danger">Reddet</button>
                                    </form>


                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endauth
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
