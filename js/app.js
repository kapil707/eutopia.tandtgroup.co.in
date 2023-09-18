$(document).ready(function() {
	
	if ($(window).width() <= 700) {
        $(".burger-menu").on("click", function() {
            $(".nav-wrapper").slideToggle();
        })
        $("nav a").on("click", function() {
            {
                $(".nav-wrapper").slideToggle();
            }
        })
    }
	
   /* var wht = $(window).height();
    $(".home-slider-init, .full-height").height(wht);
    $(".home-slider-init").bxSlider({
        auto: true,
        mode: 'fade',
        pause: 6000,
        pager: true,
        controls: false
    })*/
    $(".specs-list li a").on("click", function() {
        var link = $(this).attr("rel");
        console.log(link);
        $(".specs-list li a").removeClass("active-specs");
        $(this).addClass("active-specs");
        $(".specs-tab").hide();
        $("#" + link).fadeIn();

    })
    $(".logo-wrapper a").on("click", function() { $("html, body").animate({ scrollTop: 0 }, 600); })
    $(".open-form, .close-btn").on("click", function() { $(".enquire-form").slideToggle(); })
    
    // if($(window).width()<=700){
    // 	$(window).scroll(function(){
    // 		if($(window).scrollTop()>=50){
    // 			$('.logo-wrapper>a>img, .logo-wrapper>a').css('width','85px');
    // 		}
    // 		else{
    // 			$('.logo-wrapper>a>img, .logo-wrapper>a').css('width','85px');
    // 		}
    // 	})	
    // }

    var acc = document.getElementsByClassName("accordion");
    var panel = document.getElementsByClassName('panel');

    for (var i = 0; i < acc.length; i++) {
        acc[i].onclick = function() {
            var setClasses = !this.classList.contains('active');
            setClass(acc, 'active', 'remove');
            setClass(panel, 'show', 'remove');

            if (setClasses) {
                this.classList.toggle("active");
                this.nextElementSibling.classList.toggle("show");
            }
        }
    }

    function setClass(els, className, fnName) {
        for (var i = 0; i < els.length; i++) {
            els[i].classList[fnName](className);
        }
    }
})