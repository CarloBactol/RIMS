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
                    <form class="forms-sample" action="{{ route('blotters.update', $blotter->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">

                            <label for="fname">Person Name</label>
                            <select name="residentID" id="" disabled
                                class="form-control @error('residentID') is-invalid @enderror">
                                @foreach ($resident as $item)
                                <option value="{{$item->id}}" {{ $item->id == $blotter->residentID ? '
                                    selected' : '' }}
                                    class="form-control {{ $item->isBlotter == '1' ? 'text-danger' : '' }}">
                                    {{Str::upper($item->lastName) . ", "
                                    . Str::upper($item->firstName)}} </option>
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
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="" cols="30" rows="10">{{ $blotter->description }}
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