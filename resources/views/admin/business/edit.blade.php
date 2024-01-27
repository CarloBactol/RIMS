@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 " style="margin: 0 auto;">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>Edit Business Permit</h4>
                            <a href="{{ route('business_permits.index') }}" class="btn btn-inverse-primary btn-rounded btn-icon">
                                <i class="ti-arrow-left"></i>
                            </a>
                        </div>
                        <form class="forms-sample" action="{{ route('business_permits.update', $business->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                {{-- <input type="text" id="autosuggestInput" onkeyup="fetchSuggestions()">
                                <ul id="suggestionList"></ul> --}}

                                <label for="fname">Owner Name</label>
                                <select name="residentID" id="" class="form-control @error('residentID') is-invalid @enderror">
                                    @foreach ($businessOwner as $item)
                                    <option value="{{$item->resident->id}}"  {{$item->resident->id == $business->resident->id ? 'selected' : ''}}  class="form-control"> {{Str::lower($item->resident->firstName) . " " . Str::lower($item->resident->lastName)}} </option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" id="dataInput" onchange="sendData()"
                                    class="form-control  @error('firstName') is-invalid @enderror" name="firstName"
                                    value="{{ old('firstName') }}" id="fname" placeholder="firstName"> --}}
                                @error('residentID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="businessName">Business Name</label>
                                <input type="text" class="form-control @error('businessName') is-invalid @enderror"
                                    name="businessName" value="{{ $business->businessName }}" id="businessName"
                                    placeholder="businessName">
                                @error('businessName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="address">Business Address</label>
                                <input type="text" class="form-control  @error('businessAddress') is-invalid @enderror"
                                    name="businessAddress" value="{{ $business->businessAddress }}"
                                    placeholder="Business Address">
                                @error('businessAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('business_permits.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

