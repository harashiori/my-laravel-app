@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">プロフィール設定編集</h1>

  <form method="POST" action="">
    @csrf
    @method('PUT')

     <div class="mb-3">
      <label class="form-label">ユーザー名</label>
      <input type="name" name="name" value="山田太郎" class="form-control">
    </div>
    
    <div class="mb-3">
      <label class="form-label">メールアドレス</label>
      <input type="email" name="email" value="user@example.com" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">パスワード</label>
      <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">パスワード（確認）</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">変更</button>
      <button type="button" class="btn btn-outline-danger">アカウント削除</button>
    </div>
  </form>
</div>
@endsection