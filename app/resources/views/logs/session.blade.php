@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">作業セッション記録</h2>

  <div class="mb-4">
    <label class="form-label fw-bold">習慣を選択</label>
    <select name="habit_id" class="form-select ">
      @foreach($habits as $habit)
        <option value="{{ $habit->id }}">{{ $habit->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="row mb-4">
    <div class="col-md-6 mb-2">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6 class="card-title">現在時刻</h6>
          <p id="currentTime" class="fs-4 text-primary">--:--:--</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-2">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6 class="card-title">経過時間</h6>
          <p id="elapsedTime" class="fs-4 text-danger">00:00:00</p>
        </div>
      </div>
    </div>
  </div>

  <form id="sessionForm" method="POST" action="{{ route('user.logs.store') }}">
    @csrf

    <input type="hidden" name="start_time" id="start_time">
    <input type="hidden" name="end_time" id="end_time">
    <input type="hidden" name="concentration" id="concentration">
    <input type="hidden" name="satisfaction" id="satisfaction">

    <div class="d-flex justify-content-center gap-3">
      <button type="button" id="startBtn" class="btn btn-success btn-lg ">
        開始
      </button>
      <button type="button" id="endBtn" class="btn btn-danger btn-lg" disabled>
        終了
      </button>
    </div>
    <div class="mb-3 d-none" id="feedbackSection">
      <label class="form-label">集中度（1〜5）</label>
      <select id="selectConcentration" class="form-select mb-2">
        <option value="">-- 未選択 --</option>
        @for ($i = 1; $i <= 5; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>

      <label class="form-label">満足度（1〜5）</label>
      <select id="selectSatisfaction" class="form-select mb-2">
        <option value="">-- 未選択 --</option>
        @for ($i = 1; $i <= 5; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>

      <button type="submit" class="btn btn-primary">記録する</button>
    </div>
  </form>
</div>

<script>
  const startBtn = document.getElementById('startBtn');
  const endBtn = document.getElementById('endBtn');
  const feedbackSection = document.getElementById('feedbackSection');
  const currentTimeDisplay = document.getElementById('currentTime');
  const elapsedTimeDisplay = document.getElementById('elapsedTime');

  let timerInterval;
  let startTimestamp;

  function updateCurrentTime() {
    const now = new Date();
    currentTimeDisplay.textContent = now.toLocaleTimeString();
  }

  function updateElapsedTime() {
    if (!startTimestamp) return;
    const now = new Date();
    const elapsed = new Date(now - startTimestamp);
    const hours = String(elapsed.getUTCHours()).padStart(2, '0');
    const minutes = String(elapsed.getUTCMinutes()).padStart(2, '0');
    const seconds = String(elapsed.getUTCSeconds()).padStart(2, '0');
    elapsedTimeDisplay.textContent = `${hours}:${minutes}:${seconds}`;
  }

  setInterval(updateCurrentTime, 1000);

  startBtn.addEventListener('click', () => {
    startTimestamp = new Date();
    document.getElementById('start_time').value = startTimestamp.toISOString();
    startBtn.disabled = true;
    endBtn.disabled = false;
    timerInterval = setInterval(updateElapsedTime, 1000);
    alert('記録を開始しました');
  });

  endBtn.addEventListener('click', () => {
    const end = new Date();
    document.getElementById('end_time').value = end.toISOString();
    endBtn.disabled = true;
    clearInterval(timerInterval);
    updateElapsedTime();
    feedbackSection.classList.remove('d-none');
    alert('お疲れ様でした！集中度と満足度を入力してください');
  });

  const form = document.getElementById('sessionForm');
  form.addEventListener('submit', () => {
    document.getElementById('concentration').value = document.getElementById('selectConcentration').value;
    document.getElementById('satisfaction').value = document.getElementById('selectSatisfaction').value;
  });
</script>
@endsection