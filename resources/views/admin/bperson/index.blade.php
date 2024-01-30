@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Person</h4>
                    <a title="new" href="{{ route('blotters.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
                        Person
                    </a>
                </div>
                {{-- <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Encoded By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blotter as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->resident->firstName)}}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->officer->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
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