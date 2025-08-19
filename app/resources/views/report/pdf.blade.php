<style>
  body {
    font-family: ipaexg, sans-serif; 
  }
</style>


<div class="container py-4">
  <h2 class="mb-4">レポートプレビュー</h2>

  <div class="card mb-3">
    <div class="card-header">週間サマリー</div>
    <div class="card-body">
      <p>{{ $feedback->summary }}</p>
    </div>
  </div>

  <!-- <div class="card mb-3">
    <div class="card-header">集中度・満足度傾向</div>
    <div class="card-body">
      {{-- もし平均値などを計算していたら表示してもよい --}}
    </div>
  </div> -->

  <div class="card mb-3">
    <div class="card-header">ログ詳細</div>
    <div class="card-body">
      @if($logs->isEmpty())
        <p>ログはありません。</p>
      @else
        <table class="table table-striped">
          <thead>
            <tr>
              <th>習慣名</th>
              <th>開始時間</th>
              <th>終了時間</th>
              <th>集中度</th>
              <th>満足度</th>
            </tr>
          </thead>
          <tbody>
            @foreach($logs as $log)
              <tr>
                <td>{{ $log->habit->name ?? '不明' }}</td>
                <td>{{ $log->start_time->format('Y-m-d H:i') }}</td>
                <td>{{ $log->end_time->format('Y-m-d H:i') }}</td>
                <td>{{ $log->concentration }}</td>
                <td>{{ $log->satisfaction }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>


  <div class="card mb-3">
    <div class="card-header">AIからの提案</div>
    <div class="card-body">
      <p>{{ $feedback->feedback }}</p>
    </div>
  </div>
</div>
