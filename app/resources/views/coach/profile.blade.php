@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">各種設定</h2>

  <div class="card mb-4">
    <div class="card-header">アカウント情報</div>
    <div class="card-body">
        <p><strong>ユーザー名：</strong>{{ $coach->name }}</p>
        <p><strong>メールアドレス：</strong>{{ $coach->email }}</p>
        <p><strong>所属：</strong>{{ $coach->organization }}</p>
        <a href="{{ route('coach.coach-profiles.edit', $coach->id) }}" class="btn btn-outline-primary">アカウント情報を編集</a>
    </div>
  </div>

  </div>
</div>
@endsection