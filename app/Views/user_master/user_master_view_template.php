<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-customer-table-filter="search"
                            class="form-control form-control-solid w-250px ps-13" placeholder="Search User" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-customer-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                        </div>
                        <button type="button" class="btn btn-danger"
                            data-kt-customer-table-select="delete_selected">Delete
                            Selected</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                    <thead>
                        <tr class="text-start text-gray-900 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-50px">Sl. No</th>
                            <th class="min-w-125px">User Name</th>
                            <th class="min-w-125px">Designation</th>
                            <th class="min-w-125px">Contact Number</th>
                            <th class="min-w-125px">Gender</th>
                            <th class="min-w-125px">Project Name</th>
                            <th class="min-w-70px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-900">
                        <?php
                        if (!empty($user_data)) {
                            // print_r($user_data);
                            // die;
                            foreach ($user_data as $key => $record) {
                                if ($key === 0) {
                                    continue;
                                }
                                ?>
                                <tr>
                                    <td class="text-text-gray-900"><?= $key + 0 ?></td>
                                    <td>
                                        <div class="d-flex flex-stack py-4">
                                            <div class="d-flex align-items-center">

                                                <div class="ms-4">
                                                    <label class="fs-6 fw-bold text-gray-900 mb-2"><?= $record['E_NAME'] ?>
                                                        <span
                                                            class="text-white badge badge-danger fs-7"><?= $record['ACTIVE_STATUS'] ?></span></label>
                                                    <div class="fw-semibold fs-7">
                                                        <?= $record['EMAIL_ADDRESS'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-light fw-bold"><?= $record['DESIGNATION_NAME'] ?></div>
                                    </td>
                                    <td><i class="bi bi-telephone-fill text-info"></i>&nbsp; <?= $record['CONTACT_NUMBER'] ?>
                                    </td>
                                    <td>
                                        <div class="badge badge-light-danger"><?= $record['GENDER'] ?></div>
                                    </td>
                                    <td>
                                        <!--<span class="text-white badge badge-warning fs-7">P1</span>
                                                        <span class="text-white badge badge-warning fs-7">P2</span>
                                                        <span class="text-white badge badge-warning fs-7">P4</span>-->
                                        <span class="text-white badge badge-warning fs-7"><?= $record['PROJECT_NAME'] ?></span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">

                                            <div class="menu-item px-3">
                                                <a onclick="editMode('<?= $record['USER_CODE'] ?>')" class="menu-link px-3"><i
                                                        class="bi bi-pencil-square"></i>&nbsp; Edit</a>
                                            </div>
                                            <?php
                                            if ($record['ACTIVE_STATUS'] == 'ACTIVE') {
                                                ?>
                                                <div class="menu-item px-3">
                                                    <a onclick="update_status('<?= $record['USER_CODE'] ?>')"
                                                        class="menu-link px-3"><i class="bi bi-check-all"></i>&nbsp; Inactive</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="menu-item px-3">
                                                    <a onclick="update_status('<?= $record['USER_CODE'] ?>')"
                                                        class="menu-link px-3"><i class="bi bi-check-all"></i>&nbsp; Active</a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function editMode(id) {
        document.getElementById('custom_id').value = id;
        document.getElementById('mode').value = 'edit_user_data';
        document.getElementById('custom_form').action = "<?= base_url('user-master') ?>";
        document.getElementById('custom_form').submit();
    }
    function update_status(id) {
        if (confirm('Are you sure you want to chenge the status?')) {
            document.getElementById('custom_id').value = id;
            document.getElementById('custom_form').action = "<?= base_url('customer-master-update-status') ?>";
            document.getElementById('custom_form').submit();
        }
    }
    <?php if (session()->getFlashdata('msg')) {
        $msg = session()->getFlashdata('msg');
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
</script>