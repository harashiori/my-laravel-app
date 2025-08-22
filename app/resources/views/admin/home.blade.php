@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">管理者ページ</h2>

  <div class="card mb-4">
    <div class="card-header">ユーザー統計</div>
    <div class="card-body">
      <p><strong>総登録数：</strong>{{ $totalCount }}人</p>
      <p class="d-flex justify-content-between align-items-center">
        <span><strong>ユーザー数：</strong>{{ $userCount }}人</span>
         <a href="{{ route('admin.users.index') }}" class="btn btn-link">ユーザー一覧</a>
      </p>
      <p class="d-flex justify-content-between align-items-center">
        <span><strong>コーチ数：</strong>{{ $coachCount }}人</span>
        <a href="{{ route('admin.coaches.index') }}" class="btn btn-link">コーチ一覧</a>
      </p>
    </div>
  </div>

  <div class="card">
    <div class="card-header">最近のアクティビティ</div>
    <div class="card-body">
      <ul class="list-group">
        @forelse($activities as $activity)
          <li class="list-group-item">
            [{{ $activity['date']->format('Y-m-d') }}] 
            @if($activity['type'] === 'user')
              ユーザー「{{ $activity['name'] }}」が新規登録
            @elseif($activity['type'] === 'coach')
              コーチ「{{ $activity['name'] }}」が新規登録（申請）
            @elseif($activity['type'] === 'habit')
              {{ $activity['user'] }}が習慣「{{ $activity['name'] }}」を登録
            @endif
          </li>
        @empty
          <li class="list-group-item">最近のアクティビティはありません。</li>
        @endforelse
      </ul>
    </div>
  </div>
</div>
@endsection
