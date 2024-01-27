@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Login Tracking Overview</h4>
                    {{-- <a title="new" href="{{ route('business_permits.create') }}"
                        class="btn btn-sm btn-info py-2 mb-2">Add Resident</a> --}}
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Last loggedIn</th>
                                <th>Last loggouted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->name)}}</td>
                                <td>{{ Str::lower($item->email)}}</td>
                                <td>
                                    {{-- @php
                                    $dt1 = \Carbon\Carbon::parse($item->last_login_at);
                                    @endphp
                                    {{
                                    $dt1->diffForHumans()
                                    }} --}}
                                    {{ date('j F, Y H:i:s', strtotime( $item->last_login_at)) }}
                                </td>
                                <td>{{ date('j F, Y H:i:s', strtotime( $item->last_logout_at))}}</td>
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
    $(document).ready( function () {
        $('#myTable').DataTable();
        $(".alert").show("slow").delay(3000).hide("slow");
    } );
</script>
@endsection