@extends('layouts.app')

@section('title', 'Edit Passport Change')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-4">Edit Passport Change</h3>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('passport.update', $passportChange->id) }}" method="POST">
                        @csrf

                        @include('passport.partials.form-fields', ['passportChange' => $passportChange])

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn btn-success px-4">Update</button>
                            <a href="{{ route('passport.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
