@extends('layouts.master')
@section('title') Dashboard @endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') 3dWeldmesh @endslot
    @slot('title') Dashboard @endslot
@endcomponent

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart"></div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $productCount }}</span></h4>
                    <p class="text-muted mb-0">Total Products</p>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>Active</span> since launch
                </p>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="orders-chart"></div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $serviceCount }}</span></h4>
                    <p class="text-muted mb-0">Services Offered</p>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>Core</span> business units
                </p>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="customers-chart"></div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $testimonialCount }}</span></h4>
                    <p class="text-muted mb-0">Testimonials</p>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>Verified</span> client reviews
                </p>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="growth-chart"></div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $inquiryCount }}</span></h4>
                    <p class="text-muted mb-0">Total Inquiries</p>
                </div>
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>New</span> leads captured
                </p>
            </div>
        </div>
    </div> <!-- end col-->
</div> <!-- end row-->

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Inquiry Analytics (Last 6 Months)</h4>
                <div id="inquiry_chart" class="apex-charts"></div>
            </div>
        </div><!--end card-->
    </div> <!-- end col-->

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Recent Inquiries</h4>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentInquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->created_at->format('d M') }}</td>
                                <td>
                                    <a href="{{ route('inquiry') }}" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-center">
                    <a href="{{ route('inquiry') }}" class="btn btn-outline-dark btn-sm">View All Inquiries</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
@endsection

@section('script-bottom')
<script>
    // Inquiry Analytics Chart
    var options = {
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                show: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3,
        },
        series: [{
            name: 'Inquiries',
            data: @json($counts)
        }],
        colors: ['#5b73e8'],
        xaxis: {
            categories: @json($months),
        },
        grid: {
            borderColor: '#f1f1f1',
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [20, 100, 100, 100]
            },
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#inquiry_chart"),
        options
    );

    chart.render();
</script>
@endsection
