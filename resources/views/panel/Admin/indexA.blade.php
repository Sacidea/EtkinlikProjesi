@extends('panel.layout.app')

@section('title', 'Admin Dashboard - Etkinlik Yönetimi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">
            <i class="mdi mdi-view-dashboard text-primary"></i>
            Admin Dashboard - Etkinlik Yönetimi
        </h4>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-info btn-sm" onclick="window.print()">
                <i class="mdi mdi-printer"></i> Yazdır
            </button>
            <button class="btn btn-outline-success btn-sm" onclick="alert('Excel export özelliği yakında eklenecek.')">
                <i class="mdi mdi-file-excel"></i> Excel
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle"></i>
            <strong>Başarılı!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            <strong>Hata!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- İstatistik Kartları -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $events->count() }}</h4>
                            <p class="mb-0">Toplam Etkinlik</p>
                        </div>
                        <div class="align-self-center">
                            <i class="mdi mdi-calendar-multiple" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $events->where('status', 'published')->count() }}</h4>
                            <p class="mb-0">Aktif Etkinlik</p>
                        </div>
                        <div class="align-self-center">
                            <i class="mdi mdi-check-circle" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $events->where('status', 'draft')->count() }}</h4>
                            <p class="mb-0">Taslak Etkinlik</p>
                        </div>
                        <div class="align-self-center">
                            <i class="mdi mdi-clock" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $events->sum(function($event) { return $event->registrations->count(); }) }}</h4>
                            <p class="mb-0">Toplam Başvuru</p>
                        </div>
                        <div class="align-self-center">
                            <i class="mdi mdi-account-group" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Arama ve Filtreleme Formu -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Etkinlik Ara</label>
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ request('search') }}" placeholder="Etkinlik adı ara...">
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Durum Filtresi</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Tüm Durumlar</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Aktif</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Taslak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date" class="form-label">Tarih Filtresi</label>
                    <select class="form-select" id="date" name="date">
                        <option value="">Tüm Tarihler</option>
                        <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Bugün</option>
                        <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Bu Hafta</option>
                        <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Bu Ay</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-magnify"></i> Ara
                        </button>
                    </div>
                </div>
            </form>
            @if(request('search') || request('status') || request('date'))
                <div class="mt-3">
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="mdi mdi-close"></i> Filtreleri Temizle
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Etkinlik Tablosu -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">
                    <i class="mdi mdi-table text-primary"></i>
                    Etkinlik Listesi ({{ $events->count() }} kayıt)
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-white" id="eventsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Etkinlik Adı</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Başvuru Sayısı</th>
                            <th>Durum</th>
                            <th>Organizatör</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $index => $event)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $event->title ?? 'N/A' }}</strong>
                                    @if($event->description)
                                        <br><small class="text-muted">{{ Str::limit($event->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($event->start_date)
                                        <span class="badge bg-info">
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d.m.Y H:i') }}
                                        </span>
                                    @else
                                        <span class="text-muted">Belirtilmemiş</span>
                                    @endif
                                </td>
                                <td>
                                    @if($event->end_date)
                                        <span class="badge bg-warning">
                                            {{ \Carbon\Carbon::parse($event->end_date)->format('d.m.Y H:i') }}
                                        </span>
                                    @else
                                        <span class="text-muted">Belirtilmemiş</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $event->registrations->count() }}</span>
                                </td>
                                <td>
                                    @if($event->status == 'published')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($event->status == 'draft')
                                        <span class="badge bg-warning">Taslak</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $event->status ?? 'Bilinmiyor' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-primary">{{ $event->organizer->name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('events.showPage', $event->id ?? 0) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Görüntüle" target="_blank">
                                            <i class="mdi mdi-eye"></i>
                                        </a>




                                        <form method="POST" action="{{ route('admin.deleteEvent', $event->id) }}"
                                              style="display: inline;"
                                              onsubmit="return confirm('Bu etkinliği silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Sil">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    <i class="mdi mdi-information" style="font-size: 2rem;"></i>
                                    <br>Henüz etkinlik bulunmuyor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
