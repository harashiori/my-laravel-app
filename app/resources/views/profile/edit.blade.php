@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">プロフィール設定編集</h2>

  <form method="POST" action="{{ route( 'user.profiles.update', $user->id ) }}">
    @csrf
    @method('PUT')

     <div class="mb-3">
      <label class="form-label">ユーザー名</label>
      <input type="name" name="name" value="{{ old('name', $user->name) }}" class="form-control">
      @error('name')
        <div class="text-danger">{{ $message }}</div> 
      @enderror
    </div>
    
    <div class="mb-3">
      <label class="form-label">メールアドレス</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
      @error('email')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">パスワード</label>
      <input type="password" name="password" class="form-control">
      @error('password')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">パスワード（確認）</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">変更</button>
    </div>
  </form>
      <!-- 削除フォームはここで独立 -->

  <form method="POST" action="{{ route('user.profiles.destroy', $user->id) }}" onsubmit="return confirm('本当にアカウントを削除しますか？')">
    @csrf
    @method('DELETE')
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-outline-danger">
          アカウント削除
        </button>
      </form>
    </div>
  </form>
</div>
@endsection