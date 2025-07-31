
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">コーチ管理</h1>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>コーチID</th>
        <th>名前</th>
        <th>メール</th>
        <th>担当ユーザー数</th>
        <th>状態</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>10</td>
        <td>佐藤コーチ</td>
        <td>sato@coach.com</td>
        <td>12</td>
        <td><span class="badge bg-success">承認済み</span></td>
        <td>
          <a href="{{ route('admin.coach_edit') }}" class="btn btn-sm btn-outline-secondary">詳細</a>
          <!-- <a href="#" class="btn btn-sm btn-outline-danger">削除</a> -->
        </td>
      </tr>
      <tr>
        <td>11</td>
        <td>高橋コーチ</td>
        <td>takahashi@coach.com</td>
        <td>8</td>
        <td><span class="badge bg-warning text-dark">承認待ち</span></td>
        <td>
          <a href="#" class="btn btn-sm btn-outline-success">承認</a>
          <a href="{{ route('admin.coach_edit') }}" class="btn btn-sm btn-outline-secondary">詳細</a>
          <!-- <a href="#" class="btn btn-sm btn-outline-danger">削除</a> -->
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection