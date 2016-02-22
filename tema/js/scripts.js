$(function(){
//slider
	var demo1 = $("#demo1").slippry({
		transition: 'horizontal',
		// useCSS: true,
		// speed: 1000,
		// pause: 3000,
		// auto: true,
		// preload: 'visible',
		// autoHover: false
	});

	$('.stop').click(function () {
		demo1.stopAuto();
	});

	$('.start').click(function () {
		demo1.startAuto();
	});

	$('.prev').click(function () {
		demo1.goToPrevSlide();
		return false;
	});
	$('.next').click(function () {
		demo1.goToNextSlide();
		return false;
	});
	$('.reset').click(function () {
		demo1.destroySlider();
		return false;
	});
	$('.reload').click(function () {
		demo1.reloadSlider();
		return false;
	});
	$('.init').click(function () {
		demo1 = $("#demo1").slippry();
		return false;
	});

	//para widgets

	//slide actividades

	var demo2 = $("#demo2").slippry({
		transition: 'horizontal',
		// useCSS: true,
		// speed: 1000,
		// pause: 3000,
		auto: false,
		// preload: 'visible',
		// autoHover: false
	});

	$('.stop').click(function () {
		demo1.stopAuto();
	});

	$('.start').click(function () {
		demo1.startAuto();
	});

	$('.prev').click(function () {
		demo1.goToPrevSlide();
		return false;
	});
	$('.next').click(function () {
		demo1.goToNextSlide();
		return false;
	});
	$('.reset').click(function () {
		demo1.destroySlider();
		return false;
	});
	$('.reload').click(function () {
		demo1.reloadSlider();
		return false;
	});
	$('.init').click(function () {
		demo1 = $("#demo2").slippry();
		return false;
	});

	//slide nuevos convenios
	
	var convenios = $("#convenios").slippry({
		transition: 'horizontal',
		// useCSS: true,
		// speed: 1000,
		// pause: 3000,
		auto: false,
		// preload: 'visible',
		// autoHover: false
	});

	$('.stop').click(function () {
		demo1.stopAuto();
	});

	$('.start').click(function () {
		demo1.startAuto();
	});

	$('.prev').click(function () {
		demo1.goToPrevSlide();
		return false;
	});
	$('.next').click(function () {
		demo1.goToNextSlide();
		return false;
	});
	$('.reset').click(function () {
		demo1.destroySlider();
		return false;
	});
	$('.reload').click(function () {
		demo1.reloadSlider();
		return false;
	});
	$('.init').click(function () {
		demo1 = $("#convenios").slippry();
		return false;
	});

	//slide slide-programas
	
	var slideprogramas = $("#slideprogramas").slippry({
		transition: 'horizontal',
		// useCSS: true,
		// speed: 1000,
		// pause: 3000,
		auto: false,
		// preload: 'visible',
		// autoHover: false
	});

	$('.stop').click(function () {
		demo1.stopAuto();
	});

	$('.start').click(function () {
		demo1.startAuto();
	});

	$('.prev').click(function () {
		demo1.goToPrevSlide();
		return false;
	});
	$('.next').click(function () {
		demo1.goToNextSlide();
		return false;
	});
	$('.reset').click(function () {
		demo1.destroySlider();
		return false;
	});
	$('.reload').click(function () {
		demo1.reloadSlider();
		return false;
	});
	$('.init').click(function () {
		demo1 = $("#slideprogramas").slippry();
		return false;
	});

});
