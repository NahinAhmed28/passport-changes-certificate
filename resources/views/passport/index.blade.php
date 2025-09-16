@extends('layouts.app')

@section('title', 'Passport Change Records')

@section('content')
<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <h2 class="mb-0">Passport Change Records</h2>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('passport.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i> Add New
            </a>
            <a href="{{ route('signature.edit') }}" class="btn btn-outline-secondary">
                <i class="bi bi-pencil-square me-2"></i> Update Certificate Signature
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-striped align-middle mb-0">
            <thead class="table-light">
            <tr>
                <th scope="col" style="width: 60px;">#</th>
                <th scope="col">Serial</th>
                <th scope="col">Date</th>
                <th scope="col">Old Passport No</th>
                <th scope="col">New Passport No</th>
                <th scope="col" class="text-center" style="width: 200px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($records as $record)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $record->serial }}</td>
                    <td>{{ $record->date?->format('d-m-Y') }}</td>
                    <td>{{ $record->old_passport_number }}</td>
                    <td>{{ $record->new_passport_number }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('passport.show', $record->id) }}" class="btn btn-sm btn-info text-white">
                                Details
                            </a>
                            <a href="{{ route('passport.edit', $record->id) }}" class="btn btn-sm btn-warning text-white">
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $records->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
