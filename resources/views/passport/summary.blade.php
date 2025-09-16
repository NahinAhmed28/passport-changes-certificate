@extends('layouts.app')

@section('title', 'Passport Change Summary')
@section('body-class', 'document-page')

@push('styles')
    <style>
        body.document-page {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            background-color: #f8f9fa;
        }

        .document-card {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            max-width: 900px;
            margin: 0 auto;
        }

        .document-card .logo {
            height: 80px;
        }

        .document-footer {
            border-top: 1px solid #198754;
            color: #198754;
        }
    </style>
@endpush

@section('content')
<div class="container my-5">
    <div class="document-card">
        <div class="text-center mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo mb-2">
            <h4 class="fw-bold text-success mb-0">High Commission of the People’s Republic of Bangladesh</h4>
            <p class="mb-0">Brunei Darussalam</p>
        </div>
        <hr class="border-2 border-success opacity-75">

        <div class="d-flex justify-content-between my-3">
            <div><strong>No.</strong> BHC/Bru/Cons/CA/{{ date('Y') }}/{{ $passportChange->serial ?? '___' }}</div>
            <div><strong>Date:</strong> {{ \Carbon\Carbon::parse($passportChange->date ?? now())->format('d F Y') }}</div>
        </div>

        <div class="mt-4">
            @php
                $text = "This is to certify that ";

                if ($passportChange->new_name) {
                    $text .= "{$passportChange->new_name} ";
                } else {
                    $text .= "this person ";
                }

                if ($passportChange->new_passport_number) {
                    $text .= "bearing Bangladesh passport no. {$passportChange->new_passport_number}";
                    if ($passportChange->new_passport_issue_date) {
                        $text .= " issued on " . \Carbon\Carbon::parse($passportChange->new_passport_issue_date)->format('d F Y');
                    }
                    $text .= ", ";
                }

                $text .= "is a Bangladeshi citizen working in Brunei Darussalam. ";

                if ($passportChange->old_passport_number) {
                    $text .= "In his old passport no. {$passportChange->old_passport_number}, ";
                }

                $oldParts = [];
                $newParts = [];

                if ($passportChange->name_changed) {
                    $oldParts[] = "his name has been mentioned as <strong>{$passportChange->old_name}</strong>";
                    $newParts[] = "his actual name is <strong>{$passportChange->new_name}</strong>";
                }
                if ($passportChange->father_changed) {
                    $oldParts[] = "his father’s name has been mentioned as <strong>{$passportChange->old_father_name}</strong>";
                    $newParts[] = "his father’s actual name is <strong>{$passportChange->new_father_name}</strong>";
                }
                if ($passportChange->mother_changed) {
                    $oldParts[] = "his mother’s name has been mentioned as <strong>{$passportChange->old_mother_name}</strong>";
                    $newParts[] = "his mother’s actual name is <strong>{$passportChange->new_mother_name}</strong>";
                }
                if ($passportChange->dob_changed) {
                    $oldParts[] = "his date of birth has been mentioned as <strong>" . \Carbon\Carbon::parse($passportChange->old_dob)->format('d F Y') . "</strong>";
                    $newParts[] = "his actual date of birth is <strong>" . \Carbon\Carbon::parse($passportChange->new_dob)->format('d F Y') . "</strong>";
                }

                $changeCount = count($oldParts);

                if ($changeCount > 0) {
                    $text .= implode(', ', $oldParts);
                    $text .= $changeCount > 1 ? ", which are not correct. " : ", which is not correct. ";
                    $text .= implode(', ', $newParts) . " as mentioned in ";
                }

                if ($passportChange->nid && $passportChange->brc) {
                    $text .= "his National Identity Card (NID) and Birth Certificate (BRC) issued by the competent authority in Bangladesh.";
                } elseif ($passportChange->nid) {
                    $text .= "his National Identity Card (NID) issued by the competent authority in Bangladesh.";
                } elseif ($passportChange->brc) {
                    $text .= "his Birth Certificate (BRC) issued by the competent authority in Bangladesh.";
                }
            @endphp

            <p class="text-justify">{!! $text !!}</p>

            <p>02. All concerned are requested to kindly extend necessary cooperation.</p>
        </div>

        <div class="row mt-5">
            <div class="col-7"></div>
            <div class="col-5 text-center">
                <p class="fw-bold mb-0">( {{ $signature->name }} )</p>
                <p class="mb-0">{{ $signature->designation }}</p>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('passport.index') }}" class="btn btn-outline-secondary px-4 rounded-pill shadow-sm">⬅ Back</a>
            <a href="{{ route('passport.print', $passportChange->id) }}?download=1" class="btn btn-success px-4 rounded-pill shadow-sm">📄 Download PDF</a>
            <a href="{{ route('passport.print', $passportChange->id) }}" target="_blank" class="btn btn-primary px-4 rounded-pill shadow-sm">🖨 Print PDF</a>
        </div>
    </div>

    <footer class="text-center document-footer pt-3 mt-5 fst-italic small">
        Lot No. 2469, Simpang-1028, Kampong Tanah Jambu, Jalan Muara, Bandar Seri Begawan, Negara Brunei Darussalam.
        Tel: 673-2342420 Fax: 673-2342421 | Email: mission.bandarseribegawan@mofa.gov.bd
    </footer>
</div>
@endsection
