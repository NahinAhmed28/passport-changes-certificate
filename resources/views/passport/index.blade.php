<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passport Change Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <h2 class="mb-2 mb-md-0">Passport Change Records</h2>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('passport.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Add New
            </a>
            <a href="{{ route('signature.edit') }}" class="btn btn-outline-secondary">
                <i class="bi bi-pencil-square"></i> Update Certificate Signature
            </a>
        </div>
    </div>


@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Serial</th>
            <th>Date</th>
            <th>Old Passport No</th>
            <th>New Passport No</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->serial }}</td>
                <td>{{ $record->date }}</td>
                <td>{{ $record->old_passport_number }}</td>
                <td>{{ $record->new_passport_number }}</td>
                <td>
                    <a href="{{ route('passport.show', $record->id) }}" class="btn btn-sm btn-info">Details</a>
                    <a href="{{ route('passport.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No records found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <!-- Pagination links -->
    <div class="d-flex justify-content-center">
        {{ $records->links('pagination::bootstrap-5') }}
    </div>
</div>
</body>
</html>
