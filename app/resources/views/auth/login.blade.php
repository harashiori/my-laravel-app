@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 400px;">
  <h2 class="mb-4 text-center">ログイン</h2>
  <form method="POST" action="{{ route('login.post') }}">

  <!-- エラーメッセージ表示 -->
  @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
  @endif

    @csrf

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" id="email" name="email" required autofocus>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">パスワード</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="remember" name="remember">
      <label class="form-check-label" for="remember">ログイン状態を保持する</label>
    </div>

    <div>
      <select name="role" class="form-select form-select-sm" required>
        <option value="user">ユーザー</option>
        <option value="coach">コーチ</option>
        <option value="admin">管理者</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary w-100">ログイン</button>

    <div class="text-center mt-3">
      <a href=#>パスワードをお忘れですか？</a>
    </div>
  </form>

  <hr>

  <div class="text-center">
    <p class="mb-2">まだアカウントをお持ちでない方はこちら：</p>
    <a href="{{ route('register') }}" class="btn btn-outline-success w-100 mb-2">新規ユーザー登録</a>
    <a href="{{ route('coach.apply') }}" class="btn btn-outline-secondary w-100">コーチ申請はこちら</a>
  </div>
</div>
@endsection
