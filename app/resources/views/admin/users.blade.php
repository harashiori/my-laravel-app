@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">ユーザー一覧／管理</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <!-- <th>ユーザーID</th> -->
        <th>名前</th>
        <th>メール</th>
        <th>担当コーチ</th>
        <th>通知設定</th>
        <th>登録日</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr>
        <!-- <td>{{ $user->id }}</td> -->
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->coach_id ? $user->coach->name : '-' }}</td>
        <td>
          @if($user->notification_on)
            オン
          @else
            オフ
          @endif
        </td>
        <td>{{ $user->created_at->format('Y-m-d') }}</td>
        <td>
          <a href="{{ route('admin.users.show', $user->id) }}"  class="btn btn-sm btn-outline-secondary">詳細</a>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center">ユーザーが登録されていません。</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
