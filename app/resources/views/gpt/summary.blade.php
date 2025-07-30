@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">AIフィードバック</h1>

  <form class="row g-3 align-items-end mb-4">
    <div class="col-md-4">
      <label class="form-label">対象週を選択</label>
      <input type="week" class="form-control" name="week">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">分析</button>
    </div>
  </form>

  <div class="card mb-4">
    <div class="card-header">AIによる要約</div>
    <div class="card-body">
      <p>今週は「ジム」が5日中4日達成され、全体的に高い集中度と満足度が記録されました。</p>
    </div>
  </div>

  <div class="card">
    <div class="card-header">改善提案</div>
    <div class="card-body">
      <p>夜の作業ログが集中度・満足度ともに低めです。日中に移動させることで成果向上が見込まれます。</p>
    </div>
  </div>
  
   <div class="col-auto">
      <div>
    <a href="{{ route('report.index') }}">出力一覧へ</a>
   </div>
</div>
@endsection