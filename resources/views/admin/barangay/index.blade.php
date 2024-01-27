@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Barangay Council Members</h2>

        {{-- <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/dashboard/profile-card.jpg') }}" class="card-img-top" alt="Mayor Image">
                    <div class="card-body">
                        <h5 class="card-title">Mayor <span class="badge bg-danger">Mayor</span></h5>
                        <p class="card-text"><strong>Name:</strong> Juan Dela Cruz</p>
                        <p class="card-text"><strong>Contact:</strong> 456-789-0123</p>
                        <p class="card-text"><strong>Email:</strong> mayor@example.com</p>
                        <p class="card-text"><strong>Address:</strong> Barangay XYZ</p>
                        <a href="#" class="btn btn-primary">View Info</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/dashboard/profile-card.jpg') }}" class="card-img-top" alt="Captain Image">
                    <div class="card-body">
                        <h5 class="card-title">Barangay Captain <span class="badge bg-primary">Captain</span></h5>
                        <p class="card-text"><strong>Name:</strong> John Doe</p>
                        <p class="card-text"><strong>Contact:</strong> 123-456-7890</p>
                        <p class="card-text"><strong>Email:</strong> captain@example.com</p>
                        <p class="card-text"><strong>Address:</strong> Barangay XYZ</p>
                        <a href="#" class="btn btn-primary">View Info</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/dashboard/profile-card.jpg') }}" class="card-img-top"
                        alt="Chairperson Image">
                    <div class="card-body">
                        <h5 class="card-title">Chairperson <span class="badge bg-success">Chairperson</span></h5>
                        <p class="card-text"><strong>Name:</strong> Jane Doe</p>
                        <p class="card-text"><strong>Contact:</strong> 987-654-3210</p>
                        <p class="card-text"><strong>Email:</strong> chairperson@example.com</p>
                        <p class="card-text"><strong>Address:</strong> Barangay XYZ</p>
                        <a href="#" class="btn btn-primary">View Info</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/dashboard/profile-card.jpg') }}" class="card-img-top" alt="Councilor Image">
                    <div class="card-body">
                        <h5 class="card-title">Councilor <span class="badge bg-warning text-dark">Councilor</span></h5>
                        <p class="card-text"><strong>Name:</strong> Mark Smith</p>
                        <p class="card-text"><strong>Contact:</strong> 567-890-1234</p>
                        <p class="card-text"><strong>Email:</strong> councilor@example.com</p>
                        <p class="card-text"><strong>Address:</strong> Barangay XYZ</p>
                        <a href="#" class="btn btn-primary">View Info</a>
                    </div>
                </div>
            </div>

            <!-- Add more cards for other councilors as needed -->


            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/dashboard/profile-card.jpg') }}" class="card-img-top" alt="Treasurer Image">
                    <div class="card-body">
                        <h5 class="card-title">Treasurer <span class="badge bg-info">Treasurer</span></h5>
                        <p class="card-text"><strong>Name:</strong> Maria Santos</p>
                        <p class="card-text"><strong>Contact:</strong> 789-012-3456</p>
                        <p class="card-text"><strong>Email:</strong> treasurer@example.com</p>
                        <p class="card-text"><strong>Address:</strong> Barangay XYZ</p>
                        <a href="#" class="btn btn-primary">View Info</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/dashboard/profile-card.jpg') }}" class="card-img-top" alt="Secretary Image">
                    <div class="card-body">
                        <h5 class="card-title">Secretary <span class="badge bg-secondary">Secretary</span></h5>
                        <p class="card-text"><strong>Name:</strong> Carlos Ramirez</p>
                        <p class="card-text"><strong>Contact:</strong> 012-345-6789</p>
                        <p class="card-text"><strong>Email:</strong> secretary@example.com</p>
                        <p class="card-text"><strong>Address:</strong> Barangay XYZ</p>
                        <a href="#" class="btn btn-primary">View Info</a>
                    </div>
                </div>
            </div>

        </div> --}}

        <div class="row mt-4">
            @foreach ($members as $member)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/dashboard/profile-card.jpg') }}" class="card-img-top"
                            alt="{{ $member->role }} Image">
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
