@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">コーチダッシュボード</h1>

  <div class="card mb-4">
    <div class="card-header">担当ユーザー一覧</div>
    <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          山田太郎
          <a href="{{ route('coach.user_detail', 1) }}" class="btn btn-sm btn-outline-primary">詳細</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          鈴木花子
          <a href="{{ route('coach.user_detail', 2) }}" class="btn btn-sm btn-outline-primary">詳細</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="card">
    <div class="card-header">ユーザー招待</div>
    <div class="card-body">
      @php
        $inviteCreatedAt = \Carbon\Carbon::parse($inviteCreatedAt ?? now()->subDays(6));
        $isExpired = $inviteCreatedAt->lt(now()->subDays(5));
      @endphp

      @if(!$isExpired)
        <p>以下のURLから新規ユーザーを招待できます。</p>
        <input type="text" class="form-control mb-2" value="{{ $inviteUrl }}" readonly>
        <p class="text-muted">発行日時：{{ $inviteCreatedAt->format('Y-m-d H:i') }}（有効期限：{{ $inviteCreatedAt->addDays(5)->format('Y-m-d H:i') }}まで）</p>
        <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ $inviteUrl }}')">コピー</button>
      @else
        <p class="text-danger">現在の招待URLは有効期限切れです（{{ $inviteCreatedAt->format('Y-m-d H:i') }} 発行）。</p>
        <form method="POST" action="">
          @csrf
          <button type="submit" class="btn btn-primary">新しい招待リンクを発行</button>
        </form>
      @endif
    </div>
  </div>
</div>
@endsection