@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 " style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Create LGU</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('baranagay_l_g_u_s.index') }}" class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('baranagay_l_g_u_s.update', $lgus->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                     
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                            name="firstName" value="{{ $lgus->firstName }}" id="firstName" placeholder="First Name">
                                        @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="middleName">Miidle Name</label>
                                        <input type="text" class="form-control @error('middleName') is-invalid @enderror"
                                            name="middleName" value="{{ $lgus->middleName }}" id="middleName" placeholder="Middle Name">
                                        @error('middleName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                            name="lastName" value="{{ $lgus->lastName }}" id="lastName" placeholder="Last Name">
                                        @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            name="address" value="{{ $lgus->address }}" id="address" placeholder="First Name">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="contactNo">Contact No.</label>
                                        <input type="text" class="form-control @error('contactNo') is-invalid @enderror"
                                            name="contactNo" value="{{ $lgus->contactNo }}" id="contactNo" placeholder="Contact No.">
                                        @error('contactNo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @error('contactNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="schedule">Schedule</label>
                                        <select name="schedule" id=""
                                        class="form-control @error('schedule') is-invalid @enderror">
                                        <option selected value="" disabled>Select Schedule</option>
                                        <option value="MONDAY" {{ $lgus->schedule == "MONDAY" ? 'selected' : '' }}>MONDAY</option>
                                        <option value="TUESDAY" {{ $lgus->schedule == "TUESDAY" ? 'selected' : '' }}>TUESDAY</option>
                                        <option value="WEDNESDAY" {{ $lgus->schedule == "WEDNESDAY" ? 'selected' : '' }}>WEDNESDAY</option>
                                        <option value="THURSDAY" {{ $lgus->schedule == "THURSDAY" ? 'selected' : '' }}>THURSDAY</option>
                                        <option value="FRIDAY" {{ $lgus->schedule == "FRIDAY" ? 'selected' : '' }}>FRIDAY</option>
                                        <option value="SUTURDAY" {{ $lgus->schedule == "SUTURDAY" ? 'selected' : '' }}>SUTURDAY</option>
                                        <option value="SUNDAY" {{ $lgus->schedule == "SUNDAY" ? 'selected' : '' }}>SUNDAY</option>
                                    </select>
                                    @error('schedule')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                       <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="role">Role</label>
                            <select name="role" id=""
                                class="form-control @error('role') is-invalid @enderror">
                                <option selected value="" disabled>Select Role</option>
                                <option value="Captain" {{ $lgus->role == "Captain" ? 'selected' : '' }}>Captain</option>
                                <option value="Councilor" {{ $lgus->role == "Councilor" ? 'selected' : '' }}>Councilor</option>
                                <option value="Secretary" {{ $lgus->role == "Secretary" ? 'selected' : '' }}>Secretary</option>
                                <option value="Treasurer" {{ $lgus->role == "Treasurer" ? 'selected' : '' }}>Treasurer</option>
                            </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="image">Photo</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
    
                        </div>
                       </div>

                        
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('baranagay_l_g_u_s.index') }}" class="btn btn-light">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection