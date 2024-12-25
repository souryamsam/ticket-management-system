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
                            class="form-control form-control-solid w-250px ps-13" placeholder="Search Customer" />
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
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-50px text-gray-900">Sl. No</th>
                            <th class="min-w-125px text-gray-900">Customer Name</th>
                            <th class="min-w-125px text-gray-900">Address</th>
                            <th class="min-w-125px text-gray-900">State</th>
                            <th class="min-w-125px text-gray-900">Projects</th>
                            <th class="min-w-175px text-gray-900">Contact Details</th>
                            <th class="min-w-70px text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        <?php
                        if (!empty($customer_data)) {
                            foreach ($customer_data as $key => $record) {
                                ?>
                                <tr>
                                    <td class="text-gray-900"><?= $key + 1 ?></td>
                                    <td>
                                        <div class="d-flex flex-stack py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="ms-4">
                                                    <label
                                                        class="fs-6 text-gray-900 mb-2"><?= $record['CUSTOMER_NAME'] ?></label>
                                                    <?php if ($record['STATUS'] == 'ACTIVE') { ?>
                                                        <div class="text-white badge badge-success fs-7">
                                                            Active
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="text-white badge badge-danger fs-7">
                                                            Inactive
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-gray-900"><?= $record['ADDRESS'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-gray-600 text-gray-900"><?= $record['STATE_NAME'] ?></div>
                                    </td>
                                    <td class="text-gray-900">
                                        <div class="text-white badge badge-primary fs-7"><?= $record['PROJECT_NAME'] ?></div>
                                    </td>

                                    <td>
                                        <?php
                                        if (!empty($contact_details)) {
                                            foreach ($contact_details as $key => $details) {
                                                if ($record['CUSTOMER_ID'] == $details['CUSTOMER_ID']) {
                                                    ?>
                                                    <div class="text-gray-900">
                                                        <div class="fs-7 fw-bold text-gray-900"><i
                                                                class="bi bi-person-bounding-box text-warning"></i>&nbsp;
                                                            <?= $details['CONTACT_PERSON'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="fw-bold fs-7 text-gray-900">
                                                        <i class="bi bi-telephone-fill "></i>&nbsp;
                                                        <?= $details['CONTACT_NO'] ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        } ?>
                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a class="menu-link px-3"><i class="bi bi-pencil-square"></i>&nbsp; Edit</a>
                                            </div>
                                            <?php if ($record['STATUS'] == 'ACTIVE') { ?>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"><i class="bi bi-check-all"></i>&nbsp; Inactive</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"><i class="bi bi-check-all"></i>&nbsp; Active</a>
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