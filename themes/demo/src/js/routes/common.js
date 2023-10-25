import CookiePolicy from "../modules/cookiePolicy";

export default {
	init() {
		new CookiePolicy();
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};