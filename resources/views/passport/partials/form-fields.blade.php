@php
    $model = $passportChange ?? null;

    $value = function (string $field, ?string $format = null) use ($model) {
        $oldValue = old($field);
        if (!is_null($oldValue)) {
            return $oldValue;
        }

        $current = $model?->{$field} ?? null;

        if ($format && $current) {
            try {
                if ($current instanceof \Illuminate\Support\Carbon) {
                    return $current->format($format);
                }

                return \Illuminate\Support\Carbon::parse($current)->format($format);
            } catch (\Throwable $exception) {
                return $current;
            }
        }

        return $current ?? '';
    };

    $checked = function (string $field) use ($model) {
        $oldValue = old($field);
        if (!is_null($oldValue)) {
            return filter_var($oldValue, FILTER_VALIDATE_BOOL);
        }

        return (bool) ($model?->{$field} ?? false);
    };

    $nameFieldsVisible = $checked('name_changed');
    $fatherFieldsVisible = $checked('father_changed');
    $motherFieldsVisible = $checked('mother_changed');
    $dobFieldsVisible = $checked('dob_changed');
@endphp

<div class="mb-3">
    <label for="serial" class="form-label">Serial</label>
    <input type="text" id="serial" name="serial" class="form-control" value="{{ $value('serial') }}">
</div>

<div class="mb-3">
    <label for="date" class="form-label">Date</label>
    <input type="date" id="date" name="date" class="form-control" value="{{ $value('date', 'Y-m-d') }}">
</div>

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" id="name" name="name" class="form-control" value="{{ $value('name') }}">
</div>

<h5 class="mt-4">Passport Numbers</h5>

<div class="mb-3">
    <label for="old_passport_number" class="form-label">Old Passport Number</label>
    <input type="text" id="old_passport_number" name="old_passport_number" class="form-control" value="{{ $value('old_passport_number') }}">
</div>

<div class="mb-3">
    <label for="new_passport_number" class="form-label">New Passport Number</label>
    <input type="text" id="new_passport_number" name="new_passport_number" class="form-control" value="{{ $value('new_passport_number') }}">
</div>

<div class="mb-3">
    <label for="new_passport_issue_date" class="form-label">New Passport Issue Date</label>
    <input type="date" id="new_passport_issue_date" name="new_passport_issue_date" class="form-control" value="{{ $value('new_passport_issue_date', 'Y-m-d') }}">
</div>

<h5 class="mt-4">Changes</h5>

<div class="form-check">
    <input class="form-check-input change-toggle" type="checkbox" id="name_changed" name="name_changed" data-target="nameFields" @checked($nameFieldsVisible)>
    <label class="form-check-label" for="name_changed">Name Changed</label>
</div>
<div id="nameFields" class="mt-3 {{ $nameFieldsVisible ? '' : 'd-none' }}">
    <hr>
    <h5>Name Change</h5>
    <div class="mb-3">
        <label for="old_name" class="form-label">Old Name</label>
        <input type="text" id="old_name" name="old_name" class="form-control" value="{{ $value('old_name') }}">
    </div>
    <div class="mb-3">
        <label for="new_name" class="form-label">New Name</label>
        <input type="text" id="new_name" name="new_name" class="form-control" value="{{ $value('new_name') }}">
    </div>
</div>

<div class="form-check">
    <input class="form-check-input change-toggle" type="checkbox" id="father_changed" name="father_changed" data-target="fatherFields" @checked($fatherFieldsVisible)>
    <label class="form-check-label" for="father_changed">Father's Name Changed</label>
</div>
<div id="fatherFields" class="mt-3 {{ $fatherFieldsVisible ? '' : 'd-none' }}">
    <hr>
    <h5>Father's Name Change</h5>
    <div class="mb-3">
        <label for="old_father_name" class="form-label">Old Father's Name</label>
        <input type="text" id="old_father_name" name="old_father_name" class="form-control" value="{{ $value('old_father_name') }}">
    </div>
    <div class="mb-3">
        <label for="new_father_name" class="form-label">New Father's Name</label>
        <input type="text" id="new_father_name" name="new_father_name" class="form-control" value="{{ $value('new_father_name') }}">
    </div>
</div>

<div class="form-check">
    <input class="form-check-input change-toggle" type="checkbox" id="mother_changed" name="mother_changed" data-target="motherFields" @checked($motherFieldsVisible)>
    <label class="form-check-label" for="mother_changed">Mother's Name Changed</label>
</div>
<div id="motherFields" class="mt-3 {{ $motherFieldsVisible ? '' : 'd-none' }}">
    <hr>
    <h5>Mother's Name Change</h5>
    <div class="mb-3">
        <label for="old_mother_name" class="form-label">Old Mother's Name</label>
        <input type="text" id="old_mother_name" name="old_mother_name" class="form-control" value="{{ $value('old_mother_name') }}">
    </div>
    <div class="mb-3">
        <label for="new_mother_name" class="form-label">New Mother's Name</label>
        <input type="text" id="new_mother_name" name="new_mother_name" class="form-control" value="{{ $value('new_mother_name') }}">
    </div>
</div>

<div class="form-check">
    <input class="form-check-input change-toggle" type="checkbox" id="dob_changed" name="dob_changed" data-target="dobFields" @checked($dobFieldsVisible)>
    <label class="form-check-label" for="dob_changed">Date of Birth Changed</label>
</div>
<div id="dobFields" class="mt-3 {{ $dobFieldsVisible ? '' : 'd-none' }}">
    <hr>
    <h5>Date of Birth Change</h5>
    <div class="mb-3">
        <label for="old_dob" class="form-label">Old Date of Birth</label>
        <input type="date" id="old_dob" name="old_dob" class="form-control" value="{{ $value('old_dob', 'Y-m-d') }}">
    </div>
    <div class="mb-3">
        <label for="new_dob" class="form-label">New Date of Birth</label>
        <input type="date" id="new_dob" name="new_dob" class="form-control" value="{{ $value('new_dob', 'Y-m-d') }}">
    </div>
</div>

<h5 class="mt-4">Verified By</h5>
<div class="form-check">
    <input class="form-check-input" type="checkbox" id="nid" name="nid" @checked($checked('nid'))>
    <label class="form-check-label" for="nid">National Identity Card (NID)</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" id="brc" name="brc" @checked($checked('brc'))>
    <label class="form-check-label" for="brc">Birth Certificate (BRC)</label>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.change-toggle').forEach(function (toggle) {
                    var targetId = toggle.dataset.target;
                    var target = document.getElementById(targetId);

                    if (!target) {
                        return;
                    }

                    var toggleSection = function () {
                        target.classList.toggle('d-none', !toggle.checked);
                    };

                    toggle.addEventListener('change', toggleSection);
                    toggleSection();
                });
            });
        </script>
    @endpush
@endonce
