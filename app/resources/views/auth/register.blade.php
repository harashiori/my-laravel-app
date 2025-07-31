@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 500px;">
  <h2 class="mb-4 text-center">ユーザー登録</h2>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">パスワード</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">パスワード確認</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-success w-100">登録</button>
  </form>
</div>
@endsection