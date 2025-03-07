$(document).ready(function () {
	"use strict";

	/*==================================
* Author        : "ThemeSine"
* Template Name : Listrace directory HTML Template
* Version       : 1.0
==================================== */




	/*=========== TABLE OF CONTENTS ===========
	1. Scroll To Top 
	2. slick carousel
	3. welcome animation support
	4. feather icon
	5. counter
	======================================*/

	// 1. Scroll To Top 
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 600) {
			$('.return-to-top').fadeIn();
		} else {
			$('.return-to-top').fadeOut();
		}
	});
	$('.return-to-top').on('click', function () {
		$('html, body').animate({
			scrollTop: 0
		}, 1500);
		return false;
	});


	// 2. slick carousel

	$(".testimonial-carousel").slick({
		infinite: true,
		centerMode: true,
		autoplay: true,
		slidesToShow: 5,
		slidesToScroll: 3,
		autoplaySpeed: 1500,
		// the magic
		responsive: [
			{

				breakpoint: 1440,
				settings: {
					slidesToShow: 3
				}

			},
			{

				breakpoint: 1024,
				settings: {
					slidesToShow: 2,

				}

			},
			{

				breakpoint: 991,
				settings: {
					slidesToShow: 2,
					centerMode: false,
				}

			},
			{

				breakpoint: 767,
				settings: {
					slidesToShow: 1,
				}

			}
		]
	});



	// 3. welcome animation support

	$(window).load(function () {
		$(".welcome-hero-txt h2,.welcome-hero-txt p").removeClass("animated fadeInUp").css({ 'opacity': '0' });
		$(".welcome-hero-serch-box").removeClass("animated fadeInDown").css({ 'opacity': '0' });
	});

	$(window).load(function () {
		$(".welcome-hero-txt h2,.welcome-hero-txt p").addClass("animated fadeInUp").css({ 'opacity': '0' });
		$(".welcome-hero-serch-box").addClass("animated fadeInDown").css({ 'opacity': '0' });
	});

	// 4. feather icon

	feather.replace();

	// 5. counter
	$(window).on('load', function () {
		$('.counter').counterUp({
			delay: 10,
			time: 3000
		});
	});

	// 검색기능
	$('.keyword').keyup(function () {
		var k = $(this).val();
		$("tbody > tr").hide();
		var temp = $("tbody> tr:contains('" + k + "')");
		$(temp).show();
		var len = $("tbody > tr:visible");
		var res = $(len.length);
		var res2 = (res[0]);
		$(".re-num1").html(res2 / 2);
	})
	var len = $("tbody > tr:visible");
	var res = $(len.length);

	$(".re-num").html(res[0]);




});

//  $img = document.querySelector("#connectview > img ");
//  var img1=$('#connectview').attr('src');
// alert(img1);
// function checkconnect(){
// 	if(img1 ==='image/reddot.png'){
// 		document.getElementById('checktog').style.display = 'none';
// 	} else {
// 		document.getElementById('checktog').style.display ='bloack';
// 	}
// }
// window.onload= checkconnect();


// 토글 구현
// var list = document.getElementsByName('pings');
// var falpings = document.getElementsByClassName('falping');
// var allpings = document.getElementsByClassName('allping');
// function openCloseToc() {

// 		if (falpings.style.display === 'table-row') {
// 			fallpings.style.display = 'table-row';
// 			allpings.style.display = 'none';
// 			document.getElementById('toggle-soc').textContent = '전체목록';
// 		} else {
// 			falpings.style.display = 'none';
// 			allpings.style.display = 'table-row';
// 			document.getElementById('toggle-soc').textContent = '숨기기';

// 		}

// }

// function openCloseToc() {
// 	if (document.getElementById('allchart').style.display === 'block') {
// 		document.getElementById('allchart').style.display = 'none';
// 		document.getElementById('toggle-soc').textContent = '전체목록';
// 	} else {
// 		document.getElementById('allchart').style.display = 'block';
// 		document.getElementById('toggle-soc').textContent = '숨기기';
// 	}
// }

// document.addEventListener("DOMContentLoaded", function(){
// 	loadList();

// 	function loadList() {
// 		fetch("test.php")
// 		.then(response => response.text())
// 		.then(data=>{
// 			document.getElementById("MainTable").innerHTML = data;
// 		})
// 		.catch(error => console.error("리스트 불러오기 실패:", error));
// 	}
// })


// 새로고침 버튼 ajax
$(document).ready(function () {
	$("#refresh-cctv").click(function () {
		$.ajax({
			url: "cctvping.php", // 데이터를 가져올 PHP 파일
			type: "GET",
			success: function (data) {
				$("#cctvtable").html(data); // 결과를 업데이트
			},
			error: function () {
				alert("데이터를 불러오는 중 오류가 발생했습니다.");
			}
		});
	});
});

$(document).ready(function () {
	$("#refresh-lcs").click(function () {
		$.ajax({
			url: "lcsping.php", // 데이터를 가져올 PHP 파일
			type: "GET",
			success: function (data) {
				console.log("성공");
				$("#lcstable").html(data); // 결과를 업데이트
			},
			error: function () {
				alert("데이터를 불러오는 중 오류가 발생했습니다.");
			}
		});
	});
});

$(document).ready(function () {
	$("#refresh-vds").click(function () {
		$.ajax({
			url: "vdsping.php", // 데이터를 가져올 PHP 파일
			type: "GET",
			success: function (data) {
				$("#vdstable").html(data); // 결과를 업데이트
			},
			error: function () {
				alert("데이터를 불러오는 중 오류가 발생했습니다.");
			}
		});
	});
});



//자세히 버튼
$(document).ready(function () {
	$("#cctv-detail").click(function () {
		var newWindow = window.open("detail/cctv-detail.php");
		if (!newWindow) {
			alert("팝업 차단이 되어 있어 새 창을 열 수 없습니다!");
		}
	});
});
$(document).ready(function () {
	$("#lcs-detail").click(function () {
		var newWindow = window.open("detail/lcs-detail.php");
		if (!newWindow) {
			alert("팝업 차단이 되어 있어 새 창을 열 수 없습니다!");
		}
	});
});
$(document).ready(function () {
	$("#vds-detail").click(function () {
		var newWindow = window.open("detail/vds-detail.php");
		if (!newWindow) {
			alert("팝업 차단이 되어 있어 새 창을 열 수 없습니다!");
		}
	});
});


$(document).ready(function () {
	$("#cctv-memo").off("click").on("click", function () {
		var newWindow = window.open("detail/cctv-memo.php");
		if (!newWindow) {
			alert("팝업 차단이 되어 있어 새 창을 열 수 없습니다!");
		}
	});
	$("#lcs-memo").off("click").on("click", function () {
		var newWindow = window.open("detail/lcs-memo.php");
		if (!newWindow) {
			alert("팝업 차단이 되어 있어 새 창을 열 수 없습니다!");
		}
	});
	$("#vds-memo").off("click").on("click", function () {
		var newWindow = window.open("detail/vds-memo.php");
		if (!newWindow) {
			alert("팝업 차단이 되어 있어 새 창을 열 수 없습니다!");
		}
	});
});


$(document).ready(function () {

});
// 아코디언 효과 구현
document.querySelectorAll('.accordion-button').forEach(function (button, index) {
	button.addEventListener('click', function () {
		const content = button.parentElement.nextElementSibling; // 버튼이 속한 부모 요소의 다음 요소 (내용)
		const icon = button.parentElement.querySelector('.icon'); // 버튼이 속한 부모 요소의 아이콘

		// 콘텐츠가 펼쳐지면 아이콘 회전
		if (content.style.display === 'none' || content.style.display === '') {
			content.style.display = 'block';
			icon.style.transform = 'rotate(90deg)';
			button.textContent = '닫기'; // 버튼 텍스트 변경
		} else {
			content.style.display = 'none';
			icon.style.transform = 'rotate(0deg)';
			button.textContent = '펼치기'; // 버튼 텍스트 변경
		}
	});
});