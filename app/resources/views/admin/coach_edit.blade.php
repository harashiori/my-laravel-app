@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">コーチ詳細：{{ $coach->name }}</h3>

  <div class="mb-4">
    <h5 class="pb-2 border-bottom border-2 border-primary">
      登録情報
    </h5>
    <p><strong>メール：</strong>{{ $coach->email }}</p>
    <p><strong>所属：</strong>{{ $coach->organization }}</p>
    <p><strong>登録日：</strong>{{ $coach->created_at->format('Y-m-d') }}</p>
  </div>

  <div class="mb-4">
    <h5 class="pb-2 border-bottom border-2 border-primary">
      担当ユーザー一覧
    </h5>
    @if($coach->users->isEmpty())
      <p>担当ユーザーはいません。</p>
    @else
      <ul class="list-group">
      @foreach($coach->users as $user)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          {{ $user->name }}
          <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-secondary">
            詳細
          </a>
        </li>
      @endforeach
     </ul>
    @endif
  </div>

  <div class="mb-4">
  <h5 class="pb-2 border-bottom border-2 border-primary">
    コメント履歴
  </h5>

  @if($coach->coachComments->isEmpty())
    <p>コメントはまだありません。</p>
  @else
    <ul class="list-group">
      @foreach($coach->coachComments->sortByDesc('created_at') as $comment)
        <li class="list-group-item">
          <strong>{{ $comment->user->name ?? '不明なユーザー' }}:</strong>
          {{ $comment->comment }}
          <small class="text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
        </li>
      @endforeach
    </ul>
  @endif
</div>

  <form method="POST" action="">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" onclick="return confirm('このコーチを削除してもよろしいですか？')">コーチ削除</button>
  </form>
</div>
@endsection
