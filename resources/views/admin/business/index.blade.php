@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-md-3 my-2">
            <input type="text" id="searchInput" class="form-control " placeholder="Search resident last name.">
        </div>
        <div class="col-md-2 my-2">
            <a title="new" href="{{ route('persons.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
                Resident</a>
        </div>
        <div class="col-md-2" id="btnList" style="display: none">
            <a href="" class="btn btn-sm btn-outline-info " id="editLink"><i class="fas fa-edit"></i></a>
            {{-- <a href="" class="btn btn-sm btn-outline-info " id="viewLink"><i class="fas fa-file"></i></a> --}}
            {{-- <a href="" class="btn btn-sm btn-outline-info "><i class="fas fa-trash"></i></a> --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <i class="fas fa-trash" ></i>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1"
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
                            <form action="" id="formDelete"
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
                        url: '{{ route('search_permit.index') }}',
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
                                <th></th>
                                <th>Owner Name</th>
                                <th>Business Name</th>
                                <th>Business Address</th>
                            </tr>`;
                $('#tHead').append(thead);

                $.each(results, function(index, result) {
                    var id = result.id;
                    var pMesage = result.purpose;
                    pMesage = pMesage == null ? '' : pMesage

                    let row = '<tr>' +

                       `<td>
                        <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" value="${result.id}" id="exampleCheckbox1">
                            </label>
                        </div>
                        </td>` +
                        '<td>' + result.resident.firstName + '</td>' +
                        '<td>' + result.businessName + '</td>' +
                        '<td>' + result.businessAddress + '</td>' +
                        '</tr>';

                  
                    $('#searchResultsBody').append(row);

                    // Update the form action dynamically for each modal
                    $('#exampleModal' + result.id).on('show.bs.modal', function(event) {
                        var modal = $(this);
                        var formAction = "/admin/persons/" + result.id;

                        modal.find('.modal-footer form').attr('action', formAction);
                    });

                     // Add change event listener to checkboxes
                    $('.form-check-input').change(function(){

                         // Disable all other radio inputs
                        $('.form-check-input').not(this).prop('disabled', true);
                        // Enable the selected radio input
                        $(this).prop('disabled', false);

                        // Check if the checkbox is checked
                        if($(this).is(':checked')){
                            // Get the value of the checked checkbox
                            var value = $(this).val();
                            console.log('Checked Checkbox Value:', value);
                            // Update the href attribute of the anchor tag
                             $('#editLink').attr('href', '/admin/business_permits/' + value + '/edit/');
                            //  $('#viewLink').attr('href', '/admin/business_permits/' + value + '/show/');
                             $('#deleteLink').attr('href', '/admin/business_permits/' + value + '/edit/');
                             $('#formDelete').attr('action', '/admin/business_permits/' + value );

                             // Show button 
                             $('#btnList').css('display', 'block');
                        }else{
                            $('#btnList').css('display', 'none');
                            // Enable all other radio inputs
                            $('.form-check-input').not(this).prop('disabled', false);
                        }
                    });
                });
            }

        });
</script>
@endsection
