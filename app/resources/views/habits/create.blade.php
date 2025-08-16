@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">習慣追加</h2>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('user.habits.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">習慣名</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">目標頻度（回／週）</label>
      <input type="number" name="frequency" class="form-control" value="{{ old('frequency') }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">予定時間</label>
      <input type="time" name="schedule_time" class="form-control" value="{{ old('scheduled_time') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">通知時間</label>
      <input type="time" name="notification_time" class="form-control" value="{{ old('notification_time') }}">
    </div>
    <button type="submit" class="btn btn-primary">登録</button>
  </form>
</div>
@endsection