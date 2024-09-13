<?php
session_start();
$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
if (!isset($_SESSION['user_data'])) {
    header("Location:../signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FYP</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand text-center ms-1 mb-3">
                    <h5 class="text-primary">FYP Management System</h5>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                    </div>
                    <div class="ms-3">
                    <?php
                            if (isset($_SESSION['user_data'])) {
                                $username = $_SESSION['user_data']['name'];
                                echo "$username";
                            } else {
                                header("Location: signin.php");
                                exit();
                            }
                            ?>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="supervisor-dashboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="proposals.php" class="nav-item nav-link"><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Proposals</a>
                    <a href="meeting.php" class="nav-item nav-link "><i class="bi bi-bell-fill me-2"></i>Meeting Schedular</a>
                    <a href="progress.php" class="nav-item nav-link"><i class="bi bi-graph-up me-2"></i>Progress</a>
                    <a href="chat.php" class="nav-item nav-link  active"><i class="bi bi-chat-dots-fill"></i>Chat</a>
                    <a href="profile.php" class="nav-item nav-link"><i class="bi bi-person-fill"></i>Profile</a>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0 ">
                <a href="supervisor-dashboard.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h3 class="text-center text-primary my-2 ps-2">Response</h3>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">
                                <?php
                                echo "$username";
                                ?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="profile.html" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="logout.html" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <!-- Response form start -->
            <div class="container-fluid pt-2 px-4">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-div mx-auto mb-3">
                            <form method="post" action="insert-chat.php">
                                <?php
                                if (isset($_SESSION['error'])) {
                                ?>
                                    <div id="alert-success" class="alert alert-danger mx-auto mt-4 alert-sm alert-dismissible fade show" role="alert">
                                        <?php echo ($_SESSION['error']) ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                    unset($_SESSION['error']);
                                }
                                ?>
                                <!-- Populate form fields with user data -->
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label for="name" class="me-2 fw-bold">Student:</label>
                                        <select id="name" class="form-select" required name="name">
                                            <?php
                                            // Reusing the existing connection
                                            $qry = mysqli_query($connection, "SELECT * FROM proposals WHERE role='$username'"); // Adjust query based on your requirements
                                            while ($student = mysqli_fetch_assoc($qry)) {
                                                $name = $student['name'];
                                                echo ("<option value='$name'>$name</option>");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="me-2 fw-bold">Supervisor:</label>
                                        <select id="name" class="form-select" required name="supervisor">
                                            <?php
                                            // Reusing the existing connection
                                            $qry = mysqli_query($connection, "SELECT * FROM user WHERE role='supervisor'"); // Adjust query based on your requirements
                                            while ($student = mysqli_fetch_assoc($qry)) {
                                                $name = $student['name'];
                                                echo ("<option value='$name'>$name</option>");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="note" class="me-2 mb-2 fw-bold">Note</label>
                                        <textarea name="note" required class="form-control" id="note"></textarea>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary text-white mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Response form end -->
        </div>
        <!-- content end -->
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
</body>

</html>