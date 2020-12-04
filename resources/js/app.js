require("./bootstrap");
// require("./charts/bar.js");
// require("./charts/pie.js");
// require("./charts/Chart.min.js");

window.Vue = require("vue");

const app = new Vue({
    el: "#app",
    components: {
        steps: require("./components/steps.vue").default,
        search: require("./components/search").default
    }
});
