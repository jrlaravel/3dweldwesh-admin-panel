@extends('layouts.master')

@section('title')
    Inquiry
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') 3dWeldmesh @endslot
    @slot('title') Inquiry @endslot
@endcomponent

<div class="row">
    <div class="col-12">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">All Inquiries</h3>
            </div>

            <div class="table-responsive">
                <table class="table align-middle table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Project Type</th>
                            <th>Fencing Needed</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($inquiries as $inquiry)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->phone }}</td>
                                <td>{{ $inquiry->location }}</td>
                                <td>{{ $inquiry->project_type }}</td>
                                <td>
                                    <span class="badge bg-{{ $inquiry->fencing_needed ? 'success' : 'secondary' }}">
                                        {{ $inquiry->fencing_needed ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td style="max-width:250px;">
                                    {{ $inquiry->message }}
                                </td>
                                <td>
                                    {{ $inquiry->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">
                                    No inquiries found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
