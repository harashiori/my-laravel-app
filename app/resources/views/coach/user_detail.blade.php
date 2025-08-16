@extends('layouts.app')

@section('content')
<div class="container py-4">
  <!-- ユーザー名とコメントボタン -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>{{ $user->name }}の記録</h3>
    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#commentForm">
      コメント        
    </button>
  </div>

  <!-- コメントフォーム -->
  <div class="collapse mb-4" id="commentForm">
    <div class="card card-body">
      <form action="{{ route('coach.comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
          
        <div class="mb-2">
          <label for="comment" class="form-label">コメント（アドバイス）</label>
          <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
        </div>
                
        <button type="submit" class="btn btn-primary btn-sm">送信</button>
      </form>
    </div>
  </div>
  

    {{-- 習慣一覧 --}}
  <div class="card mb-4">
    <div class="card-header">登録している習慣</div>
    <div class="card-body">
      @if($user->habits->isEmpty())
        <p>登録された習慣がありません。</p>
      @else
        <table class="table table-striped">
          <thead>
            <tr>
              <th>習慣名</th>
              <th>頻度</th>
              <th>開始時間</th>
              <th>作成日</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user->habits as $habit)
              <tr>
                <td>{{ $habit->name }}</td>
                <td>{{ $habit->frequency }}</td>
                 <td>{{ $habit->schedule_time }}</td>
                <td>{{ $habit->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">最近の作業ログ</div>
    <div class="card-body">
      @if($workLogs->isEmpty())
        <p>作業ログがありません。</p>
      @else
      <table class="table table-striped">
        <thead>
          <tr>
            <th>日付</th>
            <th>習慣</th>
            <th>集中度</th>
            <th>満足度</th>
          </tr>
        </thead>
        <tbody>
          @foreach($workLogs as $log)
            <tr>
              <td>{{ $log->created_at }}</td>
              <td>{{ $log->habit->name }}</td>
              <td>{{ $log->concentration }}</td>
              <td>{{ $log->satisfaction }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
</div>
@endsection