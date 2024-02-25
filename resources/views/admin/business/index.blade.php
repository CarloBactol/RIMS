@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title">Permit to Operate</h4>
                        <a title="new" href="{{ route('business_permits.create') }}"
                            class="btn btn-sm btn-info py-2 mb-2">Add Permit</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Owner Name</th>
                                    <th>Business Name</th>
                                    <th>Business Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($business as $item)
                                    <tr>
                                        <td>{{ Str::ucfirst($item->resident->firstName) . ' ' . Str::ucfirst($item->resident->lastName) }}
                                        </td>
                                        <td>{{ Str::ucfirst($item->businessName) }}</td>
                                        <td>{{ Str::ucfirst($item->businessAddress) }}</td>
                                        {{-- <td><label
                                                class=" {{ $item->resident->status == '1' ? 'text-success' : 'text-danger' }}">{{ $item->resident->status == '1' ? 'Active' : 'Inactive' }}</label>
                                        </td> --}}
                                        <td>
                                            <a href="{{ route('business_permits.edit', $item->id) }}"
                                                class="btn btn-info py-1 btn-icon float-start me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- <a href="{{ route('business_permits.show', $item->id) }}"
                                        class="btn btn-secondary py-1 btn-icon float-start me-2">
                                        <i class="fas fa-print"></i>
                                    </a> --}}
                                            {{--
                                    <form method="post" action="{{ route('business_permits.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-1 btn-icon">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> --}}
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->id }}">
                                                <i class="fas fa-trash" style="margin: 4px 0px"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation!
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <!-- Actual delete form -->
                                                            <form
                                                                action="{{ route('business_permits.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger my-2">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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
