<header>
    <section class="logo-header"></section>
    <section id="nav-header">
        <figure>
            <img src="" alt="">
        </figure>
        <nav></nav>
    </section>
</header>

<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a class="breadcrumb-item" href="<?php echo base_url() ?>">
                    <i class="fas fa-home"></i>
                </a>
                <a class="breadcrumb-item" href="<?php echo base_url() ?>">

                </a>
            </div>
        </div>
    </div>
</div>

<div class="linearcards">
    <div class="container">
        <div class="row">
            <div class="-card col-xs-12 col-sm-6 col-md-3">
                <div class="huge-icon">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <div class="vertival-info">
                    <p>Sport type</p>
                    <p><strong>Cycling</strong></p>
                </div>
            </div>
            <div class="-card col-xs-12 col-sm-6 col-md-3">
                <div class="huge-icon">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <div class="vertival-info">
                    <p>Mode</p>
                    <p><strong>Advanced</strong></p>
                </div>
            </div>
            <div class="-card col-xs-12 col-sm-6 col-md-3">
                <div class="huge-icon">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <div class="vertival-info">
                    <p>Route</p>
                    <p><strong>30 miles</strong></p>
                </div>
            </div>
            </section>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="header-area">
            <h1 class="main-header col-xs-12 col-sm-8 col-md-8 col-lg-9">
                <span>Header</span>
                <span class="line"></span>
            </h1>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <input id="searchUserList" type="text" placeholder="Filter table content">
            </div>
        </div>

        <div class="table-responsive col-xs-12">
            <table id="userlist" class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>City</th>
                        <th>Ride in group</th>
                        <th>Day of the week</th>
                        <th>Posts</th>
                        <th>Albums</th>
                        <th>Photos</th>
                        <th class="area-btn-trash"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>



















<script>
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
            success: function($usersResult) {
                for ($index = 0; $index < $usersResult.length; $index++) {
                    $('#userlist tbody:last-child').append(updateUsersTable($usersResult[$index]));
                }
            },
            error: function($usersResult) {},
            complete: function() {
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
            success: function($postsResult) {
                $postsList = {};
                for ($post in $postsResult) {
                    $userID = $postsResult[$post]['userId'];
                    if ($postsList[$userID] == "undefined") $postsList[$userID] = 0;
                    $postsList[$userID] = (($postsList[$userID]) > 0) ? $postsList[$userID] + 1 : 1;
                }
                $("#userlist tbody tr[data-user-id]").each(function() {
                    $userId = $(this).data("user-id");
                    $(this).find('.td-posts').html($postsList[$userId]);
                });
            },
            error: function($postsResult) {}
        });
    }

    // getting ALBUMS from users
    function getAlbums() {
        $albumsList = {};
        $.ajax({
            url: "https://jsonplaceholder.typicode.com/albums",
            dataType: 'json',
            contentType: 'application/json; charset=utf-8;',
            success: function($albumsResult) {
                for ($album in $albumsResult) {
                    $userID = $albumsResult[$album]['userId'];
                    if ($albumsList[$userID] == undefined) $albumsList[$userID] = 0;
                    $albumsList[$userID] = (($albumsList[$userID]) > 0) ? $albumsList[$userID] + 1 : 1;
                    $albumsList[$userID]['userId'] = $userID;
                }
                $("#userlist tbody tr[data-user-id]").each(function() {
                    $userId = $(this).data("user-id");
                    $(this).find('.td-albums').html($albumsList[$userId]);
                });
            },
            error: function($albumsResult) {},
            complete: function() {
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

    $(document).ready(function() {
        $tableUserlistBody = $('#userlist tbody');
        getUsers();

        $('.table-btn-trash').click(function(event) {
            event.preventDefault();
            console.log($(this).data('user-id'));
        });


        $("#searchUserList").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#userlist tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    });
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm to delete</h4>
            </div>
            <div class="modal-body">
                <p>Delete user id: <span id="modal-user-id"></span></p>
            </div>
            <div class="modal-footer">
                <a href="javascript:closeModal();" class="btn btn-default">Close</a>
                <a href="javascript:removeUser();" class="btn btn-danger">Confirm</a>
            </div>
        </div>
    </div>
</div>