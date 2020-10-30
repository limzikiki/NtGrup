"use strict";

const token = "b92f20e92b13958208e311997bb5e2";
const animationSpeed = 0.1;
const lang =
	window.location.pathname != "/"
		? window.location.pathname.substr(1, 2)
		: "lv";
let lastAnimTime;
let animationDirection = "forward"; /** forward/backward */
let swipers = [];

Vue.config.productionTip = false;

var app = new Vue({
	el: "#container",
	data() {
		return {
			posts: [],
			socials: [],
			companies: [],
			companiesAnimationInterval: null,
		};
	},
	mounted() {
		this.fetchEverything();

		requestAnimationFrame(this.logoAnimation);
	},
	updated() {
		this.posts.entries.forEach(function (v, k) {
			if (v.gallery != undefined && v.gallery.length > 0) {
				swipers[k] = new Swiper(".swiper" + k, {
					loop: true,
					effect: "fade",
					loop: true,
					autoplay: true,
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},
				});
			}
		});
	},
	methods: {
		fetchEverything() {
			axios
				.get(
					"https://ntgrup.lv/cockpit/api/collections/get/products?token=" +
						token +
						"&lang=" +
						lang
				)
				.then((response) => (this.posts = response.data));
			axios
				.get(
					"https://ntgrup.lv/cockpit/api/singletons/get/companies?token=" +
						token
				)
				.then((response) => {
					this.companies = response.data.Logo;
				});
			axios
				.get(
					"https://ntgrup.lv/cockpit/api/collections/get/social?token=" +
						token
				)
				.then((response) => {
					this.socials = response.data;
					this.setSocialBlockPosition();
				});
		},
		setSocialBlockPosition() {
			const social = document.getElementById("social");
			const oneLinkHeight = 50;
			const topPosition =
				window.innerHeight / 2 -
				(this.socials.entries.length * oneLinkHeight) / 2 +
				"px";
			social.style.top = topPosition;
		},
		logoAnimation() {
			const now = new Date().getTime();
			const timeDelta = now - (lastAnimTime || now);
			lastAnimTime = now;
			const viewPort = document.getElementById("precomp");
			const item = document.getElementById("companies");
			const sizeDelta = item.offsetWidth - viewPort.clientWidth;
			const offestDelta = sizeDelta + parseInt(item.style.left);
			// TODO сделать переключатель чтобы когда доходило до конца шло назад
			const step = timeDelta * animationSpeed;

			if (sizeDelta > 0) {
				if (!item.style.left) {
					item.style.left = "1px";
				}
				if (animationDirection == "forward") {
					item.style.left = parseFloat(item.style.left) - step + "px";

					if (offestDelta < 0) {
						animationDirection = "backward";
					}
				} else {
					if (parseFloat(item.style.left) > 0) {
						animationDirection = "forward";
					} else {
						item.style.left =
							parseFloat(item.style.left) + step + "px";
					}
				}
			}
			requestAnimationFrame(this.logoAnimation);
		},
	},
});
