<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <?php echo $GLOBALS['site_options']['site_title']; ?>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Home</span>
                </a>
            </li>


            <li class="nav-item nav-category">Menu</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Inquiry</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="inquiry.php" class="nav-link">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="link-title">Inquiry</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="todayinquiry.php" class="nav-link">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="link-title">Today Inquiry</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="lastweek.php" class="nav-link">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="link-title">Last Week Inquiry</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="todayfollow.php" class="nav-link">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="link-title">Today Follow Up</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="weekfollow.php" class="nav-link">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="link-title">last Week Follow Up</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="course.php" class="nav-link">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Course</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="facultydata.php" class="nav-link">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Faculty</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#icons" role="button" aria-expanded="false" aria-controls="icons">
                    <i class="link-icon" data-feather="smile"></i>
                    <span class="link-title">Student</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="icons">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="studentdata.php" class="nav-link">Student Data</a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="#" class="nav-link">Flag Icons</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Mdi Icons</a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Batch</li>
            <!---<li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>---->
            <li class="nav-item">
                <a href="batch.php" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Batch</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="charts">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title">Payment</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="enrolcourse.php" class="nav-link">Enrol course</a>
                        </li>

                        <li class="nav-item">
                            <a href="viwepayment.php" class="nav-link">Payment</a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">Flot</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/morrisjs.html" class="nav-link">Morris</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/peity.html" class="nav-link">Peity</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/sparkline.html" class="nav-link">Sparkline</a>
                        </li>--->
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Pages</li>
            <li class="nav-item">
                <a href="setting.php" class="nav-link">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Setting</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="unlock.php" class="nav-link">
                    <i class="link-icon" data-feather="unlock"></i>
                    <span class="link-title">Authentication</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#errorPages" role="button" aria-expanded="false" aria-controls="errorPages">
                    <i class="link-icon" data-feather="cloud-off"></i>
                    <span class="link-title">Error</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="errorPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">404</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">500</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">Sidebar:</h6>
        <div class="form-group border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item active" href="demo_1/dashboard-one.html">
                <img src="assets/images/screenshots/light.jpg" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item" href="demo_2/dashboard-one.html">
                <img src="assets/images/screenshots/dark.jpg" alt="light theme">
            </a>
        </div>
    </div>
</nav>
<!-- partial -->