@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">習慣一覧</h1>

  <a href="{{ route('habits.create') }}" class="btn btn-primary mb-3">＋ 習慣を追加</a>

  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>習慣名</th>
        <th>頻度（週あたり）</th>
        <th>継続日数</th>
        <th>予定時間</th>
        <th>通知時間</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>ジムに行く</td>
        <td>5回</td>
        <td>14日</td>
        <td>08:00</td>
        <td>07:30</td>
        <td>
          <a href="{{ route('habits.edit', 1) }}" class="btn btn-sm btn-secondary">編集</a>
          <form action="{{ route('habits.destroy', 1) }}" method="POST" style="display:inline-block">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('削除しますか？')">削除</button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
