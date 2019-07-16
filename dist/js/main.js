function generateDaysOfWeek() {
	$days = Array("Every day", "Week days", "Mon, Tue, Wed", "Weekends", "Fri, Sun", "Mon", "Wed");
	return $days[Math.floor(Math.random() * $days.length)];
}

function generateRideInGroup() {
	$rideInGroup = Array("Always", "Sometimes", "Never");
	return $rideInGroup[Math.floor(Math.random() * $rideInGroup.length)];
}

function updateUsersTable($user = null) {
	$return = '';
	if ($user != null && $user['id'] != null) {
		$return += "<tr id='tr-user-id-" + $user['id'] + "' data-user-id='" + $user['id'] + "' data-user-username='username' >";
		if ($user['username'] != null) $return += "<td class='td-username'>" + $user['username'] + "</td>";
		else $return += "<td class='td-username'> - </td>";
		if ($user['name'] != null) $return += "<td class='td-name'>" + $user['name'] + "</td>";
		else $return += "<td class='td-name'> - </td>";
		if ($user['email'] != null) $return += "<td class='td-email'><a href='mailto:" + $user['email'] + "'>" + $user['email'] + "</a></td>";
		else $return += "<td class='td-email'> - </td>";
		if ($user['address']['city'] != null) $return += "<td class='td-city'>" + $user['address']['city'] + "</td>";
		else $return += "<td class='td-city'> - </td>";
		// generateDaysOfWeek['Ride in group']
		$return += "<td class='rideingroup'>" + generateRideInGroup() + "</td>";
		// generateDaysOfWeek['day of the week']
		$return += "<td class='daysofweek'>" + generateDaysOfWeek() + "</td>";
		if ($user['posts'] != null) $return += "<td class='td-posts'>" + $user['posts'] + "</td>";
		else $return += "<td class='td-posts'> - </td>";
		if ($user['albums'] != null) $return += "<td class='td-albums'>" + $user['albums'] + "</td>";
		else $return += "<td class='td-albums'> - </td>";
		if ($user['photos'] != null) $return += "<td class='td-photos'>" + $user['photos'] + "</td>";
		else $return += "<td class='td-photos'> - </td>";
		$return += "<td class='area-btn-trash'> <a href='javascript:checkToRemoveUser(" + $user['id'] + ");' class='table-btn-trash btn btn-w' title='Remove this user'><i class='fas fa-trash'></i></a> </td>";
	} else {
		$return += "<tr>";
		$return += '<td>Without users</td>';
	}
	$return += "</tr>";
	return $return;
}

function getUsers() {
	$.ajax({
		url: "https://jsonplaceholder.typicode.com/users",
		dataType: 'json',
		contentType: 'application/json; charset=utf-8;',
		success: function ($usersResult) {
			for ($index = 0; $index < $usersResult.length; $index++) {
				$('#userlist tbody:last-child').append(updateUsersTable($usersResult[$index]));
			}
		},
		error: function ($usersResult) {},
		complete: function () {
			getPost();
			getAlbums();
		}
	});
}


// getting POSTs from users
function getPost() {
	$.ajax({
		url: "https://jsonplaceholder.typicode.com/posts",
		dataType: 'json',
		contentType: 'application/json; charset=utf-8;',
		success: function ($postsResult) {
			$postsList = {};
			for ($post in $postsResult) {
				$userID = $postsResult[$post]['userId'];
				if ($postsList[$userID] == "undefined") $postsList[$userID] = 0;
				$postsList[$userID] = (($postsList[$userID]) > 0) ? $postsList[$userID] + 1 : 1;
			}
			$("#userlist tbody tr[data-user-id]").each(function () {
				$userId = $(this).data("user-id");
				$(this).find('.td-posts').html($postsList[$userId]);
			});
		},
		error: function ($postsResult) {}
	});
}

// getting ALBUMS from users
function getAlbums() {
	$albumsList = {};
	$.ajax({
		url: "https://jsonplaceholder.typicode.com/albums",
		dataType: 'json',
		contentType: 'application/json; charset=utf-8;',
		success: function ($albumsResult) {
			for ($album in $albumsResult) {
				$userID = $albumsResult[$album]['userId'];
				if ($albumsList[$userID] == undefined) $albumsList[$userID] = 0;
				$albumsList[$userID] = (($albumsList[$userID]) > 0) ? $albumsList[$userID] + 1 : 1;
				$albumsList[$userID]['userId'] = $userID;
			}
			$("#userlist tbody tr[data-user-id]").each(function () {
				$userId = $(this).data("user-id");
				$(this).find('.td-albums').html($albumsList[$userId]);
			});
		},
		error: function ($albumsResult) {},
		complete: function () {
			// getPhotos($albumsList);
		}
	});
}


function openModal() {
	$modal = $('#myModal');
	$modal.css({
		"display": "block",
		"padding-right": "15px"
	});
	if (!$modal.hasClass('in')) $modal.addClass('in');
}

function closeModal() {
	$modal = $('#myModal');
	$('#myModal').css({
		"display": "none"
	});
	if ($modal.hasClass('in')) $modal.removeClass('in');
}

function checkToRemoveUser($id = 0) {

	console.log($id);
	if ($id !== null) {
		console.log("foi");
		$("#modal-user-id").html($id);
		openModal();
	}
}

function removeUser($id = null) {
	$id = $("#modal-user-id").html();
	$rowToRemove = $('#tr-user-id-' + $id);
	$rowToRemove.remove();
	closeModal();
}

$(document).ready(function () {
	$tableUserlistBody = $('#userlist tbody');
	getUsers();

	$('.table-btn-trash').click(function (event) {
		event.preventDefault();
		console.log($(this).data('user-id'));
	});


	$("#searchUserList").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#userlist tbody tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

});
