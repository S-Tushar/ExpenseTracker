<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to WelTec</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body pt-5">
                            <div class="row d-flex justify-content-center ">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h4 class="border-secondary border-bottom text-uppercase mb-2">Batch</h4>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <?php
                                    $sql = "SELECT COUNT(batch_id) AS batch FROM batch";
                                    $run = mysqli_query($conn, $sql);
                                    $fetch = mysqli_fetch_assoc($run);
                                    ?>
                                    <input type="hidden" id="counterbatch" value='<?php echo $fetch['batch']; ?>'>
                                    <h2 id="counterbatch12" class="display-2 mb-2 font-weight-bold"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body pt-5">
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-6">
                                    <h4 class="border-secondary border-bottom text-uppercase mb-2">Faculty</h4>
                                </div>
                                <div class="col-6 col-md-12 col-xl-6">
                                    <?php
                                    $sql = "SELECT COUNT(faculty_id) AS faculty  FROM faculty";
                                    $run = mysqli_query($conn, $sql);
                                    $fetch = mysqli_fetch_assoc($run);
                                    ?>
                                    <input type="hidden" id="counterfaculty" value="<?php echo $fetch['faculty'] ?>">
                                    <h2 id="counterfaculty123" class="display-2 mb-2 font-weight-bold"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body pt-5">
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-6">
                                    <h4 class="border-secondary border-bottom text-uppercase mb-2">Student</h4>
                                </div>
                                <div class="col-6 col-md-12 col-xl-6">
                                    <?php
                                    $sql = "SELECT COUNT(student_id) AS student FROM student";
                                    $run = mysqli_query($conn, $sql);
                                    $fetch = mysqli_fetch_assoc($run);
                                    ?>
                                    <input type="hidden" id="counterstudent" value="<?php echo $fetch['student']; ?>">
                                    <h2 id="counterstudent123" class="display-2 mb-2 font-weight-bold"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body pt-5">
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-6">
                                    <h4 class="border-secondary border-bottom text-uppercase mb-2">Course</h4>
                                </div>
                                <div class="col-6 col-md-12 col-xl-6">
                                    <?php
                                    $sql = "SELECT COUNT(id) AS course FROM course";
                                    $run = mysqli_query($conn, $sql);
                                    $fetch = mysqli_fetch_assoc($run);
                                    ?>
                                    <input type="hidden" id="countercourse" value="<?php echo $fetch['course']; ?>">
                                    <h2 id="countercourse123" class="display-2 mb-2 font-weight-bold"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-4 ">
                        <h6 class="border-secondary border-bottom text-uppercase mb-0">Student</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0">Student Name</th>
                                    <th class="pt-0">Interested Course</th>
                                    <th class="pt-0">Start Date</th>
                                    <th class="pt-0">Contact</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "SELECT * FROM student 
                                            ORDER BY student_id DESC LIMIT 6";
                                $run = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($run) > 0) {
                                    while ($fres = mysqli_fetch_assoc($run)) {
                                ?>
                                        <tr>
                                            <td><?php echo $fres['fullname']; ?></td>
                                            <td><?php echo $fres['icourse']; ?></td>
                                            <td><?php echo $fres['startc']; ?></td>
                                            <td><?php echo $fres['contactno']; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="border-secondary border-bottom text-uppercase mb-0">Faculty</h6>
                    </div>
                    <div class="d-flex flex-column">
                        <?php
                        $sql = "SELECT faculty.*,batch.batchname FROM faculty
                                    LEFT JOIN batch ON batch.faculty_id=faculty.faculty_id 
                                    GROUP BY `faculty_id` LIMIT 6";
                        $run = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($run) > 0) {
                            while ($tres = mysqli_fetch_assoc($run)) {
                        ?>
                                <a href="#" class="d-flex align-items-center border-bottom py-3">
                                    <div class="mr-3">
                                        <img src="assets/sanjayimg/<?php echo $tres['facultyimg']; ?>" class="rounded-circle wd-35" alt="user">
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body mb-2"><?php echo $tres['fname'] . ' ' . $tres['lname']; ?> </h6>
                                            <p class="text-muted tx-13"><?php echo $tres['batchname']; ?></p>
                                        </div>
                                        <p class="text-muted tx-12"><?php echo $tres['fclty_email']; ?></p>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    <div class="row">

    </div> <!-- row -->

    <div class="row">
    </div> <!-- row -->

</div>

<script>
    var counterbatch = document.getElementById('counterbatch').value;
    var counterfaculty = document.getElementById('counterfaculty').value;
    var counterstudent = document.getElementById('counterstudent').value;
    var countercourse = document.getElementById('countercourse').value;

    var mynumb = 0;
    setInterval(() => {
        if (mynumb < counterbatch) {
            mynumb++
        }
        document.getElementById('counterbatch12').innerHTML = mynumb.toString().padStart(2, '0');
    }, 100);

    var mynumc = 0;
    setInterval(() => {
        if (mynumc < counterfaculty) {
            mynumc++
        }
        document.getElementById('counterfaculty123').innerHTML = mynumc.toString().padStart(2, '0');
    }, 100);

    var mynumd = 0;
    setInterval(() => {
        if (mynumd < counterstudent) {
            mynumd++
        }
        document.getElementById('counterstudent123').innerHTML = mynumd.toString().padStart(2, '0');
    }, 100);

    var mynume = 0;
    setInterval(() => {
        if (mynume < countercourse) {
            mynume++
        }
        document.getElementById('countercourse123').innerHTML = mynume.toString().padStart(2, '0');
    }, 100);
</script>