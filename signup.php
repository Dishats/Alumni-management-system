<?php 
include 'admin/db_connect.php'; 
?>
<style>
    .masthead {
        min-height: 23vh !important;
        height: 23vh !important;
    }
    .masthead:before {
        min-height: 23vh !important;
        height: 23vh !important;
    }
    img#cimg {
        max-height: 10vh;
        max-width: 6vw;
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Create Account</h3>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<div class="container mt-3 pt-2">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <form action="" id="create_account">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" class="form-control" name="middlename">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="control-label">Gender</label>
                                    <select class="custom-select" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Batch</label>
                                    <input type="text" class="form-control datepickerY" name="batch" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Course Graduated</label>
                                    <select class="custom-select select2" name="course_id" required>
                                        <option value="">Select Course</option>
                                        <?php 
                                        $course = $conn->query("SELECT * FROM courses ORDER BY course ASC");
                                        while($row=$course->fetch_assoc()): ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['course'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="control-label">Country Code</label>
                                    <select class="custom-select" name="country_code" required>
                                        <option value="+91">+91 (India)</option>
                                        <option value="+1">+1 (USA)</option>
                                        <!-- Add more country codes as needed -->
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" 
                                           required 
                                           pattern="^(?!0)[0-9]{10}$" 
                                           title="Phone number must be 10 digits long and cannot start with zero."
                                           placeholder="e.g. 9876543210">
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Employed</label>
                                    <select class="custom-select" name="employed" id="employed" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="control-label">Offering Mentorship</label>
                                    <select class="custom-select" name="mentorship" id="mentorship" required>
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mentorship-domain" style="display: none;">
                                    <label class="control-label">Domain of Mentorship</label>
                                    <select class="custom-select" name="mentorship_domain">
                                        <option value="">Select Domain</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Business">Business</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Healthcare">Healthcare</option>
                                        <option value="Education">Education</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="control-label">LinkedIn Profile Link</label>
                                    <input type="url" class="form-control" name="linkedin" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control" name="img" onchange="displayImg(this)">
                                    <img src="" alt="" id="cimg">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-4">
    <label class="control-label">Password</label>
    <div class="input-group">
        <input type="password" class="form-control" name="password" id="password" required>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
        </div>
    </div>
</div>

                            </div>
                            <div id="msg"></div>
                            <hr class="divider">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary">Create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.datepickerY').datepicker({
        format: " yyyy",
        viewMode: "years",
        minViewMode: "years",
        endDate: new Date().getFullYear().toString()
    });
    $('.select2').select2({
        placeholder: "Please Select Here",
        width: "100%"
    });

    $('#mentorship').change(function() {
        if ($(this).val() === 'Yes') {
            $('.mentorship-domain').show();
        } else {
            $('.mentorship-domain').hide();
        }
    });

    function displayImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = this;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = 'Show';
        }
    });

   

    $('#create_account').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=signup',
            type: 'POST',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function(resp) {
                if (resp.trim() === '1') { // Trim white space
                    location.href = 'index.php?page=home';
                } else if (resp.trim() === '2') {
                    $('#msg').html('<div class="alert alert-danger">Email already exists. Please use a different email.</div>');
                } else {
                    $('#msg').html('<div class="alert alert-danger">' + resp + '</div>');
                }
                end_load();
            },
            error: function(err) {
                $('#msg').html('<div class="alert alert-danger">An unexpected error occurred.</div>');
                end_load();
            }
        });
    });
</script>