"use strict";
$(function () {
	var ImgHeight = $("#img").height();
	function sizes() {
		let BrowserHeight = $(window).height();
		ImgHeight = $("#img").height();
		if (BrowserHeight > ImgHeight) {
			$(".main").css("top", ImgHeight);
			window.FadeOfMenu = ImgHeight;
		} else {
			$(".main").css("top", BrowserHeight);
			window.FadeOfMenu = BrowserHeight;
		}

		//set galleries wrap height
		$("#mini-gallery-banner").height(ImgHeight * 0.5);

		$("#products-wrap").height(ImgHeight);

		let BrowserWidth = $(window).width();

		$("#precomp").width(BrowserWidth);

		$(".lg").width(BrowserWidth / 8.99);
		$("#logocontainer").css("transform", "translate(" + 0 + "px)");
	}

	//position
	var p = 0;
	const f = $(".companies").width() * 0.55; //длина прокрутки больше число тем больше выйдет
	var s = 0;

	setInterval(function () {
		if (s == 1) {
			p--;
			if ((f / 2) * -1 > p) {
				s = 0;
			}
		} else {
			p++;
			if (f / 2 < p) {
				s = 1;
			}
		}
		$("#logocontainer").css("transform", "translate(" + p + "px)");
	}, 10);

	var HH = $("section").height + 10;
	$("#aboutus").css("margin-top", HH);
	sizes();
	$(window).resize(function () {
		sizes();
	});
	if ($(window).scrollTop() > FadeOfMenu) {
		$("#menu").addClass("opmenu");
	} else {
		$("#menu").removeClass("opmenu");
	}
	$(window).on("scroll", function () {
		if ($(window).scrollTop() > FadeOfMenu) {
			$("#menu").addClass("opmenu");
		} else {
			$("#menu").removeClass("opmenu");
		}
		if ($(window).scrollTop() < $("#img").height()) {
			$("#img").offset({ top: $(window).scrollTop() * 0.6 });
		} else {
			$("#img").offset({ top: 1 });
		}
	});

	$("a.js-navLink").click(function () {
		var newScroll =
			$($(this).attr("href")).offset().top - $("#menu").height();
		$("html, body").animate(
			{ scrollTop: newScroll + "px" },
			{ duration: 500, easing: "swing" }
		);
		return f;
	});
	function send_mail() {
		$.ajax({
			url: "./send_mail.php",
			data: {
				email: $("input[name=email]").val(),
				name: $("input[name=name]").val(),
				message: $("textarea[name=message]").val(),
			},
			method: "POST",
			beforeSend: function (xhr) {
				$("#send").attr("disabled", "");
				document.querySelector("#email").reset();
			},
			success: function (data) {
				console.log(data);
				if (data === "succes") {
					$("#succes").fadeIn();
				} else {
					$("#fail").fadeIn();
				}
			},
		});
	}
	$("form#email").submit(function () {
		send_mail();
		return false;
	});
});
