@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">通知設定</h1>

  <form method="POST" action="">
    @csrf
    @method('PUT')

    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="notification_on" id="notification_on" checked>
      <label class="form-check-label" for="notification_on">通知を有効にする</label>
    </div>

    <div class="mb-4">
      <label class="form-label">習慣別通知時間</label>
      <table class="table">
        <thead>
          <tr>
            <th>習慣</th>
            <th>通知時間</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>ジム</td>
            <td><input type="time" name="notifications[gym]" value="07:30" class="form-control"></td>
          </tr>
          <tr>
            <td>読書</td>
            <td><input type="time" name="notifications[reading]" value="13:00" class="form-control"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <button type="submit" class="btn btn-primary">保存</button>
  </form>
</div>
@endsection
