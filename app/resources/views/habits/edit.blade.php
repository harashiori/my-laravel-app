@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">習慣編集</h1>
  <form action="" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">習慣名</label>
      <input type="text" name="name" value="" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">目標頻度（回／週）</label>
      <input type="number" name="frequency" value="" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">予定時間</label>
      <input type="time" name="scheduled_time" value="" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">通知時間</label>
      <input type="time" name="notification_time" value="" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">更新</button>
    <a href="" class="btn btn-secondary">戻る</a>
  </form>
</div>
@endsection