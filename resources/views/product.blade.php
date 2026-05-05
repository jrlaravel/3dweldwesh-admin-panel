@extends('layouts.master')
@section('title')
    Product
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') 3dWeldmesh @endslot
    @slot('title') Product @endslot
@endcomponent

<div class="row">
    <div class="col-12">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card p-3">
            <div class="d-flex justify-content-between mb-3">
                <h3></h3>
                <button class="btn btn-dark" onclick="openAddModal()">+ Add</button>
            </div>

            <table class="table" id="product-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image->path) }}" height="50">
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary"
                                    onclick="editProduct({{ $product->id }})">Edit</button>

                                <a href="{{ route('delete-product',$product->id) }}"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete product?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="productModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="product_id">

                <div class="modal-header">
                    <h5 id="productModalLabel">Add Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="product_name" required>
                    </div>
                    
                     <div class="mb-3">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" id="product_description" required>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                        <img id="product_preview" class="mt-2" height="80">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" id="productSubmitBtn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
@endsection

@section('script-bottom')
<script>
$(document).ready(function() {
    $('#product-datatable').DataTable();
});

function openAddModal() {
    productForm.action = "{{ route('store-product') }}";
    productForm.reset();
    product_id.value = '';
    productModalLabel.innerText = 'Add Product';
    productSubmitBtn.innerText = 'Add';
    new bootstrap.Modal(productModal).show();
}

function editProduct(id) {
    fetch(`/edit-product/${id}`)
        .then(res => res.json())
        .then(data => {
            productForm.action = "{{ route('update-product') }}";
            product_id.value = data.id;
            product_name.value = data.name;
            product_description.value = data.description;
            if (data.image) {
                product_preview.src = `/storage/${data.image.path}`;
            }
            productModalLabel.innerText = 'Edit Product';
            productSubmitBtn.innerText = 'Update';
            new bootstrap.Modal(productModal).show();
        });
}
</script>
@endsection
