@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">タイムテーブル</h1>
  <div class="alert alert-info">※ 空き時間をクリックすると習慣を追加できます。</div>

  <!-- 簡易週間テーブル風のUI（表形式） -->
  <table class="table table-bordered text-center">
    <thead class="table-light">
      <tr>
        <th>時間</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th>土</th>
        <th>日</th>
      </tr>
    </thead>
    <tbody>
      @for ($h = 0; $h <= 24; $h++)
        <tr>
          <td>{{ sprintf('%02d:00', $h) }}</td>
          @for ($d = 1; $d <= 7; $d++)
            <td>
              <select name="schedule[{{ $d }}][{{ $h }}]" class="form-select form-select-sm">
                <option value="">--</option>
                <option value="ジム">ジム</option>
                <option value="読書">読書</option>
                <option value="日記">日記</option>
              </select>
            </td>
          @endfor
        </tr>
      @endfor
    </tbody>
  </table>

  <div class="text-end">
    <button class="btn btn-success">更新</button>
  </div>
</div>
@endsection