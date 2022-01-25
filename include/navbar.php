<div class="page-wrapper">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar">
        <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
        </a>
        <div class="navbar-content">
            <form class="search-form">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <img src="assets\logo\weltec.jpg" class="img w-75 h-75" alt="weltec">
                        </div>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">

                </li>
                <li class="nav-item dropdown nav-apps">

                </li>
                <li class="nav-item dropdown nav-messages">


                </li>
                <li class="nav-item dropdown nav-notifications">


                </li>
                <li class="nav-item dropdown nav-profile">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if (isset($GLOBALS['site_options']['site_logo']) && !empty($GLOBALS['site_options']['site_logo'])) {
                        ?>
                            <img src="assets/images/<?php echo $GLOBALS['site_options']['site_logo']; ?>" alt="profile">
                        <?php
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <div class="dropdown-header d-flex flex-column align-items-center">
                            <div class="figure mb-3">
                                <?php
                                if (isset($GLOBALS['site_options']['site_logo']) && !empty($GLOBALS['site_options']['site_logo'])) {
                                ?>
                                    <img src="assets/images/<?php echo $GLOBALS['site_options']['site_logo']; ?>" alt="profile">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="info text-center">
                                <p class="name font-weight-bold mb-0">Solanki Sanjay</p>
                                <p class="email text-muted mb-3">sanjay@gmail.com</p>
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <ul class="profile-nav p-0 pt-3">
                                <li class="nav-item">
                                    <a href="myprofile.php" class="nav-link">
                                        <i data-feather="user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link">
                                        <i data-feather="edit"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link">
                                        <i data-feather="repeat"></i>
                                        <span>Switch User</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link">
                                        <i data-feather="log-out"></i>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- partial -->