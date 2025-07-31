@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">通知設定</h1>

  <form method="POST" action="">
    @csrf

    <div class="card mb-4">
      <div class="card-header">通知タイミング</div>
      <div class="card-body">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="daily_summary" id="daily_summary" checked>
          <label class="form-check-label" for="daily_summary">毎日の活動まとめを送信</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="weekly_report" id="weekly_report">
          <label class="form-check-label" for="weekly_report">週次レポート通知を送信</label>
        </div>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-header">対象ユーザー</div>
      <div class="card-body">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="notify_users" id="notify_users" checked>
          <label class="form-check-label" for="notify_users">一般ユーザーに通知</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="notify_coaches" id="notify_coaches">
          <label class="form-check-label" for="notify_coaches">コーチに通知</label>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">保存</button>
  </form>
</div>
@endsection
