<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 15/06/2017
 * Time: 10:33
 */
include('permisson.php');
include('handleRequest.php');
include('DB/User.php');
$user = new User();
$result = $user->getJsonFromRouter();
$arrayFromJson = json_decode($result, true);
$listUserFromDb = $user->getAll();
$authenticated = 0;
$deauthenticated = 0;
$listClientsFromJon = [];
if (isset($arrayFromJson['clients'])) {
    $listClientsFromJon = ($arrayFromJson['clients']);
    foreach ($listClientsFromJon as $value) {
        if ($value['state'] == User::STATUS_AUTHENTICATED) {
            $authenticated++;
        }
        if ($value['state'] == User::STATUS_PREAUTHENTICATED) {
            $deauthenticated++;
        }
    }
}
$block = 0;
foreach ($listUserFromDb as $k => $value) {
    if ($value['status'] == User::STATUS_BLOCK) {
        $block++;
    }
}
//reset($listAuthenticateFromDb);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Manage Account | Wifi One Time Password</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen,projection"/>
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" media="screen,projection"/>
    <link href="assets/css/manage.css" rel="stylesheet" type="text/css" media="screen,projection"/>
    <link href="assets/dataTable/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"
          media="screen,projection"/>
    <link href="assets/dataTable/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"
          media="screen,projection"/>
    <link href="assets/toast/toastr.min.css" rel="stylesheet" type="text/css"
          media="screen,projection"/>
</head>
<body>
<div class="containers" style="margin: 15px">
    <br/>
    <nav class="navbar navbar-default" style="background-color: #5bc0de;color: white">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/manage.php">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/generate.php">Generate Account</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li style="margin-top: 15px">
                        Welcome user: <strong> <?= $_SERVER['USER']; ?></strong>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-sitemap fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= isset($arrayFromJson['client_length']) ? $arrayFromJson['client_length'] : '0'; ?></div>
                            <div>Total current users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $authenticated; ?></div>
                            <div>Authenticated</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-secret fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $deauthenticated; ?></div>
                            <div>Preauthenticate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-times fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $block; ?></div>
                            <div>Block</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List Users
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%"
                           class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                           id="dataTables-users" role="grid" aria-describedby="dataTables-example_info"
                           style="width: 100%;">
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>
<div class="area-modal"></div>
</body>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/dataTable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets/dataTable/js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="assets/toast/toastr.min.js"></script>
<script>
    function initToast(type, msg) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr[type](msg);
    }
    <?php if (isset($_SESSION['toast'])) :?>
    initToast("<?=$_SESSION['toast']['type']?>", "<?=$_SESSION['toast']['msg']?>");
    <?php unset($_SESSION['toast'])?>
    <?php endif;?>
    var dataSet = [], dataTable;
    function getAndSetData() {
        dataSet = [];
        var data = <?=json_encode($listUserFromDb, true);?>;
        for (var index = 0; index < data.length; index++) {
            var tempObject = [];
            tempObject.push(index + 1);
            tempObject.push(data[index].username);
            tempObject.push(data[index].password);
            tempObject.push(data[index].ip);
            tempObject.push(data[index].mac_address);
            tempObject.push(data[index].token);
            tempObject.push(initStates(data[index].status));
            tempObject.push(initTime(data[index].ts_login));
            tempObject.push('<div class="time-out-">' + initTime(data[index].ts_time_out) + '</div>');
            tempObject.push(data[index].id);
            tempObject.push(data[index].min_time_out);
            dataSet.push(tempObject);
        }
        //From router
        var dataFromRouter = <?=json_encode(array_values($listClientsFromJon), true);?>;
        for (var i = 0; i < dataFromRouter.length; i++) {
            if (dataFromRouter[i].state == '<?=User::STATUS_PREAUTHENTICATED;?>') {
                var tempObjects = [];
                tempObjects.push(data.length + i);
                tempObjects.push(null);
                tempObjects.push(null);
                tempObjects.push(dataFromRouter[i].ip);
                tempObjects.push(dataFromRouter[i].mac);
                tempObjects.push(dataFromRouter[i].token);
                tempObjects.push(initStates(dataFromRouter[i].state));
                tempObjects.push(null);
                tempObjects.push(null);
                tempObjects.push(null);
                tempObjects.push(null);
                dataSet.push(tempObjects);
            }
        }
        var table = $('#dataTables-users');
        table.dataTable().fnClearTable();
        table.dataTable().fnAddData(dataSet);
    }
    $('#dataTables-users').DataTable({
        initComplete: function () {
            getAndSetData();
        },
        "iDisplayLength": 100,
        "bFilter": true,
        "data": dataSet,
        "ordering": true,
        "paging": true,
        "columns": [
            {"title": "#"},
            {"title": "Username"},
            {"title": "Password"},
            {"title": "Ip"},
            {"title": "MacAddress"},
            {"title": "Token"},
            {"title": "Status"},
            {"title": "Time Login"},
            {"title": "Time End"},
            {"title": "ID", 'visible': false},
            {"title": "MinTimeOut", 'visible': false},
            {"title": "Action"}
        ],
        "aoColumnDefs": [
            {
                "aTargets": [11],
                "mData": null,
                "mRender": function (data, type, full) {
                    var states = $(data[6]).html();
                    switch (states) {
                        case '<?=User::STATUS_AVAILABLE;?>':
                            return '<a type="button" data-class="btn btn-warning" action="update" class="btnEdit btn btn-warning" data-action="edit" data-min="' + data[10] + '" data-id="' + data[9] + '">Edit</a>'
                            break;
                        case '<?=User::STATUS_AUTHENTICATED;?>':
                            return '<a type="button" action="update" class="btnBlock btn btn-danger" data-class="btn btn-danger" data-mac="' + data[4] + '" data-action="block" data-id="' + data[9] + '">Block</a>' +
                                '<a type="button" data-class="btn btn-warning" style="margin-left: 10px" action="update" class="btnUpdate btn btn-warning" data-mac="' + data[4] + '" data-action="update" data-id="' + data[9] + '">Update Time</a>'
                            break;
                        case '<?=User::STATUS_PREAUTHENTICATED;?>':
                            return '<a type="button" data-class="btn btn-info" action="update" class="btnAuth btn btn-info" data-mac="' + data[4] + '" data-ip="' + data[3] + '" data-token="' + data[5] + '" data-action="authenticate">Authenticate</a>'
                            break;
                        case '<?=User::STATUS_SESSION_TIME_OUT;?>':
                            return '<a type="button" id="btnDelete" action="update" class="btn btn-delete" href="?action=delete&id=' + data[9] + '">Delete</a>'
                            break;
                        case '<?=User::STATUS_BLOCK;?>':
                            return '<a type="button" id="btnUnBlock" action="update" class="btn btn-success" href="?action=unblock&id=' + data[9] + '&mac=' + data[4] + '">UnBlock</a>'
                            break;
                    }
                }
            }
        ]
    });
    function initStates(states) {
        switch (states) {
            case '<?=User::STATUS_AVAILABLE;?>':
                return '<span class="label label-primary">' + states + '</span>'
                break;
            case '<?=User::STATUS_AUTHENTICATED;?>':
                return '<span class="label label-success">' + states + '</span>'
                break;
            case '<?=User::STATUS_PREAUTHENTICATED;?>':
                return '<span class="label label-info">' + states + '</span>'
                break;
            case '<?=User::STATUS_SESSION_TIME_OUT;?>':
                return '<span class="label label-warning">' + states + '</span>'
                break;
            case '<?=User::STATUS_BLOCK;?>':
                return '<span class="label label-danger">' + states + '</span>'
                break;
        }
    }
    function initTime(timestamp) {
        if (timestamp != null) {
            var d = new Date(timestamp * 1000);
            return d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
        }
        return '';
    }
    function countDowTimeOut(dateTime) {
        var now = new Date().getTime();
        if (timestamp != null) {

            var countDownDate = new Date().getTime();
            var x = setInterval(function () {
                now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // If the count down is over, write some text
                id = 'time-out-' + id;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(id).innerHTML = initTime(timestamp);
                }
                document.getElementById(id).innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";
            }, 1000);

        }
    }
    function initModal(title, body, className, btnText) {
        var htmlModalConfirm =
            '<div class="modal fade" id="modalConfirm" role="dialog">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content"> ' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">' + title + '</h4>' +
            '</div>' +
            '<form method="get">' +
            '<div class="modal-body">' +
            body +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="submit" class="btnSubmit ' + className + '">' + btnText + '</button>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '</div>' +
            '</form>' +
            '</div>' +
            '</div>' +
            '</div>';
        var _body = $('body');
        _body.find('#modalConfirm').remove();
        _body.find('.area-modal').append(htmlModalConfirm);
        $('#modalConfirm').modal('show');
    };
    $('.btnAuth').click(function () {
        var t = $(this);
        var body = '<div class="form-group">' +
            '<input type="hidden" name="token" value="' + t.attr('data-token') + '">' +
            '<input type="hidden" name="action" value="' + t.attr('data-action') + '">' +
            '<input type="hidden" name="ip" value="' + t.attr('data-ip') + '">' +
            '<input type="hidden" name="mac" value="' + t.attr('data-mac') + '">' +
            '<label for="time">Time Out (Minutes)</label>' +
            '<input type="number" name="min_time_out" min="2" value="2" required class="form-control" id="time" placeholder="Time Out (Minutes)">' +
            '</div>';
        initModal('Authenticate', body, t.attr('data-class'), t.html());
        return false;
    });
    $('.btnBlock').click(function () {
        var t = $(this);
        var body = '<div class="form-group">' +
            '<input type="hidden" name="mac" value="' + t.attr('data-mac') + '">' +
            '<input type="hidden" name="action" value="' + t.attr('data-action') + '">' +
            '<input type="hidden" name="id" value="' + t.attr('data-id') + '">' +
            '<h3 style="text-align: center">Are you sure want to block this user?</h3>' +
            '</div>';
        initModal('Block', body, t.attr('data-class'), t.html());
        return false;
    });
    $('.btnEdit').click(function () {
        var t = $(this);
        var body = '<div class="form-group">' +
            '<input type="hidden" name="id" value="' + t.attr('data-id') + '">' +
            '<input type="hidden" name="action" value="' + t.attr('data-action') + '">' +
            '<label for="time">Time Out (Minutes)</label>' +
            '<input type="number" name="min_time_out" min="2" value="'+t.attr('data-min')+'" required class="form-control" id="time" placeholder="Time Out (Minutes)">' +
            '</div>';
        initModal('Edit', body, t.attr('data-class'), t.html());
        return false;
    });
    $('.btnUpdate').click(function () {
        var t = $(this);
        var body = '<div class="form-group">' +
            '<input type="hidden" name="id" value="' + t.attr('data-id') + '">' +
            '<input type="hidden" name="action" value="' + t.attr('data-action') + '">' +
            '<label for="time">Time Update (Minutes)</label>' +
                '<br/>'+
                '<span style="font-style: italic;opacity: 0.6">(Ex: Add 2 minutes: 2, Down 2 minutes: -2)</span>'+
            '<input type="number" name="min_time_out" value="'+t.attr('data-min')+'" required class="form-control" id="time" placeholder="Time Update (Minutes)">' +
            '</div>';
        initModal('Update ', body, t.attr('data-class'), t.html());
        return false;
    });


</script>
</html>