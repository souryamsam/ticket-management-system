<?php
// if (!empty($user_single_data)) {
//     // print_r($user_single_data);
//     // die;
//     $user_id = $user_single_data['USER_CODE'];
//     $username = $user_single_data['E_NAME'];
//     $designation_val = $user_single_data['DESIGNATION'];
//     $email = $user_single_data['EMAIL_ADDRESS'];
//     $contact = $user_single_data['CONTACT_NUMBER'];
//     $gender = $user_single_data['GENDER'];
//     $selected_roles = $user_single_data['E_NAME'];
//     $selected_projects = $user_single_data['E_NAME'];
// } else {
$user_id = '';
$username = old('user_name');
$designation_val = old('designation_val');
$email = old('email_address');
$contact = old('contact_number');
$gender = old('choose_gender');
$selected_roles = old('choose_role', $previously_selected_roles ?? []);
$selected_projects = old('project', $previously_selected_projects ?? []);
// }
?>


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="col-xl-12">
                <form action="<?= base_url('save-usermaster-data'); ?>" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <div class="card card-flush py-4" data-select2-id="select2-data-129-htns">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Fill User Details</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0" data-select2-id="select2-data-128-947s">
                            <div class="d-flex flex-column gap-5 gap-md-7" data-select2-id="select2-data-127-3t0c">
                                <div class="d-flex flex-column flex-md-row gap-5">
                                    <div class="col-xl-4 flex-row-fluid">
                                        <label class="form-label required">User Name</label>
                                        <input type="text" name="user_name" id="user_name" class="form-control"
                                            placeholder="Enter User Name" value="<?= $username ?>">
                                        <div class="text-danger">
                                            <?= session()->get('errors')['user_name'] ?? '' ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 flex-row-fluid">
                                        <label class="form-label required">Designation</label>
                                        <select id="designation_val" class="form-select" name="designation_val">
                                            <option value="">Select</option>
                                            <?php foreach ($designation as $des) { ?>

                                                <option value="<?= $des['RECORD_ID'] ?>"
                                                    <?= $designation_val == $des['RECORD_ID'] ? 'selected' : '' ?>>
                                                    <?= $des['RECORD_NAME'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= session()->get('errors')['designation_val'] ?? '' ?>
                                        </div>
                                    </div>
                                    <div class="flex-row-fluid col-xl-4">
                                        <label class="form-label required">Choose Role</label>
                                        <select id="choose_role" class="form-select select2" name="choose_role[]"
                                            multiple>
                                            <option value="">Select</option>
                                            <!--<option value="Supply Chain">Supply Chain</option>
                                            <option value="Administrator">Administrator</option>-->
                                            <?php
                                            foreach ($role as $roles) {
                                                $is_selected = in_array($roles['UG_ID'], $selected_roles) ? 'selected' : '';
                                                ?>
                                                <option value="<?= $roles['UG_ID'] ?>" <?= $is_selected ?>>
                                                    <?= $roles['USER_GROUP_NAME'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div class="text-danger">
                                            <?= session()->get('errors')['choose_role'] ?? '' ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column flex-md-row gap-5">
                                    <div class="col-xl-4 flex-row-fluid">
                                        <label class="form-label required">Email Address</label>
                                        <input class="form-control" type="email" id="email_address" name="email_address"
                                            placeholder="Enter Email Address" value="<?= $email ?>">
                                        <div class="text-danger">
                                            <?= session()->get('errors')['email_address'] ?? '' ?>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 flex-row-fluid">
                                        <label class="required form-label">Contact Number</label>
                                        <input class="form-control number" type="text" name="contact_number"
                                            id="contact_number" maxlength="10" placeholder="Fill Contact Number"
                                            value="<?= $contact ?>">
                                        <div class="text-danger">
                                            <?= session()->get('errors')['contact_number'] ?? '' ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 flex-row-fluid">
                                        <label class="form-label required">Choose Gender</label>
                                        <select id="choose_gender" class="form-select" name="choose_gender">
                                            <option value="">Select</option>
                                            <option value="MALE" <?= $gender == 'MALE' ? 'selected' : '' ?>>Male</option>
                                            <option value="FEMALE" <?= $gender == 'FEMALE' ? 'selected' : '' ?>>Female
                                            </option>
                                            <option value="OTHERS" <?= $gender == 'OTHERS' ? 'selected' : '' ?>>Others
                                            </option>
                                        </select>
                                        <div class="text-danger">
                                            <?= session()->get('errors')['choose_gender'] ?? '' ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-5">
                                    <div class="col-xl-4">
                                        <label class="form-label required">Choose Project</label>
                                        <select id="project" class="form-select select2" name="project[]" multiple>
                                            <option value="">Select</option>
                                            <?php

                                            foreach ($project_data as $project) {
                                                $is_selected = in_array($project['PROJECT_ID'], $selected_projects) ? 'selected' : '';
                                                ?>

                                                <option value="<?= $project['PROJECT_ID'] ?>" <?= $is_selected ?>
                                                    <?= $is_selected ?>><?= $project['PROJECT_NAME'] ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="text-danger">
                                        <?= session()->get('errors')['project'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-wrap pb-lg-0" style="justify-content: end;">

                                <button type="submit" class="btn btn-primary btn-sm me-4">
                                    <i class="bi bi-floppy2"></i> Save Data
                                </button>


                                <a class="btn btn-light btn-sm" id="resetForm"><i
                                        class="fa-solid fa-recycle"></i>Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<script>

    <?php if (session()->getFlashdata('status_msg')) {
        $msg = session()->getFlashdata('status_msg');
        if ($msg['status'] == 1) { ?>
            // $.toast({
            // 	heading: "Success",
            // 	text: "<?= $msg['message'] ?>",
            // 	showHideTransition: "fade",
            // 	position: "top-right",
            // 	icon: "success",
            // 	loader: true,
            // 	hideAfter: 3000
            // });
            alert("<?= $msg['message'] ?>");
        <?php } else { ?>
            // $.toast({
            //     heading: "Warning",
            //     text: "<?= $msg['message'] ?>",
            //     showHideTransition: "fade",
            //     position: "top-right",
            //     icon: "error",
            //     loader: true,
            //     hideAfter: 3000
            // });
            alert("<?= $msg['message'] ?>");
        <?php }
    } ?>


    $(document).ready(function () {
        $('#resetForm').on('click', function (e) {
            e.preventDefault();


            $('#user_name').val('');
            $('#designation_val').val('');
            $('#email_address').val('');
            $('#contact_number').val('');
            $('#choose_gender').val('');
            $('#choose_role').val(null).trigger('change');
            $('#project').val(null).trigger('change');
            // $('.select2').val(null).trigger('change');
        });
    });
</script>