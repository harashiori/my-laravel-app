importScripts('https://www.gstatic.com/firebasejs/9.6.11/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/9.6.11/firebase-messaging.js');

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
