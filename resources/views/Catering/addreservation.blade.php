@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reserveForm">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <span id="fullname" name="fullname"
                                    class="form-control">{{ auth()->user()->fullname }}</span>
                                <label for="fullname">Fullname</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <span id="email" name="email" class="form-control">{{ auth()->user()->email }}</span>
                                <label for="email">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <span id="contact" name="contact"
                                    class="form-control">{{ auth()->user()->contact }}</span>
                                <label for="contact">Contact</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="address">
                                <label for="address">Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-2 form-floating form-floating-outline">
                            <select class="form-select" id="packages" name="packages" placeholder="Packages"
                                aria-label="Default select example">
                                <option selected> </option>
                                <option value="wedding">Wedding</option>
                                <option value="debut">Debut</option>
                                <option value="privateparty">Private Party</option>
                            </select>
                            <label for="packages">Event Package</label>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="date" name="date" class="form-control" placeholder="xxxx@xxx.xx">
                                <label for="date">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="registerclientBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="updateFullname" name="fullname" class="form-control"
                                    placeholder="Enter Fullname">
                                <label for="Fullname">Fullname</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="email" id="updateEmail" name="email" class="form-control"
                                    placeholder="name@gmail.com">
                                <label for="emailBasic">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="updateContact" name="contact" class="form-control"
                                    placeholder="09xxxxxxx">
                                <label for="Contact">Contact</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="updateAddress" name="address" class="form-control"
                                    placeholder="Address">
                                <label for="Address">Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-2 form-floating form-floating-outline">
                            <select class="form-select" id="updatePackages" name="packages"
                                aria-label="Default select example">
                                <option value="wedding">Wedding</option>
                                <option value="debut">Debut</option>
                                <option value="privateparty">Private Party</option>
                            </select>
                            <label for="updatePackages">Event Package</label>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="updateDate" name="date" class="form-control"
                                    placeholder="xxxx@xxx.xx">
                                <label for="date">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateUserBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<h4 class="py-3 mb-4">
    List of Reservations
</h4>
<div class="card">
    <div class="card-datatable table-responsive pt-0">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="card-header flex-column flex-md-row">
                <div class="d-flex justify-content-between mb-2">
                    <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                        type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
                        <span>
                            <i class="mdi mdi-plus me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Add Reservation</span>
                        </span>
                    </button>
                    <div class="nav-item d-flex align-items-center">
                        <i class="mdi mdi-magnify mdi-24px lh-0"></i>
                        <input type="text" id="searchInput" class="form-control border-2 shadow-none mr-2"
                            placeholder="Search..." aria-label="Search...">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="datatables-basic table table-hover dataTable no-footer dtr-column collapsed"
                        id="userDataTable">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Event Package</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Reservation data will be populated here by a script -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/add_reserve.js') }}"></script>
@endsection