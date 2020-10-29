		<script src='/js/js.js'></script>
		<title>NT Grup - Metālkonstrukcijas</title>
		<meta name="theme-color" contents="#9CC2CE">

		<link rel="alternate" hreflang="ru" href="ru/" />
		<link rel="alternate" hreflang="en" href="en/" />
		<link rel="alternate" hreflang="lv" href="lv/" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
		<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
		<link rel="stylesheet" href="/styles/splide-styles.css">
		<link rel="stylesheet" href="/styles/gallery-overlay.css">
		<link rel='stylesheet' type='text/css' href='/styles/style.css'>
		</head>

		<body>
			<div id='container'>
				<header id="menu">
					<div id='menu-wrap'>
						<li class="menuval logo">
							<img src="/data/logs.png " id="logo">
						</li>
						<li class="menuval">
							<a class="mainlevel js-navLink" href="#aboutus"><?= $navigation[0]['title' . $lan] ?></a>
						</li>
						<li class="menuval">
							<a class="mainlevel js-navLink" href="#products"><?= $navigation[1]['title' . $lan] ?></a>
						</li>
						<li class="menuval">
							<a class="mainlevel js-navLink" href="#gallery"><?= $navigation[2]['title' . $lan] ?></a>
						</li>
						<li class="menuval">
							<a class="mainlevel js-navLink" href="#message_block"><?= $navigation[3]['title' . $lan] ?></a>
						</li>
						<li class="menuval languages">
							<div class="langbox">
								<a href='/lv/' class="lang" id="lat">LAT</a>
							</div>
							<div class="langbox">
								<a href='/ru/' class="lang" id="rus">RUS</a>
							</div>
							<div class="langbox">
								<a href='/en/' class="lang" id="eng">ENG</a>
							</div>
						</li>
					</div>
				</header>
				<div id="social">
					<a v-for="social in socials.entries" v-bind:href="social.link" class='social-link' v-bind:style="{color: social.textColor, background: social.color}">
						<span class='iconify social-icon' v-bind:data-icon="social.icon"></span>
					</a>
				</div>
				<div id="premain">
					<div>
						<div id='products-wrap'>
							<a v-for="(post, key) in posts.entries" v-bind:href="'#prod' + key" class='js-navLink prodLinks'>{{post.title}}</a>
						</div>
						<img src="<?php echo '/cockpit/storage/uploads' . $background['image']['path']; ?>" id="img">
					</div>
					<div class="main">
						<div id="aboutus" align="justify">
							<div id="ab">
								<div id="abtext">
									<h1 id="abouth1">
										<?= $navigation[0]['title' . $lan] ?>
									</h1>
									<?= $content[0]['text' . $lan] ?>
								</div>
							</div>
							<div id="precomp">
								<div class="companies">
									<div id="logocontainer">
										<div class="logos">
											<img src="/data/logos/laima.png" class="lg" id="">
										</div>
										<div class="logos" id="">
											<img src="/data/logos/stats.svg" class="lg" id="">
										</div>
										<div class="logos">
											<img src="/data/logos/lnk.png" class="lg" id="">
										</div>
										<div class="logos">
											<img src="/data/logos/idl.png" class="lg" id="">
										</div>
										<div class="logos">
											<img src="/data/logos/velve.svg" class="lg" id="">
										</div>
										<div class="logos">
											<img src="/data/logos/pmg.png" class="lg" id="">
										</div>
										<div class="logos">
											<img src="/data/logos/csdd.svg" class="lg" id="">
										</div>
										<div class="logos" id="1logo">
											<img src="/data/logos/logo.png" class="lg" id="">
										</div>
										<div class="logos">
											<img src="/data/logos/car.png" class="lg" id="">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="products">
							<div id="prodText">
								<div v-for="(product, key) in posts.entries" class="prodText" v-bind:id="'prod'+key">
									<h1>
										{{product.title}}
									</h1>
									<span v-html="product.content"></span>
									<div v-if="(product.gallery != undefined) && (product.gallery.length > 0) " v-bind:class="['Prod__gallery', 'swiper'+key]">
										<div class="swiper-wrapper">
											<div v-for="photo in product.gallery" class="swiper-slide Prod__gallery_container">
												<img v-bind:src="'https://ntgrup.lv'+photo.path" class="Prod__gallery_item " />
											</div>
										</div>
										<div class="swiper-button-prev"></div>
										<div class="swiper-button-next"></div>
									</div>
								</div>
							</div>
						</div>
						<div id="gallery">
							<h1 id="galleryTitle"><?= $navigation[2]['title' . $lan] ?></h1>
							<div class="splide">
								<div id="galleryMenu" class="splide__track">
									<div class="splide__list">
										<?php
										foreach ($gallery['image'] as $value) {
											echo '
										<div class="ph splide__slide">
											<img class="phImg" src="' . $value['path'] . '"> 
								    	</div>
									';
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<div id="message_block">
							<div id="blocks">
								<div class="block">
									<div class="innerBlock">
										<h1 id="contactsTitle" class="contTitles blockTitle"><?= $navigation[3]['title' . $lan] ?>
										</h1>
										<div id="coverContacts">
											<?php
											foreach ($contacts as $contact) {
											?>
												<span class="cont">
													<?php
													echo $contact['contact' . $lan]
													?>
												</span>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<footer>
							ntgrup.lv © Copyright NTGrup <?php echo date("Y") ?>
						</footer>
					</div>
				</div>
			</div>
			<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
			<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
			<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
			<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
			<script src="/js/gallery-overlay.js"></script>
			<script src="/js/products-loader.js"></script>
			<script src="/js/splide-init.js"></script>
			<script>
				var creationDate = new Date(2007, 5, 21);
				var date = new Date();
				var thisYear = Math.floor((date.valueOf() - creationDate.valueOf()) / (86400 * 1000 * 365));
				$("#years").html(thisYear);
			</script>
		</body>

		</HTML>