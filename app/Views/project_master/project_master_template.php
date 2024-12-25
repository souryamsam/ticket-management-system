<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="col-xl-12">
                <form method="POST" id="save_project_master_data" action="<?= base_url('save-project-master-data') ?>"
                    enctype="multipart/form-data">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Fill Project Details</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column gap-5 gap-md-7">
                                <div class="d-flex flex-column flex-md-row gap-5">
                                    <div class="col-xl-4 flex-row-fluid">
                                        <label class="form-label required">Project Name</label>
                                        <input type="text" id="project_name" name="project_name" class="form-control"
                                            placeholder="Enter Project Name" value="<?= old('project_name') ?>">
                                        <div class="text-danger text-capitalize" id="duplicateMessage"> </div>
                                        <div class="text-danger">
                                            <?= session()->get('errors')['project_name'] ?? '' ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 flex-row-fluid">
                                        <label class="form-label required">Project Icon (Icon Size 100 x 100 Px)</label>
                                        <input type="file" class="form-control" name="upload_photo" id="projectIcon"
                                            accept="image/*">
                                        <small id="errorMessage" style="color: red; display: none;">Image size must be
                                            100x100 pixels or smaller.</small>
                                        <div class="text-danger">
                                            <?= session()->get('errors')['upload_photo'] ?? '' ?>
                                        </div>
                                    </div>
                                    <div class="flex-row-fluid col-xl-4">
                                        <label class="form-label required">Project Description</label>
                                        <input type="text" name="description" class="form-control"
                                            placeholder="Write Project Description" value="<?= old('description') ?>">
                                        <div class="text-danger">
                                            <?= session()->get('errors')['description'] ?? '' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-wrap" style="justify-content: end;">
                                <button type="submit" class="btn btn-primary btn-sm me-3"><i class="bi bi-floppy2"></i>
                                    Save Project</button>
                                <button type="reset" class="btn btn-light btn-sm"><i class="fa-solid fa-recycle"></i>
                                    Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#project_name').on('keyup', function () {
            var project_name = $(this).val();
            $.ajax({
                url: '<?= base_url('project-master-duplicate-check'); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    project_name: project_name,
                },
                success: function (response) {
                    console.log(response);
                    if (response.status === '1') {
                        $('#duplicateMessage').html("Duplicate Project Name Found");
                        $('#project_name').val('');
                    } else {
                        $('#duplicateMessage').html("");
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', status, error);
                }
            });
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