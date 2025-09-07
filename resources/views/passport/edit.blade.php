<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Passport Change</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="card p-4 shadow-sm">
        <h3>Edit Passport Change</h3>
        <form action="{{ route('passport.update', $passportChange->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Serial</label>
                <input type="text" name="serial" class="form-control" value="{{ old('serial', $passportChange->serial) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $passportChange->date) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Old Passport Number</label>
                <input type="text" name="old_passport_number" class="form-control" value="{{ old('old_passport_number', $passportChange->old_passport_number) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">New Passport Number</label>
                <input type="text" name="new_passport_number" class="form-control" value="{{ old('new_passport_number', $passportChange->new_passport_number) }}">
            </div>

            <!-- Name Changed -->
            <div class="form-check mb-2">
                <input class="form-check-input change-toggle" type="checkbox" name="name_changed" id="name_changed" data-target="nameFields" {{ $passportChange->name_changed ? 'checked' : '' }}>
                <label class="form-check-label" for="name_changed">Name Changed</label>
            </div>
            <div id="nameFields" class="{{ $passportChange->name_changed ? '' : 'd-none' }} mb-3">
                <input type="text" name="old_name" placeholder="Old Name" class="form-control mb-2" value="{{ old('old_name', $passportChange->old_name) }}">
                <input type="text" name="new_name" placeholder="New Name" class="form-control" value="{{ old('new_name', $passportChange->new_name) }}">
            </div>

            <!-- Father Changed -->
            <div class="form-check mb-2">
                <input class="form-check-input change-toggle" type="checkbox" name="father_changed" id="father_changed" data-target="fatherFields" {{ $passportChange->father_changed ? 'checked' : '' }}>
                <label class="form-check-label" for="father_changed">Father's Name Changed</label>
            </div>
            <div id="fatherFields" class="{{ $passportChange->father_changed ? '' : 'd-none' }} mb-3">
                <input type="text" name="old_father_name" placeholder="Old Father's Name" class="form-control mb-2" value="{{ old('old_father_name', $passportChange->old_father_name) }}">
                <input type="text" name="new_father_name" placeholder="New Father's Name" class="form-control" value="{{ old('new_father_name', $passportChange->new_father_name) }}">
            </div>

            <!-- Mother Changed -->
            <div class="form-check mb-2">
                <input class="form-check-input change-toggle" type="checkbox" name="mother_changed" id="mother_changed" data-target="motherFields" {{ $passportChange->mother_changed ? 'checked' : '' }}>
                <label class="form-check-label" for="mother_changed">Mother's Name Changed</label>
            </div>
            <div id="motherFields" class="{{ $passportChange->mother_changed ? '' : 'd-none' }} mb-3">
                <input type="text" name="old_mother_name" placeholder="Old Mother's Name" class="form-control mb-2" value="{{ old('old_mother_name', $passportChange->old_mother_name) }}">
                <input type="text" name="new_mother_name" placeholder="New Mother's Name" class="form-control" value="{{ old('new_mother_name', $passportChange->new_mother_name) }}">
            </div>

            <!-- DOB Changed -->
            <div class="form-check mb-2">
                <input class="form-check-input change-toggle" type="checkbox" name="dob_changed" id="dob_changed" data-target="dobFields" {{ $passportChange->dob_changed ? 'checked' : '' }}>
                <label class="form-check-label" for="dob_changed">Date of Birth Changed</label>
            </div>
            <div id="dobFields" class="{{ $passportChange->dob_changed ? '' : 'd-none' }} mb-3">
                <input type="date" name="old_dob" class="form-control mb-2" value="{{ old('old_dob', $passportChange->old_dob) }}">
                <input type="date" name="new_dob" class="form-control" value="{{ old('new_dob', $passportChange->new_dob) }}">
            </div>

            <h5>Verified By :</h5>

            <!-- NID / BRC -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="nid" id="nid" {{ $passportChange->nid ? 'checked' : '' }}>
                <label class="form-check-label" for="nid">National Identity Card (NID)</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="brc" id="brc" {{ $passportChange->brc ? 'checked' : '' }}>
                <label class="form-check-label" for="brc">Birth Certificate (BRC)</label>
            </div>


            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('passport.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

</body>
<script>
    document.querySelectorAll('.change-toggle').forEach(toggle => {
        toggle.addEventListener('change', () => {
            const targetId = toggle.dataset.target;
            const target = document.getElementById(targetId);
            if(toggle.checked){
                target.classList.remove('d-none');
            } else {
                target.classList.add('d-none');
            }
        });
    });
</script>

</html>
