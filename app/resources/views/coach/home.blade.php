@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">コーチダッシュボード</h1>

  <div class="card mb-4">
    <div class="card-header">担当ユーザー一覧</div>
    <div class="card-body">
      <ul class="list-group">

        @forelse ($assignedUsers as $user)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $user->name }}
            <a href="{{ route('coach.users.show', ['user' => $user->id]) }}" class="btn btn-sm btn-outline-primary">詳細</a>
          </li>
        @empty
          <li class="list-group-item">担当ユーザーはいません。</li>
        @endforelse

      </ul>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">過去のコメント</div>
    <div class="card-body">
      @forelse ($comments as $comment)
        <p>
          <strong>{{ $comment->user->name }}:</strong> <!-- コメント対象のユーザー -->
          {{ $comment->comment }}
          <small class="text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
        </p>
      @empty
        <p>まだコメントはありません</p>
      @endforelse
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">ユーザー招待</div>
      <div class="card-body">

        @php
          $coach = auth('coach')->user();
          $inviteUrl = $coach->invite_token 
            ? route('register', ['token' => $coach->invite_token]) 
            : null;
          $isExpired = $coach->invite_token_expires_at 
            ? now()->gt($coach->invite_token_expires_at) 
            : null;
        @endphp

        <!-- 未発行状態  -->
        @if(!$inviteUrl)
          <p>まだ招待リンクは発行されていません。</p>
          <button class="btn btn-primary" id="generateInviteBtn">招待リンクを発行</button>

        <!-- 有効期限切れ -->
        @elseif($isExpired)
          <p class="text-danger">招待リンクは有効期限切れです（{{ ($coach->invite_token_expires_at)->addDays(5) }} まで有効でした）。</p>
          <button class="btn btn-primary" id="generateInviteBtn">新しい招待リンクを発行</button>

        <!-- 有効期限内 -->
        @else
          <p>以下のURLから新規ユーザーを招待できます。</p>
          <input type="text" id="inviteUrl" class="form-control mb-2" value="{{ $inviteUrl ?? '' }}" readonly>
          <p class="text-muted" id="inviteInfo">
            発行日時：{{ $coach->invite_token_expires_at }}（有効期限：{{ ($coach->invite_token_expires_at)->addDays(5) }}まで）
          </p>
          <button class="btn btn-primary" id="generateInviteBtn">新しい招待リンクを発行</button>
          <button class="btn btn-outline-secondary mb-2" id="copyBtn">コピー</button>
          <p id="copyMessage" class="text-success mb-2" style="display: none;">コピーしました！</p>
        @endif
      </div>
  </div>

  <script>
  document.getElementById('copyBtn').addEventListener('click', function() {
    const url = document.getElementById('inviteUrl').value;
    navigator.clipboard.writeText(url).then(() => {
        document.getElementById('copyMessage').style.display = 'block';
        setTimeout(() => document.getElementById('copyMessage').style.display = 'none', 2000);
        });
  });

  document.getElementById('generateInviteBtn').addEventListener('click', function() {
      fetch("{{ route('coach.invites.store') }}", {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({})
       })
      .then(response => response.json())
      .then(data => {
        document.getElementById('inviteUrl').value = data.inviteUrl;
        document.getElementById('inviteInfo').innerText = 
          '発行日時：' + data.inviteCreatedAt + '（有効期限：' + data.expiresAt + 'まで）';
      })
      .catch(error => console.error('Error:', error));
  });
  </script>

</div>
@endsection