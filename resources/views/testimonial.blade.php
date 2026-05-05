@extends('layouts.master')
@section('title')
    Testimonial
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            3dWeldmesh
        @endslot
        @slot('title')
            Testimonial
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach (session('errors')->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0"></h3>
                        <button class="btn btn-dark" onclick="openAddModal()">+ Add</button>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-check">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Message</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->message }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"
                                            onclick="editTestimonial({{ $testimonial->id }})">
                                            Edit
                                        </button>

                                        <a href="{{ route('delete-testimonial', $testimonial->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this testimonial?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="testimonialModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testimonialModalLabel">Add Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="testimonialForm" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="testimonial_id">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="testimonial_name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" id="testimonial_location"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Message</label>
                                <textarea class="form-control" name="message" id="testimonial_message"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" id="testimonial_designation"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" id="testimonial_image">
                                <small id="imageHint" class="text-muted"></small>
                            </div>

                            <div class="col-md-6 mb-3 text-center">
                                <img id="testimonial_preview" class="img-fluid rounded" style="max-height:120px;">
                            </div>

                        </div>

                        <button type="submit" id="testimonialSubmitBtn" class="btn btn-primary float-end">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="successMessage">Your operation was successful!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openAddModal() {
            document.getElementById('testimonialModalLabel').innerText = "Add Testimonial";
            document.getElementById('testimonialForm').action = "{{ route('store-testimonial') }}";
            document.getElementById('testimonialSubmitBtn').innerText = "Add Testimonial";

            document.getElementById('testimonialForm').reset();
            document.getElementById('testimonial_id').value = "";
            document.getElementById('testimonial_preview').src = "";
            document.getElementById('imageHint').innerText = "Required for new testimonial";

            let modal = new bootstrap.Modal(document.getElementById('testimonialModal'));
            modal.show();
        }

        function editTestimonial(id) {
            fetch(`/edit-testimonial/${id}`)
                .then(res => res.json())
                .then(data => {

                    document.getElementById('testimonialModalLabel').innerText = "Edit Testimonial";
                    document.getElementById('testimonialForm').action = "{{ route('update-testimonial') }}";
                    document.getElementById('testimonialSubmitBtn').innerText = "Update Testimonial";

                    document.getElementById('testimonial_id').value = data.id;
                    document.getElementById('testimonial_name').value = data.name;
                    document.getElementById('testimonial_location').value = data.location;
                    document.getElementById('testimonial_designation').value = data.designation;
                    document.getElementById('testimonial_message').value = data.message ?? '';

                    if (data.image) {
                        document.getElementById('testimonial_preview').src = `/storage/${data.image.path}`;
                    }

                    document.getElementById('imageHint').innerText = "Leave empty to keep existing image";

                    let modal = new bootstrap.Modal(document.getElementById('testimonialModal'));
                    modal.show();
                });
        }

        function deleteTestimonial(id) {
            Swal.fire({
                title: "Delete this testimonial?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes"
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = `/delete-testimonial/${id}`;
                }
            });
        }
    </script>
@endsection
