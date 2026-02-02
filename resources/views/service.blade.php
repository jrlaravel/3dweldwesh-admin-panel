@extends('layouts.master')
@section('title')
    Service
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Arisique @endslot
    @slot('title') Service @endslot
@endcomponent

<div class="row">
    <div class="col-12">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3></h3>
                <button class="btn btn-dark" onclick="openAddModal()">+ Add</button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>
                                    @if ($service->image)
                                        <img src="{{ asset('storage/'.$service->image->path) }}"
                                             class="rounded"
                                             style="height:50px;">
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary"
                                        onclick="editService({{ $service->id }})">
                                        Edit
                                    </button>

                                    <a href="{{ route('delete-service',$service->id) }}"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this service?')">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Add Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="serviceForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="service_id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   id="service_name"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Description</label>
                            <textarea class="form-control"
                                      name="description"
                                      id="service_description"
                                      rows="3"
                                      required></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file"
                                   class="form-control"
                                   name="image"
                                   id="service_image">
                            <small id="imageHint" class="text-muted"></small>
                        </div>

                        <div class="col-md-6 mb-3 text-center">
                            <img id="service_preview"
                                 class="img-fluid rounded"
                                 style="max-height:120px;">
                        </div>
                    </div>

                    <button type="submit"
                            id="serviceSubmitBtn"
                            class="btn btn-primary float-end">
                        Add Service
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('serviceModalLabel').innerText = "Add Service";
    document.getElementById('serviceForm').action = "{{ route('store-service') }}";
    document.getElementById('serviceSubmitBtn').innerText = "Add Service";

    document.getElementById('serviceForm').reset();
    document.getElementById('service_id').value = "";
    document.getElementById('service_preview').src = "";
    document.getElementById('imageHint').innerText = "Required for new service";

    new bootstrap.Modal(document.getElementById('serviceModal')).show();
}

function editService(id) {
    fetch(`/edit-service/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('serviceModalLabel').innerText = "Edit Service";
            document.getElementById('serviceForm').action = "{{ route('update-service') }}";
            document.getElementById('serviceSubmitBtn').innerText = "Update Service";

            document.getElementById('service_id').value = data.id;
            document.getElementById('service_name').value = data.name;
            document.getElementById('service_description').value = data.description;

            if (data.image) {
                document.getElementById('service_preview').src =
                    `/storage/${data.image.path}`;
            }

            document.getElementById('imageHint').innerText =
                "Leave empty to keep existing image";

            new bootstrap.Modal(document.getElementById('serviceModal')).show();
        });
}
</script>
@endsection
