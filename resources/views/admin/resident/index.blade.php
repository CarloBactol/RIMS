@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-3 my-2">
        <input type="text" id="searchInput" class="form-control " placeholder="Search resident last name.">
    </div>
    <div class="col-md-3 my-2">
        <a title="new" href="{{ route('persons.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
            Resident</a>
    </div>

</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead id="tHead">
           
        </thead>
        <tbody id="searchResultsBody"></tbody>
    </table>
</div>

@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

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
                    $('#tHead').empty();
                    $('#searchResultsBody').empty();
                }
            });

            // update
            function displayResults(results) {
                $('#tHead').empty();
                $('#searchResultsBody').empty();
                console.log(results);

                let thead = ` <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
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
                            </tr>`;
                $('#tHead').append(thead);

                $.each(results, function(index, result) {
                    var id = result.id;
                    var pMesage = result.purpose;
                    pMesage = pMesage == null ? '' : pMesage

                    let row = '<tr>' +

                        '<td>' + result.firstName + '</td>' +
                        '<td>' + result.middleName + '</td>' +
                        '<td>' + result.lastName + '</td>' +
                        '<td>' + result.gender + '</td>' +
                        '<td>' + result.address + '</td>' +
                        '<td>' + result.barangay + '</td>' +
                        '<td>' + pMesage  + '</td>' +
                        '<td>' + result.contactNumber + '</td>' +
                        '<td>' + result.civilStatus + '</td>' +
                        '<td>' + result.nationality + '</td>' +
                        '<td>' + computeAgeWithMonths(result.dateOfBirth).years +  '</td>' +
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