<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passport Change Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <h2>Passport Change Form</h2>
    <form action="{{ route('passport.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <!-- Serial & Date -->
        <div class="mb-3">
            <label class="form-label">Serial</label>
            <input type="text" name="serial" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <!-- Passport Numbers (Always Visible) -->
        <h5>Passport Numbers</h5>
        <div class="mb-3">
            <label class="form-label">Old Passport Number</label>
            <input type="text" name="old_passport_number" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">New Passport Number</label>
            <input type="text" name="new_passport_number" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">New Passport Issue Date</label>
            <input type="date" name="new_passport_issue_date" class="form-control">
        </div>

        <!-- Checkboxes -->
        <h5 class="mt-4">Changes</h5>
        <div class="form-check">
            <input class="form-check-input change-toggle" type="checkbox" id="nameChanged" name="name_changed" data-target="nameFields">
            <label class="form-check-label" for="nameChanged">Name Changed</label>
        </div>
        <div class="form-check">
            <input class="form-check-input change-toggle" type="checkbox" id="fatherChanged" name="father_changed" data-target="fatherFields">
            <label class="form-check-label" for="fatherChanged">Father's Name Changed</label>
        </div>
        <div class="form-check">
            <input class="form-check-input change-toggle" type="checkbox" id="motherChanged" name="mother_changed" data-target="motherFields">
            <label class="form-check-label" for="motherChanged">Mother's Name Changed</label>
        </div>
        <div class="form-check">
            <input class="form-check-input change-toggle" type="checkbox" id="dobChanged" name="dob_changed" data-target="dobFields">
            <label class="form-check-label" for="dobChanged">Date of Birth Changed</label>
        </div>

        <!-- Name Fields -->
        <div id="nameFields" class="d-none mt-3">
            <hr>
            <h5>Name Change</h5>
            <div class="mb-3">
                <label class="form-label">Old Name</label>
                <input type="text" name="old_name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">New Name</label>
                <input type="text" name="new_name" class="form-control">
            </div>
        </div>

        <!-- Father Fields -->
        <div id="fatherFields" class="d-none mt-3">
            <hr>
            <h5>Father's Name Change</h5>
            <div class="mb-3">
                <label class="form-label">Old Father's Name</label>
                <input type="text" name="old_father_name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">New Father's Name</label>
                <input type="text" name="new_father_name" class="form-control">
            </div>
        </div>

        <!-- Mother Fields -->
        <div id="motherFields" class="d-none mt-3">
            <hr>
            <h5>Mother's Name Change</h5>
            <div class="mb-3">
                <label class="form-label">Old Mother's Name</label>
                <input type="text" name="old_mother_name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">New Mother's Name</label>
                <input type="text" name="new_mother_name" class="form-control">
            </div>
        </div>

        <!-- DOB Fields -->
        <div id="dobFields" class="d-none mt-3">
            <hr>
            <h5>Date of Birth Change</h5>
            <div class="mb-3">
                <label class="form-label">Old Date of Birth</label>
                <input type="date" name="old_dob" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">New Date of Birth</label>
                <input type="date" name="new_dob" class="form-control">
            </div>
        </div>

        <h5>Verified By :</h5>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="nid" id="nid">
            <label class="form-check-label" for="nid">National Identity Card (NID)</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="brc" id="brc">
            <label class="form-check-label" for="brc">Birth Certificate (BRC)</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<script>
    // Toggle visibility of each field group based on its checkbox
    document.querySelectorAll('.change-toggle').forEach(toggle => {
        toggle.addEventListener('change', () => {
            const targetId = toggle.dataset.target;
            document.getElementById(targetId).classList.toggle('d-none', !toggle.checked);
        });
    });
</script>
</body>
</html>
