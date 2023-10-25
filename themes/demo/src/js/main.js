import Router from "./util/router";

import * as bootstrap from "bootstrap";

import common from "./routes/common";

const routes = new Router({
	bootstrap,
	common
});

document.addEventListener("DOMContentLoaded", function () {
	routes.loadEvents();
}, false);