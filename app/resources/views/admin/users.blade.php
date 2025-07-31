@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">ユーザー管理</h1>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ユーザーID</th>
        <th>名前</th>
        <th>メール</th>
        <th>登録日</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>山田太郎</td>
        <td>yamada@example.com</td>
        <td>2025-05-01</td>
        <td>
          <a href="{{ route('admin.user_edit') }}" class="btn btn-sm btn-outline-secondary">詳細</a>
          <!-- <a href="#" class="btn btn-sm btn-outline-danger">削除</a> -->
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>鈴木花子</td>
        <td>suzuki@example.com</td>
        <td>2025-06-10</td>
        <td>
          <a href="{{ route('admin.user_edit') }}" class="btn btn-sm btn-outline-secondary">詳細</a>
          <!-- <a href="#" class="btn btn-sm btn-outline-danger">削除</a> -->
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
