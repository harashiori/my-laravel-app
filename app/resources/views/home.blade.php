@extends('layouts.app')

@section('content')
<div class="container py-4">
  <!-- ホーム画面 -->
  <h1 class="mb-4">マイページ</h1>

  <!-- 習慣の継続日数 -->
  <div class="card mb-4">
    <div class="card-header">習慣の継続日数</div>
    <div class="card-body">
      <ul class="list-group">
        @forelse($habits as $habit)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>{{ $habit->name }}</span>
            <span class="badge bg-primary">{{ $habit->streak_days }} 日連続</span>
          </li>
        @empty
          <li class="list-group-item text-center text-muted">
            まだ登録がありません
          </li>
        @endforelse
      </ul>
    </div>
  </div>

  <!-- 直近5件のログ -->
  <div class="card">
    <div class="card-header">直近の習慣ログ</div>
    <div class="card-body">
      @if($logs->isEmpty())
        <p>ログはありません。</p>
      @else
        <ul class="list-group">
          @foreach($logs as $log)
            <li class="list-group-item">
              <strong>{{ $log->habit->name }}</strong> - {{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i') }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div> 

  <!-- 本日のスケジュール -->
  <div class="card">
    <div class="card-header">
      本日のスケジュール
      <a href="{{ route('user.habits.calendar') }}">今週のスケジュール</a>
    </div>
    <div class="card-body">
      <ul class="list-group">
      </ul>
    </div>
  </div>
</div>
@endsection
