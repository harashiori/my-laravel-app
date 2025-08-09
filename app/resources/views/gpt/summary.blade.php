@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-4">AIフィードバック</h1>
    <div class="col-auto">
      <a href="{{ route('user.reports.index') }}">過去のフィードバック一覧</a>
    </div>
  </div>

  <form class="row g-3 align-items-end mb-4" method="GET" action="{{ route('user.aifeedbacks.index') }}">
    <div class="col-md-4">
      <label class="form-label">対象週を選択</label>
      <input type="week" class="form-control" name="week" value=>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">分析</button>
    </div>
  </form>

  
    <div class="card mb-4">
      <div class="card-header">AIによる要約</div>
      <div class="card-body">
        <p></p>
      </div>
    </div>

    
    <div class="card">
      <div class="card-header">改善提案</div>
      <div class="card-body">
        <p></p>
      </div>
    </div>

  <form action="{{ route('user.aifeedbacks.store') }}" method="POST">
    @csrf
    <input type="hidden" name="week" value="{{ request('week') }}">
    <input type="hidden" name="summary" value="{{ $summary }}">
    <input type="hidden" name="feedbacks" value="{{ $feedbacks }}">
    <button type="submit" class="btn btn-success">このフィードバックを保存</button>
  </form>
</div>  
@endsection