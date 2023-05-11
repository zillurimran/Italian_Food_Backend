(function ($) {
    "use strict"

	/* Document on load functions */
	$(window).on('load', function () {
        // preLoader();
    });

	$(document).ready(function () {
        $('header').before('<div class="header-height-fix"></div>');
		headerHeightFixer();
	});

	/* Preloader init */
	function preLoader(){
		$(".preloader").delay(1000).fadeOut("slow");
	}

	/* Fixed Header */
	$(window).on("scroll", function () {
		var scrolling = $(this).scrollTop();

		if (scrolling > $('.header').innerHeight()) {
			$(".header").addClass("header--fixed");
		} else {
			$(".header").removeClass("header--fixed");
		}
	});

	/* scroll top */
	$(".scroll-top").on("click", function () {
		$("html,body").animate({scrollTop: 0},50);
	});
	$(window).on("scroll", function () {
		var scrolling = $(this).scrollTop();
		if (scrolling > 200) {
			$(".scroll-top").slideDown();
		} else {
			$(".scroll-top").slideUp();
		}
	});

	/* Fix Header Height function */
    function headerHeightFixer(){
        $('.header-height-fix').css('height', $('header').innerHeight() + 1 +'px');
    	$('body').attr("style", `--header-size: ${$('header').innerHeight()}`);
	};

	/* Closes responsive menu when a navbar link is clicked */
	$(".nav-link, .dropdown-item").on("click", function (e) {
		if( $(this).hasClass("dropdown-toggle") ){
			e.preventDefault();
		}else{
			$(".navbar-collapse").collapse("hide");
			$("html").removeClass("scroll-none");
		}
	});
	$('.navbar-toggler').on('click', function () {
        $("html").toggleClass('scroll-none');
    });
    $('.offCanvasMenuCloser, .mobile-menu-close').on('click', function (){
        $("html").removeClass("scroll-none");
    });

    $('[data-toggle="password"]').on("click", function(){
        const currentInput = $(this).closest(".input-group").find('input[data-target="password"]');
        if(currentInput.prop('type') === 'password'){
            $(this).html('<i class="bi bi-eye-slash-fill"></i>');
            currentInput.prop('type', 'text');
        }else{
            $(this).html('<i class="bi bi-eye-fill"></i>');
            currentInput.prop('type', 'password');
        }
    })

})(jQuery);
