<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url();?>assets/ImmuTrack_logo.png">
    <title>ImmuTrack - ADMIN</title>
    <!-- Custom CSS -->
    <link href="<?= base_url();?>adminmart/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="page-wrapper">
    <div class="container-fluid">
    <div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 style="color: black;">Parent Management</h3> <hr style="border-top: 1px solid black; border-bottom:1px">
            </div>
           
            <div class="col-12"> <!-- Adjust the size of the left card -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title" style="display: inline;">Personal Details</h5>
            <div class="text-end" style="display: inline; float: right;">
            <a href="#" data-bs-toggle="modal" data-bs-target="#updateUserModal">
                <button class="btn btn-primary"><i class="fas fa-edit"></i> Edit Information</button>
            </a>

            </div>
        </div>

        <div class="card-body">
    <form>
        <div class="row">
            <div class="col-md-3">
                <div class="text-center mb-3">
                    <img src="<?= base_url();?>assets/user/profile_pic.png" alt="Profile Picture" style="border: 2px solid blue; border-radius: 50%; width: 150px; height: 150px;">
                </div>
                <div class="text-center mb-3">
                    <?= $user->firstname ?> <?= $user->middlename ?> <?= $user->lastname ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="inputContact" class="form-label">Contact #:</label>
                    <input type="text" class="form-control" id="inputContact" value="<?= $user->contact ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="inputSex" class="form-label">Sex:</label>
                    <input type="text" class="form-control" id="inputSex" value="<?= $user->sex ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="inputAddress" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="inputAddress" value="Purok <?= $user->purok ?>, Barangay <?= $user->barangay ?>, <?= $user->municipality ?>, <?= $user->province ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="inputBirthday" class="form-label">Birthday:</label>
                    <input type="text" class="form-control" id="inputBirthday" value="<?= $user->bday ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="inputBirthplace" class="form-label">Birthplace:</label>
                    <input type="text" class="form-control" id="inputBirthplace" value="<?= $user->birthplace ?>" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="inputParentGuardian" class="form-label">Parent/Guardian:</label>
                    <input type="text" class="form-control" id="inputParentGuardian" value="<?= $user->parent_guardian ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="inputCivilStatus" class="form-label">Civil Status:</label>
                    <input type="text" class="form-control" id="inputCivilStatus" value="<?= $user->civil_status ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="inputStatus" class="form-label">Status:</label>
                    <input type="text" class="form-control" id="inputStatus" value="<?= $user->user_status ?>" readonly>
                </div>
            </div>
            
        </div>
    </form>
</div>



<!-- Update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url();?>index.php/view_user/<?= $user->user_id ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputFirstName" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="inputFirstName" name="firstname" value="<?= $user->firstname ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="inputMiddleName" class="form-label">Middle Name:</label>
                            <input type="text" class="form-control" id="inputMiddleName" name="middlename" value="<?= $user->middlename ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="inputLastName" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="inputLastName" name="lastname" value="<?= $user->lastname ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="inputContact" class="form-label">Contact #:</label>
                            <input type="text" class="form-control" id="inputContact" name="contact" value="<?= $user->contact ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="inputSex" class="form-label">Sex:</label>
                            <select class="form-select" id="inputSex" name="sex">
                                <option value="Male" <?= ($user->sex == 'Male') ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= ($user->sex == 'Female') ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                                <label for="inputPurok" class="form-label">Purok:</label>
                                <input type="text" class="form-control" id="inputPurok" name="purok" value="<?= $user->purok ?>">
                            </div>
                            <div class="row mt-3">
                            <div class="col-mb-3">
                                <label for="inputBarangay" class="form-label">Barangay:</label>
                                <input type="text" class="form-control" id="inputBarangay" name="barangay" value="<?= $user->barangay ?>">
                            </div>
                            <div class="col-mb-3">
                                <label for="inputMunicipality" class="form-label">Municipality:</label>
                                <input type="text" class="form-control" id="inputMunicipality" name="municipality" value="<?= $user->municipality ?>">
                            </div>
                            <div class="col-mb-3">
                                <label for="inputProvince" class="form-label">Province:</label>
                                <input type="text" class="form-control" id="inputProvince" name="province" value="<?= $user->province ?>">
                            </div>
                            <div class="col-mb-3">
                                <label for="inputBirthday" class="form-label">Birthday:</label>
                                <input type="text" class="form-control" id="inputBirthday" name="bday" value="<?= $user->bday ?>">
                            </div>
                            <div class="col-mb-3">
                                <label for="inputBirthplace" class="form-label">Birthplace:</label>
                                <input type="text" class="form-control" id="inputBirthplace" name="birthplace" value="<?= $user->birthplace ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="inputParentGuardian" class="form-label">Parent/Guardian:</label>
                                <input type="text" class="form-control" id="inputParentGuardian" name="parent_guardian" value="<?= $user->parent_guardian ?>">
                            </div>
                            <div class="mb-3">
                                <label for="inputCivilStatus" class="form-label">Civil Status:</label>
                                <input type="text" class="form-control" id="inputCivilStatus" name="civil_status" value="<?= $user->civil_status ?>">
                            </div>
                            <div class="mb-3">
                                <label for="inputStatus" class="form-label">Status:</label>
                                <input type="text" class="form-control" id="inputStatus" name="user_status" value="<?= $user->user_status ?>">
                            </div>
                        </div>
                        
                        </div>
                        
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- CHILDREN TABLE -->
<div class="col-12"> <!-- Adjust the size of the right card -->
                <div class="card">
                <div class="card-header">
                    <h5 class="card-title" style="display: inline;">Children</h5>
                    <div class="text-end" style="display: inline; float: right;">
                        <a>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_childModal">
                                <i class="fas fa-child"></i> Add Child
                            </button>
                        </a>
                    </div>
                </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead style="color: black;bold">
                                <tr>
                                    <th><strong>No.</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Sex</strong></th>
                                    <th><strong>Birthday</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($child as $child_data): ?>
                                <tr>
                                    <td><?= $counter ?></td>
                                    <td style="color:black"><?= $child_data['child_fn'] ?> <?= $child_data['child_mn'] ?> <?= $child_data['child_ln'] ?></td>
                                    <td style="color:black"> <?= $child_data['child_sex'] ?></td>
                                    <td style="color:black"><?= $child_data['child_bday'] ?></td>
                                    <td>
                                            <span class="badge <?= $child_data['child_status'] === 'active' ? 'badge-primary' : 'badge-danger' ?>">
                                                    <?= $child_data['child_status'] ?>
                                            </span>
                                        </td>
                                        <td style="color:black">
                                        <a href="#childSection<?= $child_data['child_id'] ?>" class="btn btn-success">
                                            <span class="material-symbols-outlined"></span> View
                                        </a>
                                    </td>
                                </tr>
                                <?php $counter++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
    <!-- Child Details Section -->
    <section id="childSection">
    <div class="col-12">
        <div class="row mt-6" style="center">
            <?php foreach ($child as $child_data): ?>
                <div id="childSection<?= $child_data['child_id'] ?>" class="col-lg-6 col-xl-6 col-xxl-6 col-md-6" style="display: none;">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-center" style="color:blue"><?= $child_data['child_fn'] ?> <?= $child_data['child_mn'] ?> <?= $child_data['child_ln'] ?></h5>
                            <button type="button" class=" btn btn-danger btn-close"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <div class="col-sm-4" style="color: black">
                                    <strong>Full Name:</strong>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <input type="text" class="form-control" value="<?= $child_data['child_fn'] ?> <?= $child_data['child_mn'] ?> <?= $child_data['child_ln'] ?>" readonly>
                                </div>

                                <div class="col-sm-4" style="color: black">
                                    <strong>Birthday:</strong>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <input type="text" class="form-control" value="<?= $child_data['child_bday'] ?>" readonly>
                                </div>

                                <div class="col-sm-4" style="color: black">
                                    <strong>Sex:</strong>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <input type="text" class="form-control" value="<?= $child_data['child_sex'] ?>" readonly>
                                </div>

                                <div class="col-sm-4" style="color: black">
                                    <strong>Birthplace:</strong>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <input type="text" class="form-control" value="<?= $child_data['child_bplace'] ?>" readonly>
                                </div>

                                <div class="col-sm-4" style="color: black">
                                    <strong>Child's Father:</strong>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <input type="text" class="form-control" value="<?= $child_data['child_father'] ?>" readonly>
                                </div>

                                <div class="col-sm-4" style="color: black">
                                    <strong>Status:</strong>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <input type="text" class="form-control " value="<?= $child_data['child_status'] ?>" readonly>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-info mt-3 btn-add-immunization" data-bs-toggle="modal" data-bs-target="#add_immunizationModal" data-child-id="<?= $child_data['child_id'] ?>">Add Immunization</button>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Add Child Modal -->

<div class="modal fade" id="add_childModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Child</h4>
              
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="<?= base_url();?>index.php/register_child" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="user_id" name="user_id" value="<?= $user->user_id?>">
                        <p class="card-description">Child's Personal Information</p>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="child_fn">First Name</label>
                                <input type="text" class="form-control" id="child_fn" name="child_fn" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="child_mn">Middle Name</label>
                                <input type="text" class="form-control" id="child_mn" name="child_mn">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="child_ln">Last Name</label>
                                <input type="text" class="form-control" id="child_ln" name="child_ln" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="child_sex">Sex</label>
                                <select id="child_sex" name="child_sex" class="form-control" required>
                                    <option selected disabled>Choose...</option>
                                    <option value="female">Female</option>
                                    <option value="male">Male</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="child_bday">Birthday</label>
                                <input type="date" class="form-control" id="child_bday" name="child_bday" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="child_bplace">Birth Place</label>
                                <input type="text" class="form-control" id="child_bplace" name="child_bplace" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="child_mother">Child's Mother</label>
                                <input type="text" class="form-control" id="child_mother" name="child_mother" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="child_father">Child's Father</label>
                                <input type="text" class="form-control" id="child_father" name="child_father" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="child_status">Child Status</label>
                                <select id="child_status" name="child_status" class="form-control" required>
                                    <option selected disabled>Choose...</option>
                                    <option value="ACTIVE">Active</option>
                                    <option value="NOT ACTIVE">Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 

<!-- Add Immunization Modal -->

<div class="modal fade" id="add_immunizationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Immunization</h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url();?>index.php/add_immunization" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="child_id" name="child_id" value="<?= $child_data['child_id'] ?>">
                    <div class="card-body">
                        <p class="card-description">Immunization Form</p>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="vaccine_id">Vaccine:</label>
                                <select class="form-control" id="vaccine_id" name="vaccine_id" required>
                                    <option value="" disabled selected>Select Vaccine</option>
                                    <?php foreach ($vaccines as $vaccine): ?>
                                        <option value="<?= $vaccine['vaccine_id'] ?>"><?= $vaccine['vaccine_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="personnel_id">Personnel:</label>
                                <select class="form-control" id="personnel_id" name="personnel_id" required>
                                    <option value="" disabled selected>Select Personnel</option> <?php foreach ($personnel as $person): ?>
            <option value="<?= $person['personnel_id'] ?>">
                <?= $person['firstname'] ?> <?= $person['middlename'] ?> <?= $person['lastname'] ?>
            </option>
        <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option selected disabled>Select Status</option>
                                    <option value="PENDING">Active</option>
                                    <option value="COMPLETED">Not Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var closeButtons = document.querySelectorAll('.btn-close');
        
        closeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var parentCard = this.closest('.card');
                parentCard.style.display = 'none';
            });
        });
    });
</script>




<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
        var childLinks = document.querySelectorAll('.btn-success');
        var childSections = document.querySelectorAll('.card[id^="childSection"]');
        
        childLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                var targetId = this.getAttribute('href');
                var targetElement = document.querySelector(targetId);
                
                // Hide all child sections
                childSections.forEach(function (section) {
                    section.style.display = 'none';
                });
                
                // Display the clicked child section
                targetElement.style.display = 'block';
                
                // Scroll to the target element
                targetElement.scrollIntoView({ behavior: 'smooth' });
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<script>
    // Get the user_id value from wherever you have it (e.g., from a variable passed to your view)
    var userId = <?= $user_id ?>; // Make sure $user_id is properly set in your controller before loading this view

    // Set the user_id value to the hidden input field
    document.getElementById("user_id").value = userId;

    $(document).on('click', '.btn-add-immunization', function() {
    var childId = $(this).data('child-id');
    $('#child_id').val(childId);
});


</script>
