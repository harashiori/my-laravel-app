
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">管理者ダッシュボード</h1>

  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">ユーザー統計</div>
        <div class="card-body">
          <p><strong>ユーザー数：</strong> 120人</p>
          <p><strong>コーチ数：</strong> 8人</p>
          <!-- <p><strong>習慣総数：</strong> 540件</p> -->
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">システム操作</div>
        <div class="card-body">
          <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100 mb-2">全ユーザー管理</a>
          <a href="{{ route('admin.coaches') }}" class="btn btn-outline-primary w-100 mb-2">コーチ管理</a>
          <!-- <a href="" class="btn btn-outline-primary w-100">習慣一覧</a> -->
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">最近のアクティビティ</div>
    <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item">[2025-07-28] ユーザー「山田太郎」が「読書」を追加</li>
        <li class="list-group-item">[2025-07-27] コーチ「佐藤コーチ」がユーザーを招待</li>
        <li class="list-group-item">[2025-07-26] 管理者が新しい習慣カテゴリ「瞑想」を登録</li>
      </ul>
    </div>
  </div>
  <div>
   <a href="{{ route('admin.notification_settings') }}">通知設定</a>
  </div>
</div>
@endsection
