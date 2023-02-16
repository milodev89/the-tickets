import './bootstrap';
import '../sass/app.scss'
import Toaster from "@meforma/vue-toaster";
import {createApp} from 'vue'
import App from './components/App.vue'
import AppTickets from './components/Tickets.vue'

createApp(App).use(Toaster).mount("#app_vue");
createApp(AppTickets).use(Toaster).mount("#app_tickets");

