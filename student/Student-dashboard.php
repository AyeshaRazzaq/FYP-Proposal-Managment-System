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
    <title>FYP Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <!-- <link href="img/favicon.ico" rel="icon"> -->

    <!-- Google Web Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet"> -->

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

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
                        <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                        <?php
                                if (isset($_SESSION['user_data'])) {
                                    $username = $_SESSION['user_data']['name'];
                                    echo "$username";
                                } else {
                                    header("Location: signin.php");
                                    exit();
                                }
                                ?>
                        </h6>
                        <span>Student</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="proposal-submission.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <!-- <a href="proposal-submission.php" class="nav-item nav-link"><i class="fa fa-user-tie me-2"></i>Proposal</a> -->
                    <a href="meetingschedular.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Meetings</a>
                    <a href="project-sub.php" class="nav-item nav-link"><i class="bi bi-file-earmark-code-fill me-2"></i>Project</a>
                    <a href="stu-profile.php" class="nav-item nav-link"><i class="bi bi-person-circle me-2"></i>Profile</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->
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
                <h3 class="text-primary ms-3 mt-2 text-center">Dashboard</h3>
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">
                                <?php
                                if (isset($_SESSION['user_data'])) {
                                    $username = $_SESSION['user_data']['name'];
                                    echo "$username!";
                                } else {
                                    header("Location: signin.php");
                                    exit();
                                }
                                ?>

                            </span>
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
            <?php
            $connection = mysqli_connect("localhost", "root", "", "mysqli_fyp");

            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $class = $_POST['class'];
                $role = $_POST['role'];
                $regno = $_POST['regno'];
                $rollno = $_POST['rollno'];
                $email = $_POST['email'];
                $title = $_POST['title'];
                $abstract = $_POST['abstract'];
                $module1 = $_POST['module1'];
                $module2 = $_POST['module2'];
                $module3 = $_POST['module3'];
                $ftools = $_POST['f-tools'];
                $btools = $_POST['b-tools'];
                $status = $_POST['status'];
                
            
                $query = "INSERT INTO proposals (`name`, `class`, `role`, `regno`, `rollno`,  `email`, `title`, `abstract`, `module1`, `module2`, `module3`, `f-tools`, `b-tools`, `status`) 
                          VALUES ('$name', '$class', '$role', '$regno', '$rollno', '$email', '$title', '$abstract', '$module1', '$module2', '$module3', '$ftools', '$btools', '$status')";
            
                if (mysqli_query($connection, $query)) {
                    echo "Data inserted successfully";
                    // header('Location: proposal-submission.php');
                } else {
                    echo "Error: " . mysqli_error($connection);
                }
            }
            ?>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="mb-4 text-end me-5">
                            <!--student proposal submit session -->
                        <?php
                        if (isset($_SESSION['submit'])) {
                        ?>
                            <div id="alert-success" class="alert alert-danger mx-auto mt-4 alert-sm alert-dismissible fade show" role="alert">
                                <?php echo ($_SESSION['submit']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['submit']);
                        }
                        ?>
                        <!--student proposal session end -->
                        <a href="proposal-form.php" class="btn btn-sm btn-primary px-3 py-2">Add</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Name</th>
                                    <th scope="col">Roll No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Supervisor</th>
                                    <th scope="col">File</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM proposals WHERE name='$username'";
                                $result = mysqli_query($connection, $query);

                                // Display fetched data in the table
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "$username";
                                    echo "</td>";
                                    echo "<td>" . $row['rollno'] . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['class'] . "</td>";
                                    echo "<td>" . $row['role'] . "</td>";
                                    $id = $row['id'];
                                    echo "<td>";
                                    echo "<a href='print-details.php?id=$id'>details</a>"; 
                                    echo "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "</tr>";
                                }
                                mysqli_close($connection);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Student table End -->


            <!-- Student table End -->


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