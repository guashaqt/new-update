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
    <link href="<?= base_url();?>adminmart/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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
            <?php if ($child_data): ?>
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h3 style="color: black;">Child Section</h3>
                    <hr style="border-top: 1px solid black; border-bottom:1px">
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Registered Children</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm" id="zero_config">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No.</th>
                                            <th>Fullname</th>
                                            <th>Sex</th>
                                            <th>Birthday</th>
                                            <th>Birthplace</th>
                                            <th>Child Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-primary">
                                        <?php $counter = 1; ?>
                                        <?php foreach ($child_data as $child): ?>
                                        <tr>
                                            <td><?= $counter ?></td>
                                            <td><?= $child['child_fn'] ?> <?= $child['child_mn'] ?> <?= $child['child_ln'] ?></td>
                                            <td><?= $child['child_sex'] ?></td>
                                            <td><?= $child['child_bday'] ?></td>
                                            <td><?= $child['child_bplace'] ?></td>

                                            <td>
                                                <span class="badge <?= $child['child_status'] === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                                    <?= $child['child_status'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <!-- Pass the child ID to the populateModal function -->
                                                    <button type="button" class="btn btn-primary btn-sm edit-child-btn" data-toggle="modal" data-target="#edit_child_modal" data-child="<?=  $child['child_id'] ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm view-child-btn" data-child="<?= $child['child_id'] ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-child-btn" data-child="<?= $child['child_id'] ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
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
            </div>
            <?php else: ?>
            <p>No registered users. <a href="<?= base_url();?>index.php/register_child"><button class="btn btn-primary">Register New Parent</button></a></p>
            <?php endif; ?>
        </div>


<!-- Modal -->
<div class="modal fade" id="add_parentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Register New Parent</h4>
                        </div>
                        <div class="modal-body">
                            <?php echo validation_errors(); ?>
                            <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>
                            <form action="<?= base_url();?>index.php/register" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="middlename">Middle Name</label>
                                        <input type="text" class="form-control" id="middlename" name="middlename">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="sex">Sex</label>
                                        <select id="sex" name="sex" class="form-control" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="contact">Contact Number</label>
                                        <input type="tel" class="form-control" id="contact" name="contact" required>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="civil_status">Civil Status</label>
                                        <select id="civil_status" name="civil_status" class="form-control" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="bday">Birthday</label>
                                        <input type="date" class="form-control" id="bday" name="bday" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="birthplace">Birth Place</label>
                                        <input type="text" class="form-control" id="birthplace" name="birthplace" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="parent_guardian">Parent or Guardian</label>
                                        <select id="parent_guardian" name="parent_guardian" class="form-control" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="Parent">Parent</option>
                                            <option value="Guardian">Guardian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="purok">Purok</label>
                                        <select id="purok" name="purok" class="form-control" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="barangay">Barangay</label>
                                        <input type="text" class="form-control" id="barangay" name="barangay" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="municipality">Municipality</label>
                                        <input type="text" class="form-control" id="municipality" name="municipality" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="province">Province</label>
                                        <input type="text" class="form-control" id="province" name="province" required>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="user_status">User Status</label>
                                        <select id="user_status" name="user_status" class="form-control" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="ACTIVE">Active</option>
                                            <option value="NOT ACTIVE">Not Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Edit Child Modal -->
        <div class="modal fade" id="edit_child_modal" tabindex="-1" role="dialog" aria-labelledby="editChildModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editChildModalLabel">Edit Child Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing child details will go here -->
                        <form id="edit_child_form" action="<?= base_url();?>index.php/registered_children" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="child_fn">First Name</label>
                                    <input type="text" class="form-control" id="child_fn" name="child_fn" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="child_mn">Middle Name</label>
                                    <input type="text" class="form-control" id="child_mn" name="child_mn" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="child_ln">Last Name</label>
                                    <input type="text" class="form-control" id="child_ln" name="child_ln" required>
                                </div>
                                    <div class="form-group col-md-4">
                                        <label for="child_sex">Sex</label>
                                        <input type="text" class="form-control" id="child_sex" name="child_sex" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="child_bday">Birthday</label>
                                        <input type="date" class="form-control" id="child_bday" name="child_bday" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="child_bplace">Birth Place</label>
                                        <input type="text" class="form-control" id="child_bplace" name="child_bplace" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="child_status">Child Status</label>
                                        <select id="child_status" name="child_status" class="form-control" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="ACTIVE">Active</option>
                                            <option value="NOT ACTIVE">Not Active</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="child_mother">Mother's Name</label>
                                        <input type="text" class="form-control" id="child_mother" name="child_mother" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="child_father">Father's Name</label>
                                        <input type="text" class="form-control" id="child_father" name="child_father" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="user_id">ID</label>
                                        <input type="text" class="form-control" id="user_id" name="user_id" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            script src="<?= base_url();?>adminmart/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url();?>adminmart/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url();?>adminmart/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="<?= base_url();?>adminmart/dist/js/app-style-switcher.js"></script>
    <script src="<?= base_url();?>adminmart/dist/js/feather.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url();?>adminmart/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= base_url();?>adminmart/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->
    <script src="<?= base_url();?>adminmart/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url();?>adminmart/dist/js/custom.min.js"></script>
    <!--This page plugins -->
    <script src="<?= base_url();?>adminmart/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url();?>adminmart/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Delete user button click event
            document.querySelectorAll('.delete-user-btn').forEach(button => {
                button.addEventListener('click', function() {
                    var userId = this.dataset.user;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to delete user URL
                            window.location = '<?= base_url('index.php/delete_user/') ?>' + userId;
                        }
                    });
                });
            });
            // Edit Child Button Click Event
            $('.edit-child-btn').on('click', function() {
                var childId = $(this).data('child');

                // Fetch child details from the server
                $.ajax({
                    url: '<?= base_url('index.php/Admin_Controller/get_child_details/') ?>' + childId,
                    type: 'GET',
                    success: function(data) {
                        // Populate the modal fields with the fetched data
                        $('#child_fn').val(data.child_fn);
                        $('#child_mn').val(data.child_mn);
                        $('#child_ln').val(data.child_ln);
                        $('#child_sex').val(data.child_sex);
                        $('#child_bday').val(data.child_bday);
                        $('#child_bplace').val(data.child_bplace);
                        $('#child_status').val(data.child_status);
                        $('#child_mother').val(data.child_mother);
                        $('#child_father').val(data.child_father);
                        $('#user_id').val(data.user_id);
                        // Populate other fields as needed

                        // Show the modal
                        $('#edit_child_modal').modal('show');
                    },
                    error: function() {
                        alert('Error fetching child details.');
                    }
                });
            });
        });
    </script>

</body>

</html>