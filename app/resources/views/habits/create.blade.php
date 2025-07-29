@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">習慣追加</h1>
  <form action="{{ route('habits.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">習慣名</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">目標頻度（回／週）</label>
      <input type="number" name="frequency" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">予定時間</label>
      <input type="time" name="scheduled_time" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">通知時間</label>
      <input type="time" name="notification_time" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">登録</button>
  </form>
</div>
@endsection