@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">習慣一覧</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('user.habits.create') }}" class="btn btn-primary mb-3">＋ 習慣を追加</a>

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
    
    <tbody>
  @foreach($habits as $habit)
    <tr>
      <td>{{ $habit->name }}</td>
      <td>{{ $habit->frequency }}</td>
      <td>{{ $habit->days ?? '-' }}</td> {{-- 継続日数: カラムがあれば --}}
      <td>{{ $habit->schedule_time }}</td>
      <td>{{ $habit->notification_time }}</td>
      <td>
        <a href="{{ route('user.habits.edit', $habit->id) }}" class="btn btn-sm btn-secondary">編集</a>
        <form action="{{ route('user.habits.destroy', $habit->id) }}" method="POST" style="display:inline-block">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('削除しますか？')">削除</button>
        </form>
      </td>
    </tr>
  @endforeach
</tbody>


    </tbody>
  </table>
</div>
@endsection
