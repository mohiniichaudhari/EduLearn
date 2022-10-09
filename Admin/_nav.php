
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/style.css">
    
    
    <?php include_once "connection.php" ?>
    <?php
    $query = "SELECT * FROM tblregister WHERE status=0";
    $res = mysqli_query($Cnn, $query);
    ?>

    <!-- START OF NAV -->
    <nav class="navbar navbar-expand-lg bg-dark text-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 " id="btn-notif" style="position: relative;margin-left: 400px;">

                    <!-- Notifications     -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            &#9993;<span class="badge text-bg-light" id="cntNotif"><?php echo mysqli_num_rows($res); ?></span>
                        </a>
                        <ul class="dropdown-menu bg-light">
                            <?php
                            if (mysqli_num_rows($res) > 0) {
                                while ($rec = mysqli_fetch_array($res)) {
                            ?>
                                    <li>
                                        <a class="dropdown-item" href="newRequests.php">
                                            <?php echo "You have a notification from <b>" . $rec["email_id"] . "</b>" ?>
                                            <hr/>
                                        </a>
                                    </li>
                                <?php
                                }
                            } else {
                                ?>
                                <li>No New Requests !!</li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>

                    <!-- User Profile -->
                    <li class="nav-item dropdown" style="margin-left: 30px;">
                        <a href="admin_profile.php" style="color: white;font-size: 26px;text-decoration: none;">
                            <b>
                                <?php if (isset($_SESSION['admin_email'])) echo $_SESSION['admin_email']; ?>
                            </b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="../JS/script.js"></script>