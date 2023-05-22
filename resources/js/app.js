import './bootstrap';
import { createApp, getCurrentInstance } from 'vue';
import Swal from 'sweetalert2'
import moment from 'moment'

const app = createApp({});
window.Swal = Swal;
window.moment = moment;

// function firstLetterUp(word) {
//     if (word) {
//         let str = '';
//         str = word.charAt(0).toUpperCase() + word.slice(1)

//         return str
//     }
// }

// window.firstLetterUp = firstLetterUp;

//Website
import Index from "./components/website/index.vue";
import Landing from "./components/website/landing.vue";
import Comparison from "./components/website/comparison.vue";
import InDemand from "./components/website/in-demand.vue";
import MostSearched from "./components/website/most-searched.vue";
import Reviews from "./components/website/reviews.vue";

app.component("index", Index);
app.component("landing", Landing);
app.component("comparison", Comparison);
app.component("inDemand", InDemand);
app.component("mostSearched", MostSearched);
app.component("reviews", Reviews);

app.mount('#app');
