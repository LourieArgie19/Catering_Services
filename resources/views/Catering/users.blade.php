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
                <form id="addform">
                    @csrf
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="fullname" name="fullname" class="form-control"
                                    placeholder="Fullname">
                                <label for="fullname">Fullname</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                <label for="email">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Enter Password">
                                <label for="passwordBasic">Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="contact" id="contact" name="contact" class="form-control"
                                    placeholder="Contact">
                                <label for="contact">Contact</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-2 form-floating form-floating-outline">
                            <select class="form-select" id="role" name="role" placeholder="Role"
                                aria-label="Default select example">
                                <option selected> </option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <label for="role">Role</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addUserBtn">Save</button>
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
                                    placeholder="Enter Fullnme">
                                <label for="Fullname">Name</label>
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
                        <div class="col mb-2 form-floating form-floating-outline">
                            <select class="form-select" id="updateRole" name="role" aria-label="Default select example">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <label for="updateRole">Role</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="password" id="updatePassword" name="password" class="form-control"
                                    placeholder="Enter Password">
                                <label for="passwordBasic">Password</label>
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
    List of Users
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
                            <span class="d-none d-sm-inline-block">Add User</span>
                        </span>
                    </button>
                    
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
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>{{ $user->role }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="{{ asset('assets/js/fetchuser.js') }}"></script>
            <script src="{{ asset('assets/js/register.js') }}"></script>
            @endsection