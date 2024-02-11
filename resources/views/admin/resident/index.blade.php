@extends('layouts.admin')
@section('content')
{{-- <h1>Search Filter</h1> --}}

<div class="row">
    <div class="col-md-3 my-2">
        <input type="text" id="searchInput" class="form-control " placeholder="Search resident last name.">
    </div>
    <div class="col-md-3 my-2">
        <a title="new" href="{{ route('persons.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
            Resident</a>
    </div>

</div>

{{-- <ul id="searchResults"></ul> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Barangay</th>
                <th>Purpose</th>
                <th>Contact Number</th>
                <th>Civil Status</th>
                <th>Nationality</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Action</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody id="searchResultsBody"></tbody>
    </table>
</div>

{{-- <div class="container-fluid">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Residents Overview</h4>
                    <a title="new" href="{{ route('residents.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
                        Resident</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th>DOB</th>
                                <th>Nationality</th>
                                <th>Civi Status</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($residents as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->firstName) }}</td>
                                <td>{{ Str::ucfirst($item->lastName) }}</td>
                                <td>{{ Str::ucfirst($item->address) }}</td>
                                <td>{{ Str::ucfirst($item->contactNumber) }}</td>
                                <td>{{ Str::ucfirst($item->dateOfBirth) }}</td>
                                <td>{{ Str::ucfirst($item->nationality) }}</td>
                                <td>{{ Str::ucfirst($item->civilStatus) }}</td>
                                @php
                                $birthDate = Carbon\Carbon::parse($item->dateOfBirth);
                                $age = "";
                                $age = $birthDate->age;
                                @endphp
                                <td>{{ $age }}</td>
                                <td>{{ Str::ucfirst($item->gender) }}</td>
                                <td><label class=" {{ $item->status == '1' ? 'text-success' : 'text-danger' }}">{{
                                        $item->status == '1' ? 'Active' : 'Inactive'
                                        }}</label></td>
                                <td>
                                    <a href="{{ route('residents.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('residents.show', $item->id) }}"
                                        class="btn btn-secondary py-1 btn-icon float-start me-2">
                                        <i class="fas fa-print"></i>
                                    </a>

                                    <form method="post" action="{{ route('residents.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-1 btn-icon">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
{{-- <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
        $(".alert").show("slow").delay(3000).hide("slow");
    } );
</script> --}}

{{-- <script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            let query = $(this).val();

            if (query.length >= 3) {
                $.ajax({
                    url: '{{ route("search.index") }}',
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {
                        displayResults(data);
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });

        function displayResults(results) {
            $('#searchResults').empty();

            $.each(results, function (index, result) {
                $('#searchResults').append('<li>' + result.lastName + '</li>');
                // Adjust "column_name" based on the actual column name you want to display
            });
        }
    });
</script> --}}


<script>
    $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                let query = $(this).val();

                if (query.length >= 3) {
                    $.ajax({
                        url: '{{ route('search.index') }}',
                        type: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            console.log(data);
                            displayResults(data);
                        }
                    });
                } else {
                    $('#searchResultsBody').empty();
                }
            });



            // function displayResults(results) {
            //     $('#searchResultsBody').empty();
            //     console.log(results);
            //     $.each(results, function(index, result) {
            //         var id = result.id;
            //         let row = '<tr>' +
            //             '<td>' + result.firstName + '</td>' +
            //             '<td>' + result.lastName + '</td>' +
            //             '<td>' + result.gender + '</td>' +
            //             '<td>' + result.address + '</td>' +
            //             '<td>' + result.barangay + '</td>' +
            //             '<td>' + result.purpose + '</td>' +
            //             '<td>' + result.contactNumber + '</td>' +
            //             '<td>' + result.civilStatus + '</td>' +
            //             '<td>' + result.nationality + '</td>' +
            //             '<td>' + computeAgeWithMonths(result.dateOfBirth).years + ' year(s) old and ' +
            //             computeAgeWithMonths(result.dateOfBirth).months + " month(s)" + '</td>' +
            //             '<td>' + result.dateOfBirth + '</td>' +
            //             '<td>' +
            //             '<a href="/admin/persons/' + result.id +
            //             '/edit" ><i class="mx-2 fa fa-edit fa-2x"></i></a>' + ' ' +
            //             '<a href="/admin/persons/' + result.id +
            //             '/show" ><i class="mx-2 fa fa-eye fa-2x"></i></a>' + ' ' +
            //             `  <!-- Button trigger modal -->
            //                         <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
            //                             data-bs-target="#exampleModal${result.id}">
            //                             <i class="fas fa-trash" style="margin: 4px 0px"></i>
            //                         </button>
            //                         <!-- Modal -->
            //                         <div class="modal fade" id="exampleModal${result.id}" tabindex="-1"
            //                             aria-labelledby="exampleModalLabel" aria-hidden="true">
            //                             <div class="modal-dialog">
            //                                 <div class="modal-content">
            //                                     <div class="modal-header">
            //                                         <h5 class="modal-title" id="exampleModalLabel">Confirmation!</h5>
            //                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
            //                                             aria-label="Close"></button>
            //                                     </div>
            //                                     <div class="modal-body">
            //                                         Are you sure you want to delete this user?
            //                                     </div>
            //                                     <div class="modal-footer">
            //                                         <button type="button" class="btn btn-secondary"
            //                                             data-bs-dismiss="modal">Cancel</button>
            //                                         <!-- Actual delete form -->
            //                                         <form action="/admin/persons/${result.id}"
            //                                             method="POST">
            //                                             @csrf
            //                                             @method('DELETE')
            //                                             <button type="submit"
            //                                                 class="btn btn-danger my-2">Delete</button>
            //                                         </form>
            //                                     </div>
            //                                 </div>
            //                             </div>
            //                         </div>` +
            //             '</td>' +
            //             '</tr>';

            //         $('#searchResultsBody').append(row);

            //         var initialAction = $("#deleteForm").attr("action");

            //         // Function to update form action with the provided ID
            //         function updateFormAction(id) {
            //             var newAction = initialAction.replace(':id', id);
            //             $("#deleteForm").attr("action", newAction);
            //         }

            //         // Example usage: Update the form action with the desired ID
            //         var residentId = 0; // Replace this with your actual ID
            //         updateFormAction(residentId);
            //     });
            // }



            // update
            function displayResults(results) {
                $('#searchResultsBody').empty();
                console.log(results);

                $.each(results, function(index, result) {
                    var id = result.id;

                    let row = '<tr>' +

                        '<td>' + result.firstName + '</td>' +
                        '<td>' + result.lastName + '</td>' +
                        '<td>' + result.gender + '</td>' +
                        '<td>' + result.address + '</td>' +
                        '<td>' + result.barangay + '</td>' +
                        '<td>' + result.purpose + '</td>' +
                        '<td>' + result.contactNumber + '</td>' +
                        '<td>' + result.civilStatus + '</td>' +
                        '<td>' + result.nationality + '</td>' +
                        '<td>' + computeAgeWithMonths(result.dateOfBirth).years + ' year(s) old and ' +
                        computeAgeWithMonths(result.dateOfBirth).months + " month(s)" + '</td>' +
                        '<td>' + result.dateOfBirth + '</td>' +
                        '<td>' +
                        '<a href="/admin/persons/' + result.id +
                        '/edit"><i class="mx-2 fa fa-edit fa-2x"></i></a>' + ' ' +
                        '<a href="/admin/persons/' + result.id +
                        '/show"><i class="mx-2 fa fa-eye fa-2x"></i></a>' + ' ' +
                       `  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal${result.id}">
                                        <i class="fas fa-trash" style="margin: 4px 0px"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal${result.id}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this user?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <!-- Actual delete form -->
                                                    <form action="/admin/persons/${result.id}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger my-2">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>` +

                        '</td>' +
                        '</tr>';

                    $('#searchResultsBody').append(row);

                    // Update the form action dynamically for each modal
                    $('#exampleModal' + result.id).on('show.bs.modal', function(event) {
                        var modal = $(this);
                        var formAction = "/admin/persons/" + result.id;

                        modal.find('.modal-footer form').attr('action', formAction);
                    });
                });
            }


            // '<button type="button" class="btn btn-danger"  '+ 'onclick=" '+confirmDelete(result.id)+' "' + '">Delete</button>' +


            function computeAgeWithMonths(dateOfBirth) {
                // Parse the date of birth string into a Date object
                const dob = new Date(dateOfBirth);

                // Get the current date
                const currentDate = new Date();

                // Calculate the difference in years
                const ageInYears = currentDate.getFullYear() - dob.getFullYear();

                // Calculate the difference in months
                let ageInMonths = currentDate.getMonth() - dob.getMonth();

                // Adjust the months difference based on the day of the month
                if (currentDate.getDate() < dob.getDate()) {
                    ageInMonths--;
                }

                // If the months difference is negative, add 12 months to the age
                if (ageInMonths < 0) {
                    ageInMonths += 12;
                }

                return {
                    years: ageInYears,
                    months: ageInMonths
                };
            }

        });
</script>
@endsection