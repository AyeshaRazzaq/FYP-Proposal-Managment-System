<?php
$user_id = $_SESSION['pdf_id'];
$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
$query = "SELECT * from proposals WHERE id = $user_id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="col-md-12">
                <div class="form-div mx-auto">
                    <form method="post" action="insert-form.php">
                        <div class="mb-3 d-flex align-items-center mt-4 row">
                            <div class="col-md-4 col-sm-8">
                            <h5 class="me-2 fw-semibold mt-3">Class</h5>
                                <div class="col-md-6">
                                    <?= $row['class']  ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-8">
                            <h5 class="me-2 fw-semibold mt-3">Supervisors</h5>
                                <div class="col-md-6">
                                    <?= $row['role']  ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-8">
                            <h5 class="me-2 fw-semibold mt-3">Registration No</h5>
                                <div class="col-md-6">
                                    <?= $row['regno']  ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-8">
                            <h5 class="me-2 fw-semibold mt-3">Email Address</h5>
                                <div class="col-md-6">
                                    <?= $row['email']  ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                        <h5 class="me-2 fw-semibold mt-3">Project Title</h5>
                            <div class="col-md-6">
                                    <?= $row['title']  ?>
                                </div>
                            <h5 class="me-2 fw-semibold mt-3">Abstract</h5>
                            <div class="col-md-6">
                                    <?= $row['abstract']  ?>
                                </div>
                        </div>
                        <div class="mb-3 mt-4">
                        <h4 class="me-2 fw-semibold mt-3">Major component/modules</h4>
                            <div class="mb-3">
                                <h5 class="me-2 fw-semibold mt-3">Module 1</h5>
                                <div class="col-md-6">
                                    <?= $row['module1']  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h5 class="me-2 fw-semibold mt-3">Module 2</h5>
                                <div class="col-md-6">
                                    <?= $row['module2']  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h5 class="me-2 fw-semibold mt-3">Module 3</h5>
                                <div class="col-md-6">
                                    <?= $row['module3']  ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                        <h4 class="me-2 fw-semibold mt-3">Tools and techniques to be used</h4>
                            <ol>
                                <li>
                                <h5 class="me-2 fw-semibold mt-3">Frontend tools and techniques</h5>
                                    <div class="col-md-6">
                                    <?= $row['f-tools']  ?>
                                </div>
                                </li>
                                <li>
                                <h5 class="me-2 fw-semibold mt-3">Backened tools and techniques</h5>
                                    <div class="col-md-6">
                                    <?= $row['b-tools']  ?>
                                </li>
                            </ol>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </form>

</div>