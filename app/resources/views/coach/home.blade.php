@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">コーチダッシュボード</h2>

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

      <div id="inviteStatus">
        @if(!$inviteUrl)
          <p>まだ招待リンクは発行されていません。</p>
        @elseif($isExpired)
          <p class="text-danger">招待リンクは有効期限切れです（{{ ($coach->invite_token_expires_at)->addDays(5) }}まで有効でした）。</p>
        @else
          <p>以下のURLから新規ユーザーを招待できます。</p>
        @endif
      </div>

      <!-- 常に用意しておく -->
      <input type="text" id="inviteUrl" class="form-control mb-2"
        value="{{ $inviteUrl ?? '' }}"
        @if(!$inviteUrl || $isExpired) style="display:none;" @endif
        readonly>

      <p class="text-muted" id="inviteInfo"
        @if(!$inviteUrl || $isExpired) style="display:none;" @endif>
        @if($inviteUrl && !$isExpired)
          発行日時：{{ $coach->invite_token_expires_at }}（有効期限：{{ ($coach->invite_token_expires_at)->addDays(5) }}まで）
        @endif
      </p>

      <button class="btn btn-primary" id="generateInviteBtn">
        {{ !$inviteUrl || $isExpired ? '招待リンクを発行' : '新しい招待リンクを発行' }}
      </button>

      <button class="btn btn-outline-secondary mb-2"
        id="copyBtn"
        @if(!$inviteUrl || $isExpired) style="display:none;" @endif>
        コピー
      </button>
      <p id="copyMessage" class="text-success mb-2" style="display: none;">コピーしました！</p>
    </div>
  </div>

  <script>
  const copyBtn = document.getElementById('copyBtn');
  if (copyBtn) {
    copyBtn.addEventListener('click', function() {
      const url = document.getElementById('inviteUrl').value;
      navigator.clipboard.writeText(url).then(() => {
        document.getElementById('copyMessage').style.display = 'block';
        setTimeout(() => document.getElementById('copyMessage').style.display = 'none', 2000);
      });
    });
  }

  const generateBtn = document.getElementById('generateInviteBtn');
  if (generateBtn) {
    generateBtn.addEventListener('click', function() {
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
        // DOM 更新
        const inviteUrlInput = document.getElementById('inviteUrl');
        const inviteInfo = document.getElementById('inviteInfo');
        const copyBtn = document.getElementById('copyBtn');
        const status = document.getElementById('inviteStatus');

        inviteUrlInput.value = data.inviteUrl;
        inviteUrlInput.style.display = 'block';

        inviteInfo.innerText = '発行日時：' + data.inviteCreatedAt + '（有効期限：' + data.expiresAt + 'まで）';
        inviteInfo.style.display = 'block';

        copyBtn.style.display = 'inline-block';

        status.innerHTML = '<p>以下のURLから新規ユーザーを招待できます。</p>';
      })
      .catch(error => console.error('Error:', error));
    });
  }
  </script>

</div>
@endsection