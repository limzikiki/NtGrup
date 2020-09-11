/*var app = new Vue({
	el: "#mini-gallery-banner",
	data: {
		galleries: {},
		gallerySize: 0,
		test: "",
	},
	beforeMount() {
		this.getGalleries();
	},
	methods: {
		async getGalleries() {
			//geting the data from cms
			const res = await fetch(
				"https://ntgrup.lv/cockpit/api/collections/get/startGallery?token=b92f20e92b13958208e311997bb5e2"
			);
			const json = await res.json();
			//map files to add propery visible, and add ntgrup.lv/ to path begining
			json.entries.map(function (v) {
				return v.gallery.map(function (v) {
					v.meta.visible = true;
					v.path = "https://ntgrup.lv" + v.path;
					return v;
				});
			});
			this.galleries = json;
		},
	},
});

//img component
Vue.component("gallery-item", {
	props: {
		img: Object,
	},
	data: function () {
		return {
			isVisible: true,
		};
	},
	template:
		'<transition name="fade"><div>{{img.meta.visible}}<img v-if="img.meta.visible" v-bind:src="img.path" class="mini-gallery-image"></div></transition>',
});*/
