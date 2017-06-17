<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 13/06/2017
 * Time: 13:29
 */
include('permisson.php');
include 'CommonFunction.php';

$result = [];
$username = CommonFunction::generateRandomString(7);
$password = CommonFunction::generateRandomString(7);
if (isset($_POST['submit'])) {
    include 'DB/User.php';
    $user = new User();
    $usernameG = $_POST['username'];
    $passwordG = $_POST['password'];   
    $timeCreated = date('Y-m-d H:i:s', time());
    $minTimeOut = $_POST['min_time_out'] ? (int)$_POST['min_time_out'] : 2;
    $res = $user->insert([$usernameG, $passwordG, User::STATUS_AVAILABLE, $timeCreated, $minTimeOut]);
    if ($res) {
        $result = [
            'username' => $usernameG,
            'password' => $passwordG,
            'timeCreated' => $timeCreated,
            'min_time_out' => $minTimeOut,
            'success' => true
        ];
    } else {
        $result = [
            'success' => false
        ];
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Generate Account</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen,projection"/>
    <link rel="stylesheet" href="assets/css/generate-account.css" type="text/css" media="screen,projection"/>
</head>
<body>
<div id="fullscreen_bg" class="fullscreen_bg"/>
<div id="regContainer" class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="active" id="login-form-link">Generate Account</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="form-group">
                                    <label>Minutes Time Out</label>
                                    <input type="number" name="min_time_out" required class="form-control"
                                           placeholder="Minutes Time Out"
                                           value="<?= isset($result['min_time_out']) ? $result['min_time_out'] : 2; ?>"/>
                                </div>
                                 <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" required class="form-control"
                                           placeholder="Type username" value="<?=$username;?>" />
                                </div>
                                 <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" required class="form-control"
                                           placeholder="Type password" value="<?=$password;?>" />
                                </div>
                                <div class="form-group">
                                    <?php if (!empty($result) && $result['success']): ?>
                                        <div class="alert alert-success" style="line-height: 2;font-size: 25px">
                                            <strong>Username: </strong> <?= $result['username']; ?>
                                            <br/>
                                            <strong>Password: </strong> <?= $result['password']; ?>
                                            <br/>
                                            <strong>Created At: </strong> <?= $result['timeCreated']; ?>
                                            <br/>
                                            <strong>Minutes Time Out: </strong> <?= $result['min_time_out']; ?>
                                            <br/>
                                        </div>
                                    <?php elseif (isset($result['success']) && !$result['success']): ?>
                                        <div class="alert alert-error" style="line-height: 2;font-size: 25px">
                                            Cannot create account
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="submit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-login" value="Generate">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
