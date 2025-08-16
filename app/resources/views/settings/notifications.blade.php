@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">通知設定</h2>

  <form method="POST" action="{{  route('user.settings.notifications.toggle') }}">
    @csrf

    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="notification_on" id="notification_on" {{ $user->notification_on ? 'checked' : '' }}>
      <label class="form-check-label" for="notification_on">通知を有効にする</label>
    </div>

    <div class="mb-4">
      <label class="form-label">習慣別通知時間</label>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>習慣</th>
            <th>通知時間</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($habits as $habit)
          <tr>
            <td>{{ $habit->name }}</td>
            <td><input type="time" name="notifications[{{ $habit->id }}]" value="{{ $habit->notification_time }}" class="form-control"></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <button type="submit" class="btn btn-primary">保存</button>
  </form>
</div>
@endsection




{{-- FCMトークン取得スクリプト --}}
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "firebase/app";
  import { getAnalytics } from "firebase/analytics";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyDzk2ETSTy0_PaAhQ7IutamOz-Aa-7SQkU",
    authDomain: "timesreview-5e641.firebaseapp.com",
    projectId: "timesreview-5e641",
    storageBucket: "timesreview-5e641.firebasestorage.app",
    messagingSenderId: "967380274124",
    appId: "1:967380274124:web:2903c0bb7fb726e3cd2b69",
    measurementId: "G-JYH641NPWF"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);


  Notification.requestPermission()
.then(permission => {
  if (permission === 'granted') {
    // 通知許可がOKならトークンを取得
    getToken(messaging, { vapidKey: "BGOyx5VZPfmjdoE5OobA4QjUGEllztx4zg2jSwBYxgPHo_cU6NuLvMgIB2WY-snmpJMIzpkuXP68qMe-inbl-YA" })
    .then(currentToken => {
      if (currentToken) {
        // LaravelサーバにトークンをPOST送信
        fetch("{{ route('user.settings.notifications.token') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({ fcm_token: currentToken })
        })
        .then(response => {
          if (!response.ok) throw new Error("トークン送信失敗");
          console.log("FCMトークンをサーバに送信しました");
        })
        .catch(console.error);
      } else {
        console.log("FCMトークンが取得できませんでした");
      }
    })
    .catch(err => {
      console.error("FCMトークン取得エラー:", err);
    });
  } else {
    console.log("通知許可が拒否されました");
  }
});
</script>
</script>