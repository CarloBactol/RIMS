@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Blotter Records</h4>
                    <div>
                        <form action="{{ route('blotters.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search Name" name="search" value="{{ $search }}">&nbsp;
                                <div class="input-group-append ">
                                    <button class="btn btn-sm btn-info py-2 mb-2" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <a title="new" href="{{ route('blotters.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
                            Blotter
                        </a>
                    </div>
                   
                </div>
                <div class="table-responsive">
                    
                    <table class="table table-hover" id="">
                        <thead>
                            <tr>
                                <th>Respondent Name</th>
                                <th>Complainant Name</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>    
                        <tbody>
                            @foreach ($blotters as $item)
                            <tr>
                                <td>{{ $item->respondent->firstName.' '. $item->respondent->middleName.' '. $item->respondent->lastName }}</td>
                                <td>{{ $item->complainant->firstName.' '. $item->complainant->middleName.' '. $item->complainant->lastName }}</td>
                                <td>{{ Str::limit( $item->description, 40, 'See more...') }}</td>
                                {{-- <td>{{ $item->created_at->formatLocalized('%A, %d %B %Y | %H:%m') }}</td> --}}
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('blotters.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $item->id }}">
                                        <i class="fas fa-trash" style="margin: 4px 0px"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{  $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this blotter?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <!-- Actual delete form -->
                                                    <form action="{{ route('blotters.destroy', $item->id) }}"
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

                                    @if ($isTrue->contains($item->complainant->id))
                                    <a href="{{ route('blotters.show', $item->id) }}"
                                        class="btn btn-primary py-1 btn-icon float-start me-2">
                                        <i class="fas fa-file"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item {{ $blotters->previousPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $blotters->previousPageUrl() }}">Previous</a>
                            </li>
                            @foreach ($blotters->getUrlRange(1, $blotters->lastPage()) as $page => $url)
                                <li class="page-item {{ $blotters->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $blotters->nextPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $blotters->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
