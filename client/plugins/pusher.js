import Pusher from "pusher-js";
import Echo from "laravel-echo";

Pusher.logToConsole = true;

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.pusherAppKey,
  cluster: process.env.pusherCluster,
  encrypted: true
});
