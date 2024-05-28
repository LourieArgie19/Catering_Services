@extends('layouts/contentNavbarLayout')

@section('title', 'Reservations')

@section('content')
<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add Reservation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reserveForm" action="{{ route('add.reservations') }}">
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
                        <button type="submit" class="btn btn-primary" id="add-reservation-btn">Save</button>
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
                    <input type="hidden" id="updateuser_id" name="user_id">
                    <input type="hidden" id="reservation_id" name="reservation_id">
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" readonly id="updateFullname" name="fullname" class="form-control"
                                    placeholder="Enter Fullname">
                                <label for="Fullname">Fullname</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="email" readonly id="updateEmail" name="email" class="form-control"
                                    placeholder="name@gmail.com">
                                <label for="emailBasic">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" readonly id="updateContact" name="contact" class="form-control"
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

<div class="card mb-2">
    <div class="card-header">
    <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
        type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
        <span>
            <i class="mdi mdi-plus me-sm-1"></i>
            <span class="d-none d-sm-inline-block">Add Reservation</span>
        </span>
    </button>
    </div>

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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->user->fullname }}</td>
                        <td>{{ $reservation->user->email }}</td>
                        <td>{{ $reservation->user->contact }}</td>
                        <td>{{ $reservation->address }}</td>
                        <td>
                            @if($reservation->packages  === 'privateparty')
                                Private Party
                            @else
                                {{ ucwords(strtolower($reservation->packages)) }}
                            @endif
                        </td>
                        <td>{{ $reservation->reservation_date }}</td>
                        <!-- <td> -->
                            {{-- @if($reservation->is_confirmed) --}}
                                <!-- <span class="badge rounded-pill bg-label-success me-1">Confirmed</span> -->
                            {{-- @else --}}
                                <!-- <span type="button" data-id="{{ $reservation->id }}" class="confirm-btn btn rounded-pill me-2 btn-primary">Confirm?</span> -->
                            {{-- @endif --}}
                        <!-- </td> -->

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item edit-reservation" data-id="{{ $reservation->id }}">
                                        <i class="mdi mdi-pencil-outline me-1"></i> 
                                        Edit
                                    </a>
                                    <a class="dropdown-item delete-reservation" data-id="{{ $reservation->id }}">
                                        <i class="mdi mdi-trash-can-outline me-1"></i> 
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection

@section('page-script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

$(document).ready(function () {
  $('#reserveForm').submit(function (e) {
    e.preventDefault();

    let _token = $('input[name="_token"]').val();
    let user_id = $('#user_id').val();
    let fullName = $('#fullname').val();
    let email = $('#email').val();
    let contact = $('#contact').val();
    let address = $('#address').val();
    let package = $('#packages').val();
    let reservationDate = $('#date').val();

    $.ajax({
      url: $(this).attr('action'),
      method: 'post',
      dataType: 'json',
      data: { _token, user_id, fullName, email, contact, address, package, reservationDate },
      beforeSend: () => {
        $('.is-invalid').removeClass('is-invalid');
        $('#add-reservation-btn').attr('disabled', true);
        $('#add-reservation-btn').html(`<span class="spinner-border text-primary"></span Adding...`);
      },
      success: response => {
        $('#add-reservation-btn').attr('disabled', false);
        $('#add-reservation-btn').html(`SAVE`);

        let package = $('#packages').val('').trigger('change');
        let reservationDate = $('#date').val('');

        Swal.fire({
          title: 'Success!',
          text: 'Reservation saved!',
          icon: 'success'
        }).then(result => {
          window.location.reload();
        });
      },
      error: (jqXHR, textStatus) => {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON?.errors;
          console.log(jqXHR);
          Swal.fire({
            title: 'Error!',
            text: 'Please fill all required fields!',
            icon: 'warning'
          });

          if ('address' in errors) {
            $('#address').addClass('is-invalid');
          }

          if ('package' in errors) {
            $('#packages').addClass('is-invalid');
          }

          if ('reservationDate' in errors) {
            $('#date').addClass('is-invalid');
          }
        } else if (jqXHR.status === 409) {
          Swal.fire({
            title: 'Error!',
            text: jqXHR.responseJSON?.message,
            icon: 'warning'
          });
        } else {
          Swal.fire({
            title: 'Error!',
            text: 'Unable to create reservation. Please refresh the page and try again.',
            icon: 'warning'
          });
        }

        $('#add-reservation-btn').attr('disabled', false);
        $('#add-reservation-btn').html(`SAVE`);
      }
    });
  });

  $('.confirm-btn').on('click', function () {
    let id = $(this).data('id');
    Swal.fire({
      title: 'Confirm reservation?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Approve reservation',
      cancelButtonText: 'Decline reservation'
    }).then(result => {
      if (result.isConfirmed) {
        // confirm  reservation
        console.log(id);
        Swal.fire({
          title: 'Deleted!',
          text: 'Your file has been deleted.',
          icon: 'success'
        });
      } else if (result.dismiss === 'cancel') {
        //decline reservation

        Swal.fire({
          title: 'Deleted!',
          text: 'Cancelled.',
          icon: 'success'
        });
      }
    });
  });

  $('.edit-reservation').on('click', function() {
    let id = $(this).data('id');
    let _token = $('input[name="_token"]').val();

    $.ajax({
            url: `/reservations/${id}`,
            method: 'get',
            dataType: 'json',
            data: {_token},
            success: response => {
                console.log(response);

                 $('#reservation_id').val(id);
                 $('#updateuser_id').val(response.user_id);
                 $('#updateFullname').val(response.fullname);
                 $('#updateEmail').val(response.email);
                 $('#updateContact').val(response.contact);
                 $('#updateAddress').val(response.address);
                 $('#updatePackages').val(response.package).trigger('change');
                 $('#updateDate').val(response.reservationDate);


                $('#updateModal').modal('show');
            },
            error: (jqXHR, textStatus) => {
                Swal.fire({
                    title: 'Error!',
                    text: jqXHR.responseJSON?.message,
                    icon: 'warning'
                });
            }
        });

  });

  $('#updateForm').on('submit', function(e) {
    e.preventDefault();
    let id = $('#reservation_id').val();

    let user_id = $('#updateuser_id').val();
    let address = $('#updateAddress').val();
    let package = $('#updatePackages').val();
    let reservationDate = $('#updateDate').val();

    let _token = $('input[name="_token"]').val();

    $.ajax({
      url: `/reservations/${id}`,
      method: 'put',
      dataType: 'json',
      data: { _token, user_id, address, package, reservationDate },
      beforeSend: () => {
        $('.is-invalid').removeClass('is-invalid');
        $('#updateUserBtn').attr('disabled', true);
        $('#updateUserBtn').html(`<span class="spinner-border text-primary"></span Updating...`);
      },
      success: response => {
        $('#updateUserBtn').attr('disabled', false);
        $('#updateUserBtn').html(`UPDATE`);
       
        Swal.fire({
          title: 'Success!',
          text: 'Reservation successfully updated!',
          icon: 'success'
        }).then(result => {
          window.location.reload();
        });
      },
      error: (jqXHR, textStatus) => {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON?.errors;
          
          Swal.fire({
            title: 'Error!',
            text: 'Please fill all required fields!',
            icon: 'warning'
          });

          if ('address' in errors) {
            $('#address').addClass('is-invalid');
          }

          if ('package' in errors) {
            $('#packages').addClass('is-invalid');
          }

          if ('reservationDate' in errors) {
            $('#date').addClass('is-invalid');
          }
        } else if (jqXHR.status === 409) {
          Swal.fire({
            title: 'Error!',
            text: jqXHR.responseJSON?.message,
            icon: 'warning'
          });
        } else {
          Swal.fire({
            title: 'Error!',
            text: 'Unable to update reservation. Please refresh the page and try again.',
            icon: 'warning'
          });
        }

        $('#updateUserBtn').attr('disabled', false);
        $('#updateUserBtn').html(`UPDATE`);
      }
    });
  })

  $('.delete-reservation').on('click', function() {
    let id = $(this).data('id');
    let _token = $('input[name="_token"]').val();

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
    }).then(result => {
      if (result.isConfirmed) {
        // confirm  reservation
        $.ajax({
            url: `/reservations/${id}`,
            method: 'delete',
            dataType: 'json',
            data: {_token},
            success: response => {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Reservation successfully deleted!',
                    icon: 'success'
                }).then(result => {
                    window.location.reload();
                });
            },
            error: (jqXHR, textStatus) => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Unable to delete reservation. Please refresh the page and try again.',
                    icon: 'warning'
                });
            }
        });
      }
    });
  });

});

</script>
@endsection