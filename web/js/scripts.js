/*
 * Java-скрипты
 */

	/* toTop Button */
	
		$(function() { 
			$(window).scroll(function() { 
			if($(this).scrollTop() != 0) { 
				$('#toTop').fadeIn(); 
					} else {	 
						$('#toTop').fadeOut(); 
					}	 
				}); 
				$('#toTop').click(function() { 
				$('body,html').animate({scrollTop:0},800); 
			}); 
		});
	
	
	/*Fix menu */
	
	$(document).ready(function(){
	        var $menu = $("#main-menu-container");
	        $(window).scroll(function(){
	            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
	                $menu.removeClass("default").addClass("fixed");
	            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
	                $menu.removeClass("fixed").addClass("default");
			}
		});//scroll
	});
	
	/*scroll to anchor */
	$(document).ready(function() {
		$("a.scrolling-links").click(function () {
		  var elementClick = $(this).attr("href");
		  var destination = $(elementClick).offset().top-50;
		  $('html,body').animate( { scrollTop: destination }, 1100 );
		  return false;
		});
	});
	
	/* active-menu */
		function ActiveLinks(id){
			try{
				var el=document.getElementById(id).getElementsByTagName('a');
					var url=document.location.href;
					for(var i=0;i<el.length; i++){
					if (url==el[i].href){
					el[i].className = 'active_menu';
					};
				};
			}
			catch(e){}
			};

	
	/* slimbox2 */
		$(document).ready(function(){
			$('a.slimbox').slimbox({
			counterText: "Изображение {x} из {y}"
			});
		});
	
	/* swiper slider */
	$(document).ready(function () {
            //initialize swiper when document ready
            var mySwiper = new Swiper ('.swiper-container', {
		// Optional parameters
		autoplay: {
			delay: 5000,
			},
		pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				bulletElement: 'span',
				bulletClass: 'swiper-pagination-bullets',
				bulletActiveClass: 'swiper-pagination-bullet-active',
				clickable: true
			},
		mousewheel: {
			invert: true,
			},
		effect: 'fade',
		fadeEffect: {
			crossFade: true
			},
		coverflowEffect: {
			rotate: 30,
			slideShadows: false,
			},
		loop: true
		})
	});

    // vip / premium checkbox change
        function ifChecked (id) {
            var field = document.getElementById(id);
            if (field.value == 1) {
                field.value = 0;
            } else {
                field.value = 1;
            }
        }
    
    // hide premium if empty
    $(document).ready(function(){
        if ($('.ads-premium').length === 0) {
            $('#premium-block').addClass('hidden');
        }
    });
    
    // hide vip if empty
    $(document).ready(function(){
        if ($('.ads-vip').length === 0) {
            $('#vip-block').addClass('hidden');
        }
    });
    
    // hide common if empty
    $(document).ready(function(){
        if ($('.ads-common').length === 0) {
            $('#common-block').addClass('hidden');
        }
    });
    
    // change image (#ads-fit-img) in site/view
    function selectBigImage(src) {
            document.getElementById('ads-fit-img').src = src;
        }
    
    // ads filter: show active
    /*$('#btn-show-active').click(function() {
        $('#btn-show-all').removeClass('active');
        $('#btn-show-not-active').removeClass('active');
        $(this).addClass('active');
            $('.ads-block').each(function(){
                if($(this).find('span').html() === 'Неопубликовано') {
                    $(this).addClass('hidden');
                    alert($(this).find('span').html());
                }
            });
        });*/
    
    // ads filter: show active
    /*$('#btn-show-not-active').click(function() {
        $('#btn-show-all').removeClass('active');
        $('#btn-show-active').removeClass('active');
        $(this).addClass('active');
            
        });*/