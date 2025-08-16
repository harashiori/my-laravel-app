@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">習慣編集</h2>
  <form action="{{ route('user.habits.update', ['habit' => $habit->id]) }}" method="POST">
    @csrf
    @method('PUT')

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
    @endif
  
    <div class="mb-3">
      <label class="form-label">習慣名</label>
      <input type="text" name="name" value="{{ old('name', $habit->name) }}" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">目標頻度（回／週）</label>
      <input type="number" name="frequency" value="{{ old('frequency', $habit->frequency) }}" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">予定時間</label>
      <input type="time" name="schedule_time" value="{{ old('schedule_time', $habit->schedule_time) }}" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">通知時間</label>
      <input type="time" name="notification_time" value="{{ old('notification_time', $habit->notification_time) }}" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">更新</button>
    <a href="{{ route('user.habits.index') }}" class="btn btn-secondary">戻る</a>
  </form>
</div>
@endsection