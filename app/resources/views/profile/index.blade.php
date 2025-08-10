@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">各種設定</h1>

  <div class="card mb-4">
    <div class="card-header">アカウント情報</div>
    <div class="card-body">
      <p><strong>ユーザー名：</strong>{{ $user->name }}</p>
      <p><strong>メールアドレス：</strong>{{ $user->email }}</p>
      <a href="{{ route('user.profiles.edit', $user->id) }}" class="btn btn-outline-primary">アカウント情報を編集</a>
    </div>
  </div>

  <div class="card">
    <div class="card-header">通知設定</div>
    <div class="card-body">
      <p>通知は現在 <strong>{{ $user->notification_on ? '有効' : '無効' }}</strong> です。</p>
      <a href="{{ route('user.settings.notifications') }}" class="btn btn-outline-secondary">通知設定を変更</a>
    </div>
  </div>
</div>
@endsection
