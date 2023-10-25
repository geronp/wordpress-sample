import Utils from "../util/utils";

export default class CookiePolicy {
	constructor() {
		this.init();
	}

	init() {
		this.utils = new Utils();

		this.ui = {
			cookiefront: document.querySelector(".cookie-front"),
			cookierear: document.querySelector(".cookie-rear"),
			acceptCookieBtn: document.querySelector("#acceptCookie"),
			cookieClose: document.querySelector("#cookie-close"),
			cookieSection: document.querySelector(".cookie-button")
		};

		this._addEventListeners();
	}

	_addEventListeners() {
		if (this.ui.cookieSection) {
			this.ui.cookieSection.addEventListener("click", () => {
				this.ui.cookiefront.style.display = "none";
				this.ui.cookierear.style.display = "block";
				if (this.ui.cookieClose) {
					this.ui.cookieClose.addEventListener("click", () => {
						this.ui.cookieSection.style.display = "none";
					});
				}
			});
		}
		if (this.ui.acceptCookieBtn) {
			this.ui.acceptCookieBtn.addEventListener("click", () => {
				this.utils.setCookie("cookiePolicyAccepted", "1", 365);
				document.querySelector("#modalCloseBtn").dispatchEvent(new Event("click"));
				this.ui.cookiefront.style.display = "none";
				this.ui.cookierear.style.display = "none";
			});
		}
		if (this.ui.cookieClose) {
			this.ui.cookieClose.addEventListener("click", (e) => {
				e.preventDefault();
				this.ui.cookieSection.style.display = "none";
			});
		}
	}
}