<!-- layouts/app.blade.php を継承 -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <!-- ホーム画面 -->
  <h1 class="mb-4">マイページ</h1>

  <!-- 週間進捗 -->
  <div class="card mb-4">
    <div class="card-header">今週の進捗</div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between">
          <span>ジムに行く</span>
          <span class="badge bg-success">4/5日 達成</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>早起きする</span>
          <span class="badge bg-warning text-dark">2/5日</span>
        </li>
      </ul>
    </div>
  </div>

  <!-- 本日のスケジュール -->
  <div class="card">
    <div class="card-header">
      本日のスケジュール
      <a href="{{ route('habits.calender') }}">今週のスケジュール</a>
    </div>
    <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item">08:00 - ジム</li>
        <li class="list-group-item">13:00 - 読書</li>
        <li class="list-group-item">21:00 - 日記を書く</li>
      </ul>
    </div>
  </div>
</div>
@endsection
