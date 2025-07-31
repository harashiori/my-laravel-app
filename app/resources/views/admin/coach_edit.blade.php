@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">コーチ詳細：佐藤コーチ</h1>

  <div class="mb-4">
    <h5>登録情報</h5>
    <p><strong>メール：</strong> sato@coach.com</p>
    <p><strong>登録日：</strong> 2025-04-15</p>
  </div>

  <div class="mb-4">
    <h5>担当ユーザー一覧</h5>
    <ul class="list-group">
      <li class="list-group-item">山田太郎</li>
      <li class="list-group-item">鈴木花子</li>
    </ul>
  </div>

  <form method="POST" action="">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" onclick="return confirm('このコーチを削除してもよろしいですか？')">コーチ削除</button>
  </form>
</div>
@endsection
