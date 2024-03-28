@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title">Activity Logs</h4>
                        {{-- <a title="new" href="{{ route('business_permits.create') }}"
                            class="btn btn-sm btn-info py-2 mb-2">Add Permit</a> --}}
                            <div>
                                <form action="{{ route('cert_logs.index') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ $search }}">&nbsp;
                                        <div class="input-group-append ">
                                            <button class="btn btn-sm btn-info py-2 mb-2" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certLog as $item)
                                @php
                                    // date_default_timezone_set('Asia/Manila');
                                    // $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->date_logs, 'Asia/Manila');
                                    // $date->setTimezone('UTC');
                                    @endphp
                                <tr>
                                    {{-- <td>{{ Str::ucfirst($item->resident->firstName) . " " .  Str::ucfirst($item->resident->middleName) . " ". Str::ucfirst($item->resident->lastName)}}</td> --}}
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    {{-- <td class="utc-date" >{{  date('j F, Y ', strtotime($item->date_logs))}}</td> --}}
                                    <td>{{ date('j F, Y g:i:s A', strtotime($item->date_logs)) }}</td>
                                    {{-- <td>{{  $item->date_logs }}</td> --}}
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item {{ $certLog->previousPageUrl() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $certLog->previousPageUrl() }}">Previous</a>
                                </li>
                                @foreach ($certLog->getUrlRange(1, $certLog->lastPage()) as $page => $url)
                                    <li class="page-item {{ $certLog->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ $certLog->nextPageUrl() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $certLog->nextPageUrl() }}">Next</a>
                                </li>
                            </ul>
                        </nav>
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
