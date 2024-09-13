<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FYP Management System</title>
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
                <a href="admin-dashboard.php" class="navbar-brand mb-3">
                    <h5 class="text-primary">FYP Management System</h5>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Amjad Taqi</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="admin-dashboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="supervisor.php" class="nav-item nav-link"><i class="fa fa-user-tie me-2"></i>Supervisors</a>
                    <a href="students.php" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Students</a>
                    <a href="proposal.php" class="nav-item nav-link"><i class="bi bi-file-arrow-down-fill me-2"></i>Proposal</a>
                    <a href="project.php" class="nav-item nav-link"><i class="bi bi-file-earmark-code-fill me-2"></i>Project</a>
                    <a href="profile.php" class="nav-item nav-link"><i class="bi bi-person-circle me-2"></i>Profile</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="admin-dashboard.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h3 class="text-primary ms-3 mt-2 text-center">Edit Student Data</h3>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Amjad Taqi</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- student update form start -->
            <div class="container-fluid pt-2 px-4">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <?php
                        $connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
                        $stu_id = $_GET['id'];
                        $sql = "SELECT * from user WHERE id = {$stu_id}";
                        $result = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                         <!--not update session start -->
                         <?php
                        if (isset($_SESSION['alert_not_update'])) {
                        ?>
                            <div id="alert-danger" class="alert alert-danger mx-auto mt-4 alert-sm alert-dismissible fade show" role="alert">
                                <?php echo ($_SESSION['alert_not_update']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['alert_not_update']);
                        }
                        ?>
                        <!--not update session end -->

                                <div class="form-div mx-auto">
                                    <form method="post" action="edit.php">
                                        <!-- Populate form fields with user data -->
                                        <label for="id" class="form-label fw-bold"></label>
                                        <input type="hidden" id="id" name="id" class="form-control" placeholder="id" required value="<?php echo $row['id']; ?>">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingText" placeholder="name" name="name" value="<?php echo $row['name']; ?>" required>
                                            <label for="floatingText">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php echo $row['email']; ?>" required>
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingText" placeholder="2020-GCUF-0000" name="regno" value="<?php echo $row['regno']; ?>">
                                            <label for="floatingText">Registration no</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Contact Number" name="contactno" value="<?php echo $row['contactno']; ?>" required>
                                            <label for="floatingInput">Contact Number</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="CNIC" name="cnic" value="<?php echo $row['cnic']; ?>" required>
                                            <label for="floatingInput">CNIC</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Password" name="password" value="<?php echo $row['password']; ?>">
                                            <label for="floatingInput">Password</label>
                                        </div>
                                        <button type="submit" name="update" class="btn btn-primary text-white mt-2">Update</button>
                                    </form>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /student update form end -->




        <!-- Footer Start -->
        <!-- <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

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
    <script>
        // JavaScript code to dismiss the alert after 3 seconds
        setTimeout(function() {
            document.getElementById('alert-danger').classList.add('d-none'); // Hide the alert
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>

</html>