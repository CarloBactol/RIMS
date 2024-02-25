@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title">Certificate Logs</h4>
                        {{-- <a title="new" href="{{ route('business_permits.create') }}"
                            class="btn btn-sm btn-info py-2 mb-2">Add Permit</a> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Resident Name</th>
                                    <th>Certificate Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certLog as $item)
                                <tr>
                                    <td>{{ Str::ucfirst($item->resident->firstName) . " " .  Str::ucfirst($item->resident->middleName) . " ". Str::ucfirst($item->resident->lastName)}}</td>
                                    <td>{{ $item->certificate_type }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(".alert").show("slow").delay(3000).hide("slow");
        });
    </script>
@endsection
