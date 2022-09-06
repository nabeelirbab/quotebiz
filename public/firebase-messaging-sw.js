importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyD6wC6Brb4NQwVjHbVL7_OtFC5MUb9xVfQ",
    projectId: "quotebiz-f2e07",
    messagingSenderId: "391920071095",
    appId: "1:391920071095:web:4beb5f11c6184728437832"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});