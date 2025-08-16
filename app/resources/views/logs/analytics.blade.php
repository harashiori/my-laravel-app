@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">時間分析</h2>

  <form class="mb-4">
    <label class="form-label">習慣を選択</label>
    <select class="form-select w-25">
      <option value="">全て</option>
      <option value="1">ジム</option>
      <option value="2">読書</option>
      <option value="3">日記</option>
    </select>
  </form>

  <div class="card">
    <div class="card-header">集中度グラフ（例）</div>
    <div class="card-body">
      <canvas id="concentrationChart" height="100"></canvas>
    </div>
  </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('concentrationChart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['7/23', '7/24', '7/25', '7/26', '7/27', '7/28', '7/29'],
      datasets: [{
        label: '集中度',
        data: [3, 4, 5, 2, 4, 4, 5],
        backgroundColor: 'rgba(54, 162, 235, 0.6)'
      }]
    },
    options: {
      scales: {
        y: { beginAtZero: true, max: 5 }
      }
    }
  });
</script>
@endsection