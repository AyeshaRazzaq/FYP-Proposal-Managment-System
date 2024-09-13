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
                        <h6 class="mb-0">

                            <!-- display username -->
                            <?php
                            session_start();
                            if (isset($_SESSION['user_data'])) {
                                $username = $_SESSION['user_data']['name'];
                                echo "$username";
                            } else {
                                header("Location: signin.php");
                                exit();
                            }
                            ?>
                            </span>
                            <!-- end -->

                        </h6>
                        <span>Student</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="proposal-submission.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <!-- <a href="proposal-submission.php" class="nav-item nav-link active"><i class="fa fa-user-tie me-2"></i>Proposal</a> -->
                    <a href="meetingschedular.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Meetings</a>
                    <a href="project-sub.php" class="nav-item nav-link"><i class="bi bi-file-earmark-code-fill me-2"></i>Project</a>
                    <a href="stu-profile.php" class="nav-item nav-link"><i class="bi bi-person-circle me-2"></i>Profile</a>
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
                <h3 class="text-primary ms-3 mt-2 text-center">Students</h3>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">

                                <!-- display username -->
                                <?php
                                if (isset($_SESSION['user_data'])) {
                                    $username = $_SESSION['user_data']['name'];
                                    echo "$username";
                                } else {
                                    header("Location: signin.php");
                                    exit();
                                }
                                ?>
                            </span>
                            <!-- end -->

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

            <!-- Student proposal form start -->
            <div class="container-fluid pt-2 px-4">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-div mx-auto mb-3">
                            <form method="post" action="insert-form.php">
                                <!-- Populate form fields with user data -->
                                <div class="row mb-2">
                                <div class="col-md-4 my-2 d-flex justify-content-between align-items-center">
                                        <label for="name" class="me-2 fw-bold">Name:</label>
                                        <input type="text" class="form-control" id="class" placeholder="name" name="name" required>
                                    </div>
                                    <div class="col-md-4 my-2 d-flex justify-content-between align-items-center">
                                        <label for="class" class="me-2 fw-bold">Class:</label>
                                        <input type="text" class="form-control" id="class" placeholder="Class" name="class" required>
                                    </div>
                                    <div class="col-md-4 my-2 d-flex justify-content-between align-items-center">
                                        <label for="role" class="me-2 fw-bold">Supervisor:</label>
                                        <select id="role" class="form-select" required name="role">
                                            <?php 
                                                $connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
                                                $qry = mysqli_query($connection , "SELECT * FROM user WHERE role='supervisor'");
                                                while ($supervisor = mysqli_fetch_assoc($qry)) {
                                                    $name = $supervisor['name'];
                                                    $id = $supervisor['id'];
                                                    echo("<option value='$name'>$name</option>");
                                                }                                            
                                            ?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                <div class="col-md-4 d-flex justify-content-between align-items-center my-2">
                                        <label for="regno" class="me-2 fw-bold">Registration No</label>
                                        <input type="text" class="form-control" id="regno" placeholder="0000-GCUF-0000" name="regno" required>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-between align-items-center my-2">
                                        <label for="rollno" class="me-2 fw-bold">Roll No</label>
                                        <input type="text" class="form-control" id="rollno" placeholder="0000" name="rollno" required>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-between align-items-center my-2">
                                        <label for="email" class="me-2 fw-bold">Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="title" class="me-2 mb-2 fw-bold">Project Title:</label>
                                    <input type="text" class="form-control p-2" id="title" placeholder="Project Title" name="title">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="abstract" class="me-2 mb-2 fw-bold">Abstract:</label>
                                    <textarea class="form-control p-2" id="abstract" placeholder="Abstract" name="abstract" rows="3"></textarea>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="modules" class="me-2 mb-2 fw-bold">Major Components:</label><br>
                                    <ol>
                                        <li>
                                            <label for="module1" class="me-2 mb-2 fw-bold">Module 1:</label>
                                            <textarea class="form-control p-2" id="module1" placeholder="..." name="module1" rows="1"></textarea>
                                        </li>
                                        <li>
                                            <label for="module2" class="me-2 mb-2 fw-bold">Module 2:</label>
                                            <textarea class="form-control p-2" id="module2" placeholder="..." name="module2" rows="1"></textarea>
                                        </li>
                                        <li>
                                            <label for="module3" class="me-2 mb-2 fw-bold">Module 3:</label>
                                            <textarea class="form-control p-2" id="module3" placeholder="..." name="module3" rows="1"></textarea>
                                        </li>
                                    </ol>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="tools" class="me-2 mb-2 fw-bold">Tools and Techniques to be used:</label><br>
                                    <ol>
                                        <li>
                                            <label for="f-tools" class="me-2 mb-2 fw-bold">Frontend Tools and Techniques:</label>
                                            <textarea class="form-control p-2" id="f-tools" required placeholder="..." name="f-tools" rows="1"></textarea>
                                        </li>
                                        <li>
                                            <label for="b-tools" class="me-2 mb-2 fw-bold">Backend Tools and Techniques:</label>
                                            <textarea class="form-control p-2" id="b-tools" required placeholder="..." name="b-tools" rows="1"></textarea>
                                        </li>
                                    </ol>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary text-white mt-2 ms-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student proposal form End -->

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
</body>

</html>