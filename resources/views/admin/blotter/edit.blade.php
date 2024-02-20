@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 " style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Create Blotter</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('blotters.index') }}" class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('blotters.update', $blotters->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="fname">Complainant Name</label>
                            <select name="complainant_id" id=""
                                class="form-control @error('complainant_id') is-invalid @enderror">
                                <option  value="" disabled>Select Complainant</option>
                            
                                @foreach ($people as $item)
                                <option value="{{ $item->id }}" {{ $blotters->complainant_id == $item->id ? "selected" : "" }}
                                    class="form-control">
                                    {{Str::upper($item->lastName) . ", " . Str::ucfirst($item->middleName) . " "
                                    . Str::ucfirst($item->firstName)}} </option>
                                @endforeach
                            </select>
                            @error('complainant_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fname">Respondent Name</label>
                            <select name="respondent_id" id=""
                                class="form-control @error('respondent_id') is-invalid @enderror">
                                <option selected value="" disabled>Select Respondent</option>
                                @foreach ($people as $item)
                                <option value="{{$item->id}}" {{ $blotters->respondent_id == $item->id ? "selected" : "" }}
                                    class="form-control">
                                    {{Str::upper($item->lastName) . ", " . Str::ucfirst($item->middleName) . " "
                                    . Str::ucfirst($item->firstName)}} </option>
                                @endforeach
                            </select>
                            @error('respondent_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="" cols="30" rows="10">{{$blotters->description }}
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('blotters.index') }}" class="btn btn-light">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection