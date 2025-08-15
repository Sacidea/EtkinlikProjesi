@extends('panel.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>Kullanıcı Listesi</h1>
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

                    <div class="card-header">
                        <h4 class="card-title">Kullanıcı Yönetimi</h4>
                        <p class="card-description">Sistemdeki tüm kullanıcıları görüntüleyin ve yönetin</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th style="width: 150px;">👤 Kullanıcı Adı</th>
                                    <th style="width: 200px;">📧 Email</th>
                                    <th style="width: 120px;">📅 Kayıt Tarihi</th>
                                    <th style="width: 120px;">🎭 Mevcut Rol</th>
                                    <th style="width: 200px;">⚙️ İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at->format('d.m.Y H:i')}}</td>
                                    <td>
                                        <span class="badge bg-primary text-white">{{$user->role ?? 'participant'}}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- Rol Güncelleme Formu -->
                                            <form method="POST" action="{{route('admin.update-user-role', $user)}}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="form-select form-select-sm">
                                                    <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                                    <option value="organizer" {{$user->role == 'organizer' ? 'selected' : ''}}>Organizer</option>
                                                    <option value="participant" {{$user->role == 'participant' ? 'selected' : ''}}>Katılımcı</option>
                                                </select>
                                                <button class="btn btn-success btn-sm" type="submit" title="Rol Güncelle">
                                                    <i class="mdi mdi-account-edit"></i> Güncelle
                                                </button>
                                            </form>

                                            <!-- Kullanıcı Silme Formu -->
                                            <form method="POST" action="{{route('admin.delete-user', $user)}}" style="display: inline;"
                                                  onsubmit="return confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit" title="Kullanıcı Sil">
                                                    <i class="mdi mdi-delete"></i> Sil
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <p class="text-muted">Toplam: {{ $users->count() }} kullanıcı bulundu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
