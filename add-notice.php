<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == "") {  
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $ntitle = $_POST['noticetitle'];
        $ndetails = $_POST['noticedetails']; 
        
        $sql = "INSERT INTO tblnotice(noticeTitle, noticeDetails) VALUES(:ntitle, :ndetails)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':ntitle', $ntitle, PDO::PARAM_STR);
        $query->bindParam(':ndetails', $ndetails, PDO::PARAM_STR);
        $query->execute();
        
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo '<script>alert("Notice added successfully")</script>';
            echo "<script>window.location.href ='manage-notices.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS Admin | Add Notice</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include('includes/topbar.php'); ?>   
            <div class="content-wrapper">
                <div class="content-container">
                    <?php include('includes/leftbar.php'); ?>
                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Add Notice</h2>
                                </div>
                            </div>
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="#">Notices</a></li>
                                        <li class="active">Add Notice</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Add Notice</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <form method="post">
                                                    <div class="form-group has-success">
                                                        <label for="noticetitle" class="control-label">Notice Title</label>
                                                        <input type="text" name="noticetitle" class="form-control" required id="noticetitle">
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="noticedetails" class="control-label">Notice Details</label>
                                                        <textarea class="form-control" name="noticedetails" required rows="5"></textarea>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <button type="submit" name="submit" class="btn btn-success btn-labeled">
                                                            Submit <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
<?php } ?>