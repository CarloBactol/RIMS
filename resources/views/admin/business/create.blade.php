@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 " style="margin: 0 auto;">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>Register Business Permit</h4>
                            {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                            <a href="{{ route('business_permits.index') }}" class="btn btn-inverse-primary btn-rounded btn-icon">
                                <i class="ti-arrow-left"></i>
                            </a>
                        </div>
                        <form class="forms-sample" action="{{ route('business_permits.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                {{-- <input type="text" id="autosuggestInput" onkeyup="fetchSuggestions()">
                                <ul id="suggestionList"></ul> --}}

                                <label for="fname">Owner Name</label>
                                <select name="residentID" id="" class="form-control @error('residentID') is-invalid @enderror">
                                    @foreach ($residents as $item)
                                    <option value="{{$item->id}}" class="form-control"> {{Str::lower($item->firstName) . " " . Str::lower($item->lastName)}} </option>
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
                                    name="businessName" value="{{ old('businessName') }}" id="businessName"
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
                                    name="businessAddress" value="{{ old('businessAddress') }}"
                                    placeholder="Business Address">
                                @error('businessAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" value="1" name="status" class="form-check-input">
                                        Status
                                        <i class="input-helper"></i></label>
                                </div>
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
@section('scripts')
    {{-- <script>
        function handleKeyUp(event) {
            if (event.key === 'Enter') {
                fetchSuggestions();
            }
        }

        function fetchSuggestions() {
            const query = document.getElementById('autosuggestInput').value;

            fetch(`/admin/autosuggest?query=${query}`)
                .then(response => response.json())
                .then(data => displaySuggestions(data));
        }

        function displaySuggestions(suggestions) {
            const suggestionList = document.getElementById('suggestionList');
            suggestionList.innerHTML = '';

            suggestions.forEach(suggestion => {
                const li = document.createElement('li');
                li.textContent = suggestion.firstName + " " + suggestion
                    .lastName; // Change to the actual column you want to display
                suggestionList.appendChild(li);
            });
        }
    </script> --}}
@endsection
