import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Debug the environment variables
console.log("All env variables:", import.meta.env);
console.log("VITE_PUSHER_APP_KEY:", import.meta.env.VITE_PUSHER_APP_KEY);
console.log("VITE_PUSHER_APP_CLUSTER:", import.meta.env.VITE_PUSHER_APP_CLUSTER);

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY || '7321732b949f6f1b0914', // Fallback to hardcoded value
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER || 'mt1', // Fallback to hardcoded value
    forceTLS: true
});