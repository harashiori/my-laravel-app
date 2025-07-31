@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">山田太郎さんの記録</h1>

  <div class="card mb-4">
    <div class="card-header">最近の作業ログ</div>
    <div class="card-body">
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
          <tr>
            <td>2025-07-27</td>
            <td>読書</td>
            <td>4</td>
            <td>5</td>
            <td><a href="{{ route('coach.comment', 1) }}" class="btn btn-sm btn-outline-secondary">コメント</a></td>
          </tr>
          <tr>
            <td>2025-07-26</td>
            <td>ジム</td>
            <td>5</td>
            <td>4</td>
            <td><a href="{{ route('coach.comment', 2) }}" class="btn btn-sm btn-outline-secondary">コメント</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection