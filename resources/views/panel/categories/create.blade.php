@extends('panel.layout.app')

@section('title', 'Yeni kategori Oluştur')

@section('content')

    <div class="card-header">
        Kategori Oluştur
    </div>
    <div class="card-body">

        <div class="card-body">

                    <form action="{{route('category.create')}}" method="post" >

                       @csrf

                        <label for="defaultFormControlInput" class="form-label">Kategori Adı</label>
                        <input type="text" name="name" class="form-control">
                        <label for="defaultFormControlInput" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control">
                        <label for="defaultFormControlInput" class="form-label">Açıklama</label>
                        <input type="text" name="description" class="form-control">
                        <button type="submit" class="btn btn-primary mt-3">KAYDET</button>





                </form>


            </div>
        </div>





 </div>
@endsection
