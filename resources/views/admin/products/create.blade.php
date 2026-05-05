@extends('admin.layout')
@section('title','Yangi mahsulot')
@section('topbar-actions')
  <a href="{{ route('admin.products.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Orqaga</a>
@endsection

@section('content')
<div class="card">
  <div class="card-header"><span class="card-title">Yangi mahsulot qo'shish</span></div>
  <div style="padding:28px">
    @if($errors->any())
    <div class="alert alert-error">
      <i class="fas fa-exclamation-circle"></i>
      <ul style="list-style:none;margin:0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
      @csrf
      @include('admin.products._form')
      <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Saqlash</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Bekor qilish</a>
      </div>
    </form>
  </div>
</div>
@endsection
