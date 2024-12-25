<div id="kt_app_content_container" class="app-container container-xxl">
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <div class="col-xl-12">
            <form method="POST" id="save_customer_data" action="<?= base_url('save-customer-data') ?>">
                <input type="hidden" name="customer_master" value="customer_master_data">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Fill Customer Details</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-5 gap-md-7" data-select2-id="select2-data-127-3t0c">
                            <div class="d-flex flex-column flex-md-row gap-5" data-select2-id="select2-data-4-ofs7">
                                <div class="col-xl-3 flex-row-fluid">
                                    <label class="form-label required">Customer Name</label>
                                    <input type="text" name="c_name" class="form-control"
                                        placeholder="Enter Customer Name" value="<?= old('c_name'); ?>">
                                    <div class="text-danger">
                                        <?= session()->get('errors')['c_name'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="col-xl-3 flex-row-fluid">
                                    <label class="form-label required">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                        value="<?= old('address'); ?>">
                                    <div class="text-danger">
                                        <?= session()->get('errors')['address'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="flex-row-fluid col-xl-3">
                                    <label class="form-label required">State</label>
                                    <select class="form-select" name="state">
                                        <option value="">Select</option>
                                        <?php
                                        if (!empty($state_data)) {
                                            foreach ($state_data as $state_data_bind) {
                                                ?>
                                                <option value="<?= $state_data_bind['RECORD_ID'] ?>"
                                                    <?= $state_data_bind['RECORD_ID'] == old('state') ? 'selected' : '' ?>>
                                                    <?= $state_data_bind['RECORD_NAME'] ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="text-danger">
                                        <?= session()->get('errors')['state'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="flex-row-fluid col-xl-3" data-select2-id="select2-data-3-i0h1">
                                    <label class="form-label required">Project Mapping</label>
                                    <select class="form-select select2-hidden-accessible select2" multiple=""
                                        placeholder="Select Project" data-select2-id="select2-data-projectSelect"
                                        tabindex="-1" aria-hidden="true" id="projectSelect" name="project_mapping[]">
                                        <?php
                                        if (!empty($project_detail_data)) {
                                            $selected_projects = old('project_mapping', $previously_selected_projects ?? []);
                                            foreach ($project_detail_data as $project_detail) {
                                                $is_selected = in_array($project_detail['PROJECT_ID'], $selected_projects) ? 'selected' : '';
                                                ?>
                                                <option value="<?= $project_detail['PROJECT_ID'] ?>" <?= $is_selected ?>>
                                                    <?= $project_detail['PROJECT_NAME'] ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="text-danger">
                                        <?= session()->get('errors')['project_mapping'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-xl-6 col-xl-6 flex-row-fluid">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" style="width: 100%;"
                                    id="customer_info">
                                    <thead>
                                        <tr class="text-start text-gray-900 fw-bold fs-7 text-uppercase">
                                            <th class="min-w-150px">
                                                <span class="dt-column-title" role="button">Contact Person</span>
                                            </th>
                                            <th class="min-w-150px">
                                                <span class="dt-column-title" role="button">Number</span>
                                            </th>
                                            <th class="min-w-25px">
                                                <span class="dt-column-title" role="button"></span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" id="contact_person" name="contact_person"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Contact Person Name">
                                            </td>
                                            <td>
                                                <input type="text" name="contact_number" id="contact_number"
                                                    class="form-control form-control-sm number"
                                                    placeholder="Enter Number">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm add-row"
                                                    onclick="addRow()"><i class="fa fa-add"></i> Add</button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600" id="dynamic_table_body">
                                        <?php if (session()->has('customer_master_info')) {
                                            $user_info = session()->getFlashdata('customer_master_info');
                                            foreach ($user_info as $info) {
                                                ?>
                                                <tr>
                                                    <td><?= $info['contact_person_info']; ?></td>
                                                    <input type="hidden" name="contact_person[]"
                                                        value="<?= $info['contact_person_info'] ?>">
                                                    <td><?= $info['contact_number_info']; ?></td>
                                                    <input type="hidden" name="contact_number[]"
                                                        value="<?= $info['contact_number_info']; ?>">
                                                    <td><button type="button" onclick="deleteRow(this)"
                                                            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-wrap pb-lg-0" style="justify-content: end;">
                            <button type="submit" class="btn btn-primary btn-sm me-4"><i class="bi bi-floppy2"></i>
                                Save Data</button>
                            <button type="button" id="resetBtn" class="btn btn-light btn-sm"><i
                                    class="fa-solid fa-recycle"></i>
                                Reset</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#save_customer_data').submit(function () {
            var tr_length = $('#customer_info tbody tr').length;
            if (tr_length > 0) {
                return true;
            } else {
                // $.toast({
                //     heading: "Warning",
                //     text: 'You have not added any contact person and number.',
                //     showHideTransition: "fade",
                //     position: "top-right",
                //     icon: "error",
                //     loader: true,
                //     timeout: 3000
                // });
                alert('You have not added any contact person and number.');
                return false;
            }
        });
    });

    function addRow() {
        var contact_person = $("#contact_person").val();
        var contact_number = $("#contact_number").val();

        if (contact_person === "") {
            // $.toast({
            //     heading: "Warning",
            //     text: 'Contact Name field is required.',
            //     showHideTransition: "fade",
            //     position: "top-right",
            //     icon: "error",
            //     loader: true,
            //     timeout: 30000
            // });
            alert('Contact Name field is required.');
        } else if (contact_number === "") {
            // $.toast({
            //     heading: "Warning",
            //     text: 'Number field is required.',
            //     showHideTransition: "fade",
            //     position: "top-right",
            //     icon: "error",
            //     loader: true,
            //     timeout: 30000
            // });
            alert('Number field is required.');
        } else {
            var isDuplicate = false;
            $('#dynamic_table_body tr').each(function () {
                var existing_contact_number = $(this).find('input[name="contact_number[]"]').val();
                if (existing_contact_number === contact_number) {
                    isDuplicate = true;
                    return false;
                }
            });
            if (isDuplicate) {
                // $.toast({
                //     heading: "Warning",
                //     text: 'This value allready exit',
                //     showHideTransition: "fade",
                //     position: "top-right",
                //     icon: "error",
                //     loader: true,
                //     timeout: 40000
                // });
                alert('This value allready exit.');
                $("#contact_person").val('');
                $("#contact_number").val('');
            } else {
                var newrow = '<tr>' +
                    '<input type="hidden" name="contact_person[]" value="' + contact_person + '">' +
                    '<td>' + contact_person + '</td>' +
                    '<input type="hidden" name="contact_number[]" value="' + contact_number + '">' +
                    '<td>' + contact_number + '</td>' +
                    '<td><button type="button" onclick="deleteRow(this)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>' +
                    '</tr>';
                $('#dynamic_table_body').append(newrow);
                $("#contact_person").val('');
                $("#contact_number").val('');
            }
        }
    }

    function deleteRow(button) {
        if (confirm('Are you sure you want to delete the data?')) {
            $(button).closest('tr').remove();
        }
    }
    $("#resetBtn").click(function () {
        $('#save_customer_data')[0].reset();
        $('#dynamic_table_body').empty();
        $('#projectSelect').val('').trigger('change');
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