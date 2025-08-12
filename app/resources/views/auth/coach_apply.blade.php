@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 500px;">
  <h2 class="mb-4 text-center">コーチ申請フォーム</h2>
  <form method="POST" action="{{ route('coach.apply.submit') }}">
    
    <!-- エラーメッセージ表示 -->
    @if ($errors->any())
      <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
      </div>
    @endif
  
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
  
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
      <label for="organization" class="form-label">所属</label>
      <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization') }}" required>
    </div>

   <div class="mb-3">
      <label for="password" class="form-label">パスワード</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">パスワード確認</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">申請する</button>
  </form>
</div>
@endsection