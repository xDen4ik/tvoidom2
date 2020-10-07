$(function () {

	$(document).on('click', '.select-wrap', function(){
		$(this).toggleClass('active')
		$(this).closest('.select').find('.select-items').slideToggle()
	})

	$(document).on('click', '.main__search .select-item, .catalog__filter .select-item', function(){
		var join = 0
		$(this).toggleClass('active')
		join = $(this).parent('.select-items').find('.select-item.active').length
		$(this).parent('.select-items').parent('.select').find('.select-wrap span').text('Выбрано ' + join)
	})

	$(document).on('click', '.popup .select-item, .catalog__ads .select-item, .lk .select-item', function(){
		$(this).parent('.select-items').parent('.select').find('.select-wrap span').text($(this).text())
		$(this).parent('.select-items').slideUp()
		$(this).parent('.select-items').parent('.select').find('.select-wrap').removeClass('active')
	})

	$(document).on('click', '.js-edit-profile', function(){
		$('.lk__profile-data').slideToggle()
		$('html, body').animate({ scrollTop: $('.lk__profile-data').offset().top - 75 }, 1000);
	})
	
	$('#hamburger').click(function(){
		$(this).toggleClass('is-active');
		$('.main__header-mob-menu').toggleClass('active');
		return false;
	})

	if ($(window).width() < 1200) {
		$('.menu .nav-link').click(function(){
			$('#hamburger').removeClass('is-active')
			$('.menu').removeClass('active')
		})
	}

	$('.nav-link').click( function(){
		var offset = 120
		if ($(window).width() > 767) {
			offset = 100
		} else {
			offset = 54
		}
		var scroll_el = $(this).attr('href')
		if ($(scroll_el).length != 0) {
			$('html, body').animate({ scrollTop: $(scroll_el).offset().top - offset }, 1000);
		}
		return false
	})

	$('.ad__header-desc-more-btn').click(function(){
		moreBtn($('.ad__header-desc'), $(this).find('span'))
	})

	function moreBtn(item, btn) {
		item.toggleClass('active')
		btn.html(btn.data("text"));
		var el = btn;
		var swap = el.data("swap");
		var text = el.data("text");
		el.data("text", swap);
		el.data("swap", text);
		el.html(swap);
	}

	if ($('.ad__header-slider-big').length) {
		$('.ad__header-slider-big').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			prevArrow: $('.ad__header-slider-big-wrap .prev'),
			nextArrow: $('.ad__header-slider-big-wrap .next'),
			fade: true,
			asNavFor: $('.ad__header-slider-nav'),
			responsive: [
			{
				breakpoint: 1200,
				settings: {
					fade: false
				}
			}
			]
		});

		$('.ad__header-slider-nav').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			asNavFor: $('.ad__header-slider-big'),
			dots: false,
			variableWidth: true,
			arrows: false,
			focusOnSelect: true,
			responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3,
				}
			}
			]
		});

		$(window).on('resize orientationChange', function (event) {
			$('.ad__header-slider-big').slick('refresh')
			$('.ad__header-slider-nav').slick('refresh')
		})
	}

	if ($('.catalog__ads').length) {
		$('.catalog__ads-item-slider-big-img-slide').each(function(){
			$(this).slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: false,
				arrows: true,
				prevArrow: $(this).closest('.catalog__ads-item-slider').find('.prev'),
				nextArrow: $(this).closest('.catalog__ads-item-slider').find('.next'),
				fade: true,
				asNavFor: $(this).closest('.catalog__ads-item-slider').find('.catalog__ads-item-slider-img-nav'),
				responsive: [
				{
					breakpoint: 1200,
					settings: {
						fade: false
					}
				}
				]
			});
			$(this).closest('.catalog__ads-item-slider').find('.catalog__ads-item-slide-count-all').text($(this).closest('.catalog__ads-item-slider').find('.catalog__ads-item-slider-big-img').length)
			$(this).on('beforeChange', function(event, slick, currentSlide, nextSlide){
				$(this).closest('.catalog__ads-item-slider').find('.catalog__ads-item-slide-count-current').text(nextSlide + 1)
			});
		})

		$('.catalog__ads-item-slider-img-nav').each(function(){
			$(this).slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: false,
				asNavFor: $(this).closest('.catalog__ads-item-slider').find('.catalog__ads-item-slider-big-img-slide'),
				dots: false,
				variableWidth: true,
				arrows: false,
				focusOnSelect: true,
				responsive: [
				{
					breakpoint: 1200,
					settings: "unslick"
				}
				]
			});
		})

		$(window).on('resize orientationChange', function (event) {
			$('.catalog__ads-item-slider-img-nav').slick('refresh')
			$('.catalog__ads-item-slider-big-img-slide').slick('refresh')
		})
	}

	$('.main__catalog-slider').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		prevArrow: $('.main__catalog-slider-wrap .prev'),
		nextArrow: $('.main__catalog-slider-wrap .next'),
		responsive: [
		{
			breakpoint: 1100,
			settings: {
				slidesToShow: 2
			}
		},
		{
			breakpoint: 750,
			settings: {
				slidesToShow: 1,
				variableWidth: true,
			}
		}
		]
	});

	$(window).on('resize orientationChange', function (event) {
		$('.main__catalog-slider').slick('refresh')
	})

	if ($('.main__catalog').length) {

		$('.main__services-wrap').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			mobileFirst: true,
			infinite: false,
			variableWidth: true,
			arrows: false,
			responsive: [
			{
				breakpoint: 768,
				settings: "unslick"
			}
			]
		});
		
		function changePlaceholder() {
			if ($(window).width() < 768) {
				$('#filterPlaceInput').attr('placeholder', 'Город, район, метро, ЖК')
			} else {
				$('#filterPlaceInput').attr('placeholder', 'Город, адрес, метро, район, шоссе или ЖК')
			}
		}
		changePlaceholder()

		function footerSelect() {
			$(document).on('click', '.main__footer-subtitle', function(){
				if ($(window).width() < 768) {
					$(this).parent('.col').find('ul').slideToggle()
					$(this).toggleClass('active')
				}
			})
		}

		footerSelect()

		$(window).on('resize orientationChange', function (event) {
			$('.main__catalog-slider').slick('refresh')
			changePlaceholder()
			if ($(window).width() < 768) {
				$('.main__services-wrap').slick('refresh')
			} 
		})
	}

});