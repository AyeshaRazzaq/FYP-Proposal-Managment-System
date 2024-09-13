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
                        <span>Supervisor</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="supervisor-dashboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Proposals</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="proposals.php" class="nav-item nav-link"><i class="bi bi-file-earmark-medical-fill me-2"></i>pending</a>
                            <a href="total-proposals.php" class="nav-item nav-link"><i class="bi bi-file-earmark-medical-fill me-2"></i>Total Proposals</a>
                            <a href="acc-proposals.php" class="nav-item nav-link active"><i class="bi bi-file-earmark-check-fill me-2"></i>Accepted</a>
                            <a href="rej-proposals.php" class="nav-item nav-link"><i class="bi bi-file-earmark-excel-fill me-2"></i>Rejected</a>
                            <a href="Cond-approved.php" class="nav-item nav-link d-flex justify-content-center">
                                <i class="bi bi-file-earmark-diff-fill me-2"></i>
                                <span class="d-flex align-items-center">Conditionally Approved</span>
                            </a>
                        </div>
                    </div>
                    <a href="meeting.php" class="nav-item nav-link"><i class="bi bi-bell-fill me-2"></i>Meetings</a>
                    <a href="project.php" class="nav-item nav-link "><i class="bi bi-file-earmark-code-fill me-2"></i>Project</a>
                    <a href="profile.php" class="nav-item nav-link"><i class="bi bi-person-fill me-2"></i>Profile</a>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="supervisor-dashboard.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h3 class="text-center text-primary my-2 ps-2">Accepted Proposals</h3>
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
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <!-- table start  -->
            <div class="container-fluid pt-4 px-4 mt-3">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 text-end">
                        <form method="post" class="d-sm-flex">
                            <input type="text" name="valuetosearch" placeholder="Search...">
                            <button class="btn btn-primary rounded text-white btn-sm ms-1" type="submit" name="search" value="filter">Search</button>
                        </form>
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
                                    <th scope="col" colspan="3" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if form is submitted
                                $query = "SELECT * FROM proposals WHERE role = '$username' AND status='Approved'";
                                // Modify the query if search is performed
                                if (isset($_POST['search'])) {
                                    $valuetosearch = $_POST['valuetosearch'];
                                    $query = "SELECT * FROM proposals WHERE role = '$username' AND (name LIKE '%$valuetosearch%' OR rollno LIKE '%$valuetosearch%' OR title LIKE '%$valuetosearch%' OR class LIKE '%$valuetosearch%' OR role LIKE '%$valuetosearch%' OR status LIKE '%$valuetosearch%')";
                                }
                                $result = mysqli_query($connection, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td> ";
                                        echo $row['name'];
                                        echo  "</td>";
                                        echo "<td>";
                                        echo $row['rollno'];
                                        echo "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['class'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
                                        $id = $row['id'];
                                        echo "<td>  <a href='../student/print-details.php?id=$id'>details</a>";
                                        echo "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>>No results found</td></tr>";
                                }
                                // Close the database connection
                                mysqli_close($connection);
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- table end -->
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