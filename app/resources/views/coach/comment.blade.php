@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">コメント入力</h1>

  <div class="card mb-4">
    <div class="card-header">対象ログ</div>
    <div class="card-body">
      <p><strong>日付：</strong> 2025-07-27</p>
      <p><strong>習慣：</strong> 読書</p>
      <p><strong>集中度：</strong> 4</p>
      <p><strong>満足度：</strong> 5</p>
    </div>
  </div>

  <form method="POST" action="">
    @csrf
    <div class="mb-3">
      <label class="form-label">コメント</label>
      <textarea name="comment" class="form-control" rows="4" placeholder="フィードバックを入力してください..."></textarea>
    </div>
    <button type="submit" class="btn btn-primary">送信</button>
  </form>
</div>
@endsection