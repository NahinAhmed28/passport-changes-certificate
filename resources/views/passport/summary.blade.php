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

        .signature-block {
            margin-left: auto;
            min-width: 45%;
            text-align: right;
        }

        .signature-text {
            display: inline-block;
            text-align: center;
        }

        .signature-line {
            display: block;
            white-space: nowrap;
        }

        .signature-name {
            font-weight: bold;
        }

        .signature-designation {
            margin-top: 2px;
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
            <div><strong>No.</strong> BHC/Bru/Cons/CA/{{ date('Y') }}/<strong>{{ $passportChange->serial ?? '___' }}</strong> </div>
            <div><strong>Date:</strong> {{ \Carbon\Carbon::parse($passportChange->date ?? now())->format('d F Y') }}</div>
        </div>

        <div class="mt-4">
            @php
                $formatName = static function (?string $value) {
                    if ($value === null) {
                        return null;
                    }

                    $value = trim($value);

                    return $value === '' ? null : \Illuminate\Support\Str::title($value);
                };

                $formatPassportNumber = static function (?string $value) {
                    if ($value === null) {
                        return null;
                    }

                    $value = trim($value);

                    return $value === '' ? null : \Illuminate\Support\Str::upper($value);
                };

                $newName = $formatName($passportChange->new_name ?? null);
                $oldName = $formatName($passportChange->old_name ?? null);
                $newFatherName = $formatName($passportChange->new_father_name ?? null);
                $oldFatherName = $formatName($passportChange->old_father_name ?? null);
                $newMotherName = $formatName($passportChange->new_mother_name ?? null);
                $oldMotherName = $formatName($passportChange->old_mother_name ?? null);
                $newPassportNumber = $formatPassportNumber($passportChange->new_passport_number ?? null);
                $oldPassportNumber = $formatPassportNumber($passportChange->old_passport_number ?? null);

                $text = "This is to certify that ";

                if ($newName) {
                    $text .= "{$newName} ";
                } else {
                    $text .= "this person ";
                }

                if ($newPassportNumber) {
                    $text .= "bearing Bangladesh passport no. {$newPassportNumber}";
                    if ($passportChange->new_passport_issue_date) {
                        $text .= " issued on " . \Carbon\Carbon::parse($passportChange->new_passport_issue_date)->format('d F Y');
                    }
                    $text .= ", ";
                }

                $text .= "is a Bangladeshi citizen working in Brunei Darussalam. ";

                if ($oldPassportNumber) {
                    $text .= "In his old passport no. {$oldPassportNumber}, ";
                }

                $oldParts = [];
                $newParts = [];

                if ($passportChange->name_changed) {
                    $oldParts[] = "his name has been mentioned as <strong>{$oldName}</strong>";
                    $newParts[] = "his actual name is <strong>{$newName}</strong>";
                }
                if ($passportChange->father_changed) {
                    $oldParts[] = "his father’s name has been mentioned as <strong>{$oldFatherName}</strong>";
                    $newParts[] = "his father’s actual name is <strong>{$newFatherName}</strong>";
                }
                if ($passportChange->mother_changed) {
                    $oldParts[] = "his mother’s name has been mentioned as <strong>{$oldMotherName}</strong>";
                    $newParts[] = "his mother’s actual name is <strong>{$newMotherName}</strong>";
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

        @php
            $signatureName = filled($signature->name ?? null) ? trim((string) $signature->name) : null;
            $signatureDesignation = filled($signature->designation ?? null) ? trim((string) $signature->designation) : null;

            if ($signatureName === '') {
                $signatureName = null;
            }

            if ($signatureDesignation === '') {
                $signatureDesignation = null;
            }

        @endphp

        <div class="d-flex justify-content-end mt-5">
            <div class="signature-block">
                <div class="signature-text">
                    @if ($signatureName)
                        <span class="signature-line signature-name">( {{ $signatureName }} )</span>
                    @endif

                    @if ($signatureDesignation)
                        <span class="signature-line signature-designation">{{ $signatureDesignation }}</span>
                    @endif

                    @if (! $signatureName && ! $signatureDesignation)
                        <span class="signature-line">&nbsp;</span>
                    @endif
                </div>

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
