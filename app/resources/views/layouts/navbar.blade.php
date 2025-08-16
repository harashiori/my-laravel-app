<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">

  @php
    if (Auth::guard('user')->check()) {
        $homeRoute = route('user.homes.index');
    } elseif (Auth::guard('coach')->check()) {
        $homeRoute = route('coach.coach-homes.index');
    } elseif (Auth::guard('admin')->check()) {
        $homeRoute = route('admin.admin-homes.index');
    } else {
        $homeRoute = url('/');
    }
  @endphp

    <a class="navbar-brand" href="{{ $homeRoute }}">Times Review</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        
        @if(Auth::guard('user')->check()) 
        <!-- ユーザーとしてログインした場合 -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.habits.index') }}">習慣</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.logs.index') }}">ログ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.logs.create') }}">作業記録</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.aifeedbacks.index') }}">AI分析</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.profiles.index') }}">設定</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ログアウト
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

        @elseif(Auth::guard('coach')->check())
        <!-- コーチとしてログインした場合 -->
        <li class="nav-item">
          <a class="nav-link" href="">担当ユーザー一覧</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#">招待</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('coach.coach-profiles.index') }}">設定</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ログアウト
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

        
        @elseif(Auth::guard('admin')->check())
        <!-- 管理者としてログインした場合 -->


        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}">ユーザー管理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.coaches.index') }}">コーチ管理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">通知設定</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ログアウト
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>


        @else
        <!-- 未ログインの場合（ゲスト） -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">ログイン</a>
        </li>
        @endif

      </ul>
    </div>
  </div>
</nav>