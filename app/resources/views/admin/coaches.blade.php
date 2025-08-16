
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">コーチ一覧／管理</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <!-- <th>コーチID</th> -->
        <th>名前</th>
        <th>所属</th>
        <th>メール</th>
        <th>担当ユーザー数</th>
        <th>状態</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($coaches as $coach)
      <tr>
        <!-- <td>{{ $coach->id }}</td> -->
        <td>{{ $coach->name }}</td>
        <td>{{ $coach->organization }}</td>
        <td>{{ $coach->email }}</td>
        <td>{{ $coach->users->count() }}</td>
        <td>
          <span class="badge {{ $coach->status ? 'bg-success' : 'bg-warning text-dark' }}" id="status-badge-{{ $coach->id }}">
            {{ $coach->status ? '承認済み' : '申請中' }}
          </span>

          @if(!$coach->status)
            <button class="btn btn-sm btn-outline-success approve-btn" data-id="{{ $coach->id }}">
              承認する
            </button>
          @endif
        </td>
        <td>
          <a href="{{ route('admin.coaches.show', $coach->id) }}" class="btn btn-sm btn-outline-secondary">詳細</a>
          <!-- <a href="#" class="btn btn-sm btn-outline-danger">削除</a> -->
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center">コーチユーザーがいません</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <script>
  //承認状態を更新する//
  document.querySelectorAll('.approve-btn').forEach(button => {
    button.addEventListener('click', function() {
      const coachId = this.dataset.id;

      fetch(`/admin/coaches/${coachId}/approve`, {
        method: 'PATCH',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
        }
      })
      .then(response => response.json())
      .then(data => {
        // バッジ更新
        const badge = document.getElementById(`status-badge-${coachId}`);
        badge.textContent = '承認済み';
        badge.classList.remove('bg-warning', 'text-dark');
        badge.classList.add('bg-success');

        // ボタン非表示
        this.style.display = 'none';
      })
      .catch(err => console.error(err));
    });
  });
  </script>

</div>
@endsection