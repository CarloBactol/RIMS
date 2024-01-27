@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 " style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Edit Resident</h4>
                        <a href="{{ route('persons.index') }}" class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('persons.update', $resident->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control  @error('firstName') is-invalid @enderror"
                                name="firstName" value="{{ $resident->firstName }}" id="fname" placeholder="firstName">
                            @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                name="lastName" value="{{ $resident->lastName }}" id="lname" placeholder="lastName">
                            @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="address">Address</label>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                name="address" value="{{ $resident->address }}" id="address" placeholder="Address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contactNumber">Phone Number</label>
                            <input type="text" value="{{ $resident->contactNumber }}"
                                class="form-control  @error('contactNumber') is-invalid @enderror" name="contactNumber"
                                id="contactNumber" placeholder="Phone number">
                            @error('contactNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male" {{$resident->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                <option value="Female" {{$resident->gender == 'Female' ? 'selected' : ''}}>Female
                                </option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date Of Birth</label>
                            <input type="date" value="{{ date('Y-m-d', strtotime($resident->dateOfBirth))  }}"
                                class="form-control  @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth"
                                id="dateOfBirth">
                            @error('dateOfBirth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <select name="nationality" class="form-control @error('nationality') is-invalid @enderror">
                                <option value="" selected disabled>Select Nationality</option>
                                <option value="Filipino" {{ $resident->nationality == "Filipino" ? 'selected' : ''
                                    }}>Filipino</option>
                                <option value="Foreign" {{ $resident->nationality == "Foreign" ? 'selected' : ''
                                    }}>Foreign</option>
                            </select>
                            @error('nationality')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="civilStatus">Civil Status</label>
                            <select name="civilStatus" class="form-control @error('civilStatus') is-invalid @enderror">
                                <option value="" selected disabled>Select Civil Status</option>
                                <option value="Single" {{ $resident->civilStatus == "Single" ? 'selected' : '' }}>Single
                                </option>
                                <option value="Married" {{ $resident->civilStatus == "Married" ? 'selected' : ''
                                    }}>Married</option>
                                <option value="Separated" {{ $resident->civilStatus == "Separated" ? 'selected' : ''
                                    }}>Separated</option>
                                <option value="Annulled" {{ $resident->civilStatus == "Annulled" ? 'selected' : ''
                                    }}>Annulled</option>
                            </select>
                            @error('civilStatus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="purpose">Purpose</label>
                            <textarea name="purpose"
                                class="form-control @error('purpose') is-invalid @enderror">{{$resident->purpose}}</textarea>
                            @error('purpose')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" {{ $resident->status ==
                                    1 ? 'checked' : '' }} value="1" name="status" class="form-check-input">
                                    Status
                                    <i class="input-helper"></i></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('persons.index') }}" class="btn btn-light">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection