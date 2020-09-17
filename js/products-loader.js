"use strict";

const token = "b92f20e92b13958208e311997bb5e2";

const lang =
	window.location.pathname != "/"
		? window.location.pathname.substr(1, 2)
		: "lv";
let swipers = [];

Vue.config.productionTip = false;

var app = new Vue({
	el: "#premain",
	data() {
		return {
			posts: {},
		};
	},
	mounted() {
		this.loadProducts();
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
	},
});
