
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">レポートプレビュー</h1>

  <div class="card mb-3">
    <div class="card-header">週間サマリー</div>
    <div class="card-body">
      <p>今週は「ジム」が計画通り実施され、全体的に良好な習慣継続が見られました。</p>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">集中度・満足度傾向</div>
    <div class="card-body">
      <p>集中度：平均4.2 / 満足度：平均4.0</p>
      <p>夜間の作業がやや低下傾向。日中へのシフトが有効です。</p>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">AIからの提案</div>
    <div class="card-body">
      <p>朝の時間帯の習慣実行率が高いため、重要タスクは午前に設定することを推奨します。</p>
    </div>
  </div>

  <div class="text-end">
    <a href="{{ route('report.index') }}" class="btn btn-secondary">一覧へ戻る</a>
  </div>
</div>
@endsection