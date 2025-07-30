@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">作業ログ一覧</h1>
  <div>
    <a href="{{ route('logs.analytics') }}">#</a>
  </div> 
  <form method="GET" action="" class="mb-3">
    <div class="row g-2 align-items-end">
      <div class="col-md-4">
        <label class="form-label">習慣で絞り込み</label>
        <select name="habit_id" class="form-select">
          <option value="">すべて</option>
          <option value="1">ジム</option>
          <option value="2">読書</option>
          <option value="3">日記</option>
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
        <th>集中度</th>
        <th>満足度</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>ジム</td>
        <td>2025-07-14 08:00</td>
        <td>2025-07-14 09:00</td>
        <td>5</td>
        <td>4</td>
      </tr>
      <tr>
        <td>読書</td>
        <td>2025-07-14 13:00</td>
        <td>2025-07-14 13:45</td>
        <td>3</td>
        <td>3</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection