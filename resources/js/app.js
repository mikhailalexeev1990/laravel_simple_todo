import Vue from 'vue';
import App from "./components/App.vue";

document.addEventListener("DOMContentLoaded", () => {
    const app = document.querySelector('#app');

    if (app) {
        new Vue({
            el: app,
            components: {
                App,
            },
            template: '<app/>'
        });
    }
});
