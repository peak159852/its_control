// 장애현황 ajax
$(document).ready(function () {
	loadList();

	function loadList() {
		$.ajax({
			url: "cctvping.php",
			type: "GET",
			success: function (response) {
				$("#cctvtable").html(response);
			},
			error: function () {
				alert("리스트를 불러오는 데 실패했습니다.");
			}
		});
	}
});

$(document).ready(function () {
	loadlcsList();

	function loadlcsList() {
		$.ajax({
			url: "lcsping.php",
			type: "GET",
			success: function (response) {
				$("#lcstable").html(response);
			},
			error: function () {
				alert("리스트를 불러오는 데 실패했습니다.");
			}
		});
	}
});

$(document).ready(function () {
	loadvdsList();

	function loadvdsList() {
		$.ajax({
			url: "vdsping.php",
			type: "GET",
			success: function (response) {
				$("#vdstable").html(response);
			},
			error: function () {
				alert("리스트를 불러오는 데 실패했습니다.");
			}
		});
	}
});