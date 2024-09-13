<?php
session_start();
$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
if (!isset($_SESSION['user_data'])) {
    header("Location:signin.php");
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
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="admin-dashboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="supervisor.php" class="nav-item nav-link active"><i class="fa fa-user-tie me-2"></i>Supervisors</a>
                    <a href="students.php" class="nav-item nav-link "><i class="fa fa-user me-2"></i>Students</a>
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
                <h3 class="text-primary ms-3 mt-2 text-center">Supervisors</h3>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">
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

            <!-- Check if form is submitted -->
            <?php
            $connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
            if (isset($_POST['submit'])) {

                $name = $_POST['name'];
                $email = $_POST['email'];
                $cnic = $_POST['cnic'];
                $contactno = $_POST['contactno'];
                $regno = $_POST['delegation'];
                $role = $_POST['role'];
                $result = mysqli_query($connection, "INSERT into user('username','email','cnic','contactno','delegation','role')VALUES('$name','$email','$cnic','$contactno','$delegation','$role')");
            }
            ?>

            <!-- Supervisor Table start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="mb-4 mx-4 d-flex justify-content-between align-items-center text-end">
                        <form method="post" class="d-sm-flex">
                            <input type="text" name="valuetosearch" placeholder="Search...">
                            <button class="btn btn-primary rounded text-white btn-sm ms-1" type="submit" name="search" value="filter">Search</button>
                        </form>

                        <!--edit success session start -->
                        <?php
                        if (isset($_SESSION['alert_update'])) {
                        ?>
                            <div id="alert-success" class="alert alert-success mx-auto mt-4 alert-sm alert-dismissible fade show" role="alert">
                                <?php echo ($_SESSION['alert_update']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['alert_update']);
                        }
                        ?>
                        <!--edit success session end -->

                         <!--del student session start -->
                         <?php
                        if (isset($_SESSION['delstudent'])) {
                        ?>
                            <div id="alert-success" class="alert alert-success mx-auto mt-4 alert-sm alert-dismissible fade show" role="alert">
                                <?php echo ($_SESSION['delstudent']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['delstudent']);
                        }
                        ?>
                        <!--del sup session end -->

                        <!--sup not delete session start -->
                        <?php
                        if (isset($_SESSION['notdel'])) {
                        ?>
                            <div id="alert-success" class="alert alert-danger mx-auto mt-4 alert-sm alert-dismissible fade show" role="alert">
                                <?php echo ($_SESSION['notdel']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['notdel']);
                        }
                        ?>
                        <!--sup not delete session end -->

                        <!--add sup session start -->
                        <?php
                        if (isset($_SESSION['data-inserted'])) {
                        ?>
                            <div id="alert-success" class="alert alert-success mx-auto mt-4 alert-sm alert-dismissible fade show" role="alert">
                                <?php echo ($_SESSION['data-inserted']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['data-inserted']);
                        }
                        ?>
                        <!--sup not delete session end -->

                        <a href="signup.php" class="btn btn-sm btn-primary px-3 py-2">Add</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col">id</th> -->
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">CNIC</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Delegation</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" colspan="2" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "", "mysqli_fyp");
                                if (!$connection) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // Check if form is submitted
                                if (isset($_POST['search'])) {
                                    $valuetosearch = $_POST['valuetosearch'];
                                    $query = "SELECT * FROM user WHERE role = 'supervisor' AND CONCAT(`name`, `email`, `cnic`, `contactno`,`delegation`) LIKE '%" . $valuetosearch . "%'";
                                } else {
                                    $query = "SELECT * FROM user WHERE role = 'supervisor'";
                                }
                                $result = mysqli_query($connection, $query);

                                // Display fetched data in the table
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    // echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['cnic'] . "</td>";
                                    echo "<td>" . $row['contactno'] . "</td>";
                                    echo "<td>" . $row['delegation'] . "</td>";
                                    echo "<td>" . $row['role'] . "</td>";
                                    echo "<td>";
                                    echo "<a class='btn btn-primary btn-sm px-3' href='edit-sup-form.php?id=" . $row['id'] . "'>Edit</a>";
                                    echo "<td>";
                                    echo "<form action='del-sup.php' method='POST'>";
                                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                    echo "<button type='submit' class='btn btn-primary btn-sm' name='delete'>Delete</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                mysqli_close($connection);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Supervisor table End -->




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
            document.getElementById('alert-success').classList.add('d-none'); // Hide the alert
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>

</html>