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
        $inviteCreatedAt = \Carbon\Carbon::parse($inviteCreatedAt ?? now()->subDays(6));
        $isExpired = $inviteCreatedAt->lt(now()->subDays(5)); 
      @endphp
      <!-- $inviteCreatedAt 未定義なら6日前を設定して期限切れ扱い使いする  -->
      <!-- $inviteCreatedAt->lt(now()->subDays(5)) 「発行から5日以上経っているか」判定 -->

      @if(!$isExpired)
        <p>以下のURLから新規ユーザーを招待できます。</p>
        <input type="text" class="form-control mb-2" value="{{ $inviteUrl }}" readonly>
        <p class="text-muted">
          発行日時：{{ $inviteCreatedAt }}（有効期限：{{ $inviteCreatedAt->copy()->addDays(5) }}まで）
        </p>
        <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ $inviteUrl }}')">コピー</button>
      @else
        <p class="text-danger">現在の招待URLは有効期限切れです（{{ $inviteCreatedAt }} 発行）。</p>
        <form method="POST" action="{{ route('coach.invites.store') }}">
          @csrf
          <button type="submit" class="btn btn-primary">新しい招待リンクを発行</button>
        </form>
      @endif
    </div>
  </div>

<script>
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