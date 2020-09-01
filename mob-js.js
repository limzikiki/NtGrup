$(function(){
	'use strict';
	var vmin;
	var vmax;
	var vw;
    var vh;
    var orientation;
	function dependentValuesByOrientation(){
        $("#img").css({ "left": -(($("#img").width() - $(window).width()) / 2) });
        if ($(window).height() >= $(window).width()) {
            orientation = 1; // vertically
        } else {
            orientation = 0; // horizontally
        }
	}
    window.addEventListener('resize', function () {
        dependentValuesByOrientation();
        //$("#img").css({"left":-(($("#img").width()-$(window).width())/2)});
        setCssV();
        if (orientation === 1) {
            alert("lol");
        } else {
            alert("edjflk")
            $("#aboutContent").css({ "flex-direction": "row" });
            $("#textAbout").css({ "max-height": "70vh" });
        }

    });
	dependentValuesByOrientation();
	function setCssV(){
		if($(window).width()>$(window).height()){
			vmin = $(window).height()/100;
			vmax = $(window).width()/100;
		}else{
			vmax = $(window).height()/100;
			vmin = $(window).width()/100;
		}
		vw = $(window).width()/100;
		vh = $(window).height()/100;
	}
	setCssV();
	$("#burger").css({"left":($(window).width()-$("#burger").width())+"px"});
	$("#burger").css({"left":0});
	$("#burger").on("click",function(){
		$(".line").toggleClass("active");
		if($(".line").hasClass("active")){
			$("#burger").css({"left":($(window).width()-$("#burger").width())+"px"});
			$("#toolbar").css({"left":0});
		}else{
			$("#burger").css({"left":0});
			$("#toolbar").css({"left":"-100vw"});
		}
	});
	$(".frameProd").children("div").fadeOut(1);
	$(".frameProd").on("click",function(){
		//$(".frameProd").toggleClass("showed");
		if($(this).width() >= (80*vw)||$(this).width() === (80*vw)){
			$(".frameProd").width(20*vw);
			$(".frameProd").children("div").slideUp(1000);
			
			//$(this).children("div").css({"display":"none"})
		}else{
			$(".frameProd").width(3*vw);
			$(this).width(90*vw);
			$(".frameProd").children("div");
			$(this).children("div").slideToggle(1000);
		}
    });

	var vOpacityScroll = 10/($(window).height());
	$("#galleryInterface").scroll(function(){	
		$("#scrollGallery").css({"opacity": "-="+vOpacityScroll} );
		if ($("#scrollGallery").css("opacity") < 0.001){
			$("#scrollGallery").css({"display": "none"} );
		}
	});
	$("#galleryInterface").scrollLeft(Math.pow(10, 12));
	var scrolled = false;
	$(window).on("scroll",function(){
		if(!scrolled){
			if($("#gallery").offset().top <= $(window).scrollTop()){
				$("#galleryInterface").animate({scrollLeft: 0}, {duration: 800,easing: "swing" });
				scrolled = true;
				console.log($(window).scrollTop());
			}
		}
		
	});
	$("#scrolldown").on("click",function(){
		$("html, body").animate({scrollTop: 101*vh}, {duration: 500,easing: "swing"});
		
	});
	$("#scrollGallery").on("click",function(){
		$(this).fadeOut(500);
		$("#galleryInterface").animate({scrollLeft: "+="+(100*vh)}, {duration: 500,easing: "swing"});
	});
});