@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">作業ログ一覧</h2>

  <!-- セッションメッセージ -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div>
    <a href="">#</a>
  </div> 
  <form method="GET" action="{{ route('user.logs.index')}}" class="mb-3">
    <div class="row g-2 align-items-end">
      <div class="col-md-4">
        <label class="form-label">習慣で絞り込み</label>
        <select name="habit_id" class="form-select">
          <option value="">すべて</option>
          @foreach($habits as $habit)
            <option value="{{ $habit->id }}" {{ request('habit_id') == $habit->id ? 'selected' : '' }} >
              {{ $habit->name }}
            </option>
          @endforeach 
        </select>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-outline-secondary">検索</button>
      </div>
    </div>
  </form>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>習慣名</th>
        <th>開始時間</th>
        <th>終了時間</th>
        <th>実施時間（分）</th>
        <th>集中度</th>
        <th>満足度</th>
      </tr>
    </thead>
    
    <tbody>
    @forelse($logs as $log)
      <tr>
        <td>{{ $log->habit->name }}</td>
        <td>{{ $log->start_time }}</td>
        <td>{{ $log->end_time }}</td> 
        <td>{{ $log->duration ?? '未計測' }}</td>
        <td>{{ $log->concentration ?? '-'}}</td>
        <td>{{ $log->satisfaction ?? '_'}}</td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center text-muted">記録がありません。</td>
      </tr>
    @endforelse
    </tbody>
  </table>
</div>
@endsection