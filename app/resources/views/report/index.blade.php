@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">レポート出力</h2>

  <div class="mb-3">
    <form class="row g-3 align-items-end">
      <div class="col-md-4">
        <label class="form-label">対象週</label>
        <input type="week" name="week" class="form-control">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-outline-secondary">検索</button>
      </div>
    </form>
  </div>

  <div class="card mb-3">
    <div class="card-header">AIフィードバック一覧</div>
    <div class="card-body">
      @if($feedbacks->isEmpty())
        <p>該当するフィードバックはまだありません</p>
      @else
        <ul class="list-group">
          @foreach ($feedbacks as $feedback)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>  
                <!-- 週開始日の「m/d週」の形式で表示  -->
                {{ \Carbon\Carbon::parse($feedback->week_start_date)->format('n/j') }}週 - 
                <!-- 例としてsummaryの一部表示  -->
                {{ \Str::limit($feedback->summary, 20) }}
              </div>
              <div>
                <a href="{{ route('user.reports.show', $feedback->id) }}" class="btn btn-sm btn-secondary me-2">プレビュー</a>
                <form action="{{ route('user.reports.pdf', $feedback->id) }}" method="POST" style="display:inline-block">
                  @csrf
                  <button class="btn btn-sm btn-success">PDF出力</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</div>
@endsection
