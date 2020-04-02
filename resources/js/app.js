import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import FlashMessage from "@smartweb/vue-flash-message";
require("./bootstrap");

Vue.use(VueRouter);
Vue.use(FlashMessage);

const app = new Vue({
    el: "#app",
    router: new VueRouter(routes)
});
