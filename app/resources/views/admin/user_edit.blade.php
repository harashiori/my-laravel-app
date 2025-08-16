@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">ユーザー詳細：{{ $user->name }}</h3>

  <div class="mb-4">
    <h5 class="pb-2 border-bottom border-2 border-primary">
      登録情報
    </h5>
    <p><strong>メール：</strong>{{ $user->email }}</p>
    <p><strong>コーチ：</strong>{{ $user->coach_id ? $user->coach->name : '-' }}</p>
    <p>
      <strong>通知設定：</strong>
      @if($user->notification_on)
        オン
      @else
        オフ
      @endif
    </p>
    <p><strong>登録日：</strong>{{ $user->created_at->format('Y-m-d') }}</p>
  </div>

  <div class="mb-4">
    <h5 class="pb-2 border-bottom border-2 border-primary">
      登録習慣
    </h5>
    @if($user->habits->isEmpty())
      <p class="text-muted">習慣は登録されていません。</p>
    @else
      <ul class="list-group">
        @foreach($user->habits as $habit)
        <li class="list-group-item">{{ $habit->name }}</li>
        @endforeach
      </ul>
    @endif
  </div>


  <div class="mb-4">
    <h5 class="pb-2 border-bottom border-2 border-primary">
      最近のログ
    </h5>
    @if($user->logs->isEmpty())
      <p class="text-muted">ログはまだありません。</p>
    @else
      <table class="table">
        <thead>
          <tr>
            <th>日付</th>
            <th>習慣</th>
            <th>開始時間</th>
            <th>終了時間</th>
            <th>集中度</th>
            <th>満足度</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->logs->sortByDesc('created_at')->take(10) as $log)
            <tr>
              <td>{{ $log->created_at->format('Y-m-d') }}</td>
              <td>{{ $log->habit ? $log->habit->name : '削除済み習慣' }}</td>
              <td>{{ $log->start_time }}</td>
              <td>{{ $log->end_time }}</td>
              <td>{{ $log->concentration }}</td>
              <td>{{ $log->satisfaction }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">ユーザー削除</button>
  </form>
</div>
@endsection