@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">ユーザー詳細：山田太郎</h1>

  <div class="mb-4">
    <h5>登録情報</h5>
    <p><strong>メール：</strong> yamada@example.com</p>
    <p><strong>登録日：</strong> 2025-05-01</p>
  </div>

  <div class="mb-4">
    <h5>登録習慣</h5>
    <ul class="list-group">
      <li class="list-group-item">読書</li>
      <li class="list-group-item">ジム</li>
    </ul>
  </div>

  <div class="mb-4">
    <h5>最近のログ</h5>
    <table class="table">
      <thead>
        <tr>
          <th>日付</th>
          <th>習慣</th>
          <th>集中度</th>
          <th>満足度</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2025-07-27</td>
          <td>読書</td>
          <td>4</td>
          <td>5</td>
        </tr>
        <tr>
          <td>2025-07-26</td>
          <td>ジム</td>
          <td>5</td>
          <td>4</td>
        </tr>
      </tbody>
    </table>
  </div>

  <form method="POST" action="">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">ユーザー削除</button>
  </form>
</div>
@endsection