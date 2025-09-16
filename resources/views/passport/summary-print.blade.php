@extends('layouts.pdf')

@section('title', 'Passport Change Summary')

@push('styles')
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 0cm 2cm 2cm 2cm;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            font-style: italic;
            color: #1c6b13;
            font-weight: bold;
        }

        .header h5 {
            margin: 0;
            font-size: 12pt;
            font-weight: bold;
        }

        .sub-header {
            text-align: center;
            font-size: 12pt;
            margin-top: 0;
        }

        .content {
            text-align: justify;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
            font-size: 12pt;
        }

        .signature-table td:first-child {
            width: 55%;
        }

        .signature-table td:last-child {
            width: 45%;
        }

        .signature-cell {
            text-align: right;
        }

        .signature-wrapper {
            display: inline-block;
            min-width: 45%;
            margin-top: 60px;
            text-align: right;
        }

        .signature-text {
            display: inline-block;
            text-align: center;
            white-space: nowrap;
            font-weight: bold;
        }

        .signature-name,
        .signature-designation {
            display: block;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            font-size: 10pt;
            text-align: center;
            border-top: 1px solid #1c6b13;
            padding-top: 5px;
            color: #1c6b13;
            font-style: italic;
        }
    </style>
@endpush

@section('content')
<div class="header">
    <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 80px;">
    <h5 style="margin: 0px 80px 0px 80px">High Commission of the People’s Republic of Bangladesh</h5>
    <div class="sub-header">Brunei Darussalam</div>
</div>
<hr style="color:#1c6b13;width: 100%">

<table width="100%" style="margin: 20px 0; font-size: 12pt;">
    <tr>
        <td style="text-align: left;">
            No. BHC/Bru/Cons/CA/{{ date('Y') }}/<strong>{{ $passportChange->serial ?? '___' }}</strong>
        </td>
        <td style="text-align: right;">
            Date: {{ \Carbon\Carbon::parse($passportChange->date ?? now())->format('d F Y') }}
        </td>
    </tr>
</table>

<div class="content">
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
            $oldParts[] = "his name has been mentioned as {$oldName}";
            $newParts[] = "his actual name is <strong>{$newName}</strong>";
        }
        if ($passportChange->father_changed) {
            $oldParts[] = "his father’s name has been mentioned as {$oldFatherName}";
            $newParts[] = "his father’s actual name is <strong>{$newFatherName}</strong>";
        }
        if ($passportChange->mother_changed) {
            $oldParts[] = "his mother’s name has been mentioned as {$oldMotherName}";
            $newParts[] = "his mother’s actual name is <strong>{$newMotherName}</strong>";
        }
        if ($passportChange->dob_changed) {
            $oldParts[] = "his date of birth has been mentioned as " . \Carbon\Carbon::parse($passportChange->old_dob)->format('d F Y') . "";
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

    <p>{!! $text !!}</p>

    <p>02. All concerned are requested to kindly extend necessary cooperation.</p>
</div>

@php
    $signatureName = filled($signature->name ?? null) ? trim($signature->name) : null;
    $signatureDesignation = filled($signature->designation ?? null) ? trim($signature->designation) : null;
@endphp

<table class="signature-table">
    <tr>
        <td></td>
        <td class="signature-cell">
            <div class="signature-wrapper">
                <span class="signature-text">
                    @if ($signatureName)
                        <span class="signature-name">{{ $signatureName }}</span>
                    @endif
                    @if ($signatureDesignation)
                        <span class="signature-designation">{{ $signatureDesignation }}</span>
                    @endif
                    @unless ($signatureName || $signatureDesignation)
                        &nbsp;
                    @endunless
                </span>
            </div>
        </td>
    </tr>
</table>

<footer>
    Lot No. 2469, Simpang-1028, Kampong Tanah Jambu, Jalan Muara, Bandar Seri Begawan, Negara Brunei Darussalam.
    Tel: 673-2342420 Fax: 673-2342421, Web: mission.bandarseribegawan@mofa.gov.bd
</footer>
@endsection
