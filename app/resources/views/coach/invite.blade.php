@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">ユーザー招待</h1>

  <div class="card mb-4">
    <div class="card-header">招待URLを発行</div>
    <div class="card-body">
      <form method="POST" action="">
        @csrf
        <div class="mb-3">
          <label class="form-label">メールアドレス</label>
          <input type="email" name="email" class="form-control" placeholder="user@example.com" required>
        </div>
        <button type="submit" class="btn btn-primary">招待リンクを生成</button>
      </form>
    </div>
  </div>

  @isset($inviteUrl)
  <div class="card">
    <div class="card-header">生成された招待リンク</div>
    <div class="card-body">
      <input type="text" class="form-control mb-2" value="{{ $inviteUrl }}" readonly>
      <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ $inviteUrl }}')">コピー</button>
    </div>
  </div>
  @endisset
</div>
@endsection