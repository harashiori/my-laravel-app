<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('user.homes.index') }}">Times Review</a>
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
        <!-- <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">ログアウト</a>
        </li> -->

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
          <a class="nav-link" href="{{ route('logout') }}">ログアウト</a>
        </li>




        
        @elseif(Auth::guard('admin')->check())
        <!-- 管理者としてログインした場合 -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">ログアウト</a>
        </li>


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