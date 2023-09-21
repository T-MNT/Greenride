// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getStorage } from "firebase/storage";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCY3GMpc_bIlCEM3TznzGgI3MqeuqNfDq8",
  authDomain: "greenride-fast-loser2.firebaseapp.com",
  projectId: "greenride-fast-loser2",
  storageBucket: "greenride-fast-loser2.appspot.com",
  messagingSenderId: "495575506559",
  appId: "1:495575506559:web:407e5312ba77bf2fed694a",
  measurementId: "G-L79DKKC8MQ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
export const analytics = getAnalytics(app);
export const storage = getStorage(app);
