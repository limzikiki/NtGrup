"use strict";

const token = "b92f20e92b13958208e311997bb5e2";

const lang =
	window.location.pathname != "/"
		? window.location.pathname.substr(1, 2)
		: "lv";
let swipers = [];

Vue.config.productionTip = false;

var app = new Vue({
	el: "#container",
	data() {
		return {
			posts: [],
			socials: [],
		};
	},
	mounted() {
		this.fetchEverything();
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
			this.loadProducts();
			this.loadSocialMedia();
		},
		loadProducts() {
			axios
				.get(
					"https://ntgrup.lv/cockpit/api/collections/get/products?token=" +
						token +
						"&lang=" +
						lang
				)
				.then((response) => (this.posts = response.data));
		},
		loadSocialMedia() {
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
				this.socials.entries.length * oneLinkHeight +
				"px";
			social.style.top = topPosition;
			console.log(topPosition);
		},
	},
});
