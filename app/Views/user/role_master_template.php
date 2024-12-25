<form action="<?= base_url('save-role-master') ?>" method="post" id="role_master_form_id">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="col-xl-12">
                <div class="card card-flush py-4">
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-md-7">
                            <div class="d-flex flex-column flex-md-row">
                                <div class="col-xl-3">
                                    <label class="form-label required">Role Name</label>
                                    <input type="text" class="form-control" id="role_name" name="role_name"
                                        placeholder="Enter Role Name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="col-xl-6">
                <div class="card card-flush">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Menu Wise Page Details</h3>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-md-7">
                            <div class="d-flex flex-column flex-md-row">
                                <div class="col-xl-12">
                                    <?php
                                    if (!empty($page_menu)) {
                                        foreach ($page_menu as $menu) { ?>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <label class="accordion-button" aria-expanded="true">
                                                            <div class="form-check">
                                                                <input class="form-check-input parent-checkbox" type="checkbox"
                                                                    id="flexCheckChecked_menu_<?= $menu['MENU_ID']; ?>"
                                                                    value="<?= $menu['MENU_ID']; ?>">
                                                                <label class="fs-6 mt-1"><?= $menu['MENU_NAME']; ?></label>
                                                            </div>
                                                        </label>
                                                    </h2>
                                                    <?php foreach ($page_name as $name) {
                                                        if ($menu['MENU_ID'] == $name['MENU_ID']) {
                                                            ?>
                                                            <div id="collapseOne" class="accordion-collapse collapse show">
                                                                <div class="accordion-body">
                                                                    <div class="form-check mb-2">
                                                                        <input class="form-check-input child-checkbox chkbox"
                                                                            type="checkbox"
                                                                            id="flexCheckChecked_page_<?= $name['PAGE_ID']; ?>"
                                                                            name="page_name[]" value="<?= $name['PAGE_ID']; ?>">
                                                                        <label
                                                                            for="flexCheckChecked"><?= $name['PAGE_APP_NAME']; ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                    } ?>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-flush">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Special Privileges</h3>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-md-7">
                            <div class="d-flex flex-column flex-md-row">
                                <div class="col-xl-12">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-gray-900 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-50px">Sl. No</th>
                                                <th class="min-w-125px">Privilege Name</th>
                                                <th class="min-w-125px">Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if (!empty($permission)) {
                                            foreach ($permission as $key => $page_permission) { ?>
                                                <tbody class="fw-semibold text-gray-900">
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= $page_permission['RECORD_NAME']; ?></td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input privilegecheck"
                                                                    name="privilege[]" type="checkbox" id="flexCheckChecked"
                                                                    value="<?= $page_permission['RECORD_ID']; ?>">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php }
                                        } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding: 0px;">
                        <div class="d-flex flex-wrap pb-4" style="justify-content: end;">
                            <button type="submit" class="btn btn-primary btn-sm me-4"><i class="bi bi-floppy2"></i>
                                Save Role</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('.parent-checkbox').on('change', function () {
            const isChecked = $(this).prop('checked');
            const parentId = $(this).val();
            $(`#flexCheckChecked_menu_${parentId}`).closest('.accordion-item').find('.child-checkbox').prop('checked', isChecked);
        });
        $('.child-checkbox').on('change', function () {
            const parentAccordionItem = $(this).closest('.accordion-item');
            const parentCheckbox = parentAccordionItem.find('.parent-checkbox');
            const childCheckboxes = parentAccordionItem.find('.child-checkbox');

            const allChecked = childCheckboxes.length === childCheckboxes.filter(':checked').length;
            const noneChecked = childCheckboxes.filter(':checked').length === 0;

            parentCheckbox.prop('checked', allChecked);
            parentCheckbox.prop('indeterminate', !allChecked && !noneChecked);
        });
        $('#role_master_form_id').submit(function () {
            var rolecheck = $('.chkbox:checked').length;
            var privilegecheck = $('.privilegecheck:checked').length;
            var rolename = $('#role_name').val();

            if (rolename === '') {
                alert('Please enter the role name.');
                // $.toast({
                //     heading: "Warning",
                //     text: "Please enter the role name.",
                //     showHideTransition: "fade",
                //     position: "top-right",
                //     icon: "error",
                //     loader: true,
                //     timeout: 3000
                // });
                return false;
            } else if (rolecheck === 0 || privilegecheck === 0) {
                alert('Please select at least one role and privilege checkbox.');
                // $.toast({
                //     heading: "Warning",
                //     text: "Please select at least one role and privilege checkbox.",
                //     showHideTransition: "fade",
                //     position: "top-right",
                //     icon: "error",
                //     loader: true,
                //     timeout: 3000
                // });
                return false;
            } else {
                return true;
            }
        });
    });
    <?php if (session()->getFlashdata('msg')) {
        $msg = session()->getFlashdata('msg');
        if ($msg["status"] == 1) {
            ?>
            // $.toast({
            //     heading: "Success",
            //     text: "<?= $msg['message'] ?>",
            //     showHideTransition: "fade",
            //     position: "top-right",
            //     icon: "success",
            //     loader: true,
            //     hideAfter: 3000
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
        <?php } ?>
    <?php } ?>
</script>