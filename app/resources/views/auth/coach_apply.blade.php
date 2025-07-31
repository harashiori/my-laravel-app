@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 500px;">
  <h2 class="mb-4 text-center">コーチ申請</h2>
  <form method="POST" action="{{ route('coach.apply') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="reason" class="form-label">申請理由</label>
      <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="なぜコーチになりたいかを記入してください" required></textarea>
    </div>

    <div class="mb-3">
      <label for="experience" class="form-label">関連する経験（任意）</label>
      <textarea class="form-control" id="experience" name="experience" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">申請する</button>
  </form>
</div>
@endsection