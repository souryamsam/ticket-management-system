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
                            class="form-control form-control-solid w-250px ps-13" placeholder="Search Role" />
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
                            <th class="min-w-125px">Role Name</th>
                            <th class="min-w-125px">Create Date</th>
                            <th class="min-w-70px">Action</th>
                        </tr>
                    </thead>
                    <?php
                    if (!empty($role_master_view_data)) {
                        foreach ($role_master_view_data as $key => $role) {
                            ?>
                            <tbody class="fw-semibold text-gray-900">
                                <tr>
                                    <td class="text-gray-900"><?= $key + 1 ?></td>
                                    <td>
                                        <div class="ms-4">
                                            <span
                                                class="text-white badge badge-primary fs-7"><?= $role['USER_GROUP_NAME']; ?></span>
                                        </div>
                                    </td>
                                    <td><i class="bi bi-calendar-week-fill text-warning"></i>&nbsp;
                                        <?= date('d-m-Y | h:i a', strtotime($role['CREATE_DATE_TIME'])) ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">

                                            <div class="menu-item px-3">
                                                <a class="menu-link px-3" href="role-master.html"><i
                                                        class="bi bi-pencil-square"></i>&nbsp; Edit
                                                    Role</a>
                                            </div>
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