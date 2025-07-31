@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">レポート出力</h1>

  <div class="mb-3">
    <form class="row g-3 align-items-end">
      <div class="col-md-4">
        <label class="form-label">対象週</label>
        <input type="week" name="week" class="form-control">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary">プレビュー</button>
      </div>
    </form>
  </div>

  <div class="card mb-3">
    <div class="card-header">AIフィードバック一覧</div>
    <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item">7/22週 - 満足度・集中度ともに高い - <a href="#">プレビュー</a></li>
        <li class="list-group-item">7/15週 - 夜間作業に課題あり - <a href="#">プレビュー</a></li>
      </ul>
    </div>
  </div>

  <div class="text-end">
    <button class="btn btn-success">PDF出力</button>
  </div>
</div>
@endsection
