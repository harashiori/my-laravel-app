@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">{{ $user->name }}の記録</h1>

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
            <th>コメント</th>
          </tr>
        </thead>
        <tbody>
          @foreach($workLogs as $log)
            <tr>
              <td>{{ $log->date->format('Y-m-d') }}</td>
              <td>{{ $log->habit_name }}</td>
              <td>{{ $log->concentration }}</td>
              <td>{{ $log->satisfaction }}</td>
              <td><a href="" class="btn btn-sm btn-outline-secondary">コメント</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection