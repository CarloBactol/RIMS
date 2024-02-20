@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Barangay Council Members</h2>
        <a title="new" href="{{ route('baranagay_l_g_u_s.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
            LGU
        </a>
        <div class="row mt-4">
            @foreach ($members as $member)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 300px">
                        <img src="{{ asset('images/con_image/'.$member->image) }}" class="card-img-top"
                            alt="{{ $member->role }} Image" >
                        <div class="card-body">
                            <h5 class="card-title">{{ $member->firstName . ' ' . $member->lastName }} <span
                                    class="badge bg-primary">{{ $member->role }}</span></h5>
                            {{-- <p class="card-text"><strong>Contact:</strong> {{ $member['contact'] }}</p> --}}
                            {{-- <p class="card-text"><strong>Email:</strong> {{ $member['email'] }}</p> --}}
                            {{-- <p class="card-text"><strong>Address:</strong> {{ $member['address'] }}</p> --}}
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#infoModal{{ $loop->index }}">View Info</a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="infoModal{{ $loop->index }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ $member->firstName . ' ' . $member->lastName }} - {{ $member->role }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- <p><strong>Contact:</strong> {{ $member['contact'] }}</p>
                        <p><strong>Email:</strong> {{ $member['email'] }}</p>
                        <p><strong>Address:</strong> {{ $member['address'] }}</p> --}}
                                <!-- Add more details as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
