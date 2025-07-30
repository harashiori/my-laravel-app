@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">各種設定</h1>

  <div class="card mb-4">
    <div class="card-header">アカウント情報</div>
    <div class="card-body">
      <p><strong>ユーザー名：</strong> 山田太郎</p>
      <p><strong>メールアドレス：</strong> user@example.com</p>
      <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">アカウント情報を編集</a>
    </div>
  </div>

  <div class="card">
    <div class="card-header">通知設定</div>
    <div class="card-body">
      <p>通知は現在 <strong>有効</strong> です。</p>
      <a href="{{ route('settings.notifications') }}" class="btn btn-outline-secondary">通知設定を変更</a>
    </div>
  </div>
</div>
@endsection
