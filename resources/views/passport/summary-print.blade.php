<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

        .ref-date {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            font-size: 12pt;
        }

        .content {
            text-align: justify;
        }

        .signature {
            margin-top: 60px;
        }

        .signature p {
            margin: 0;
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
            color:#1c6b13 ;
            font-style: italic;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 80px;">
    <h5 style="margin: 0px 80px 0px 80px">High Commission of the People’s Republic of Bangladesh</h5>
    <div class="sub-header">Brunei Darussalam</div>
</div>
<hr style="color:#1c6b13;width: 100%">
<!-- Reference and Date -->
<table width="100%" style="margin: 20px 0; font-size: 12pt;">
    <tr>
        <td style="text-align: left;">
            No. BHC/Bru/Cons/CA/{{ date('Y') }}/{{ $passportChange->serial ?? '___' }}
        </td>
        <td style="text-align: right;">
            Date: {{ \Carbon\Carbon::parse($passportChange->date ?? now())->format('d F Y') }}
        </td>
    </tr>
</table>


<!-- Main Paragraph -->
<div class="content">
    <p>
    @php
        $text = "This is to certify that ";

        // Name (just display, don't bold)
        if ($passportChange->new_name) {
            $text .= "{$passportChange->new_name} ";
        } else {
            $text .= "this person ";
        }

        // Passport number and issue date (normal, not bold)
        if ($passportChange->new_passport_number) {
            $text .= "bearing Bangladesh passport no. {$passportChange->new_passport_number}";
            if ($passportChange->new_passport_issue_date) {
                $text .= " issued on " . \Carbon\Carbon::parse($passportChange->new_passport_issue_date)->format('d F Y');
            }
            $text .= ", ";
        }

        $text .= "is a Bangladeshi citizen working in Brunei Darussalam. ";

        // Old passport
        if ($passportChange->old_passport_number) {
            $text .= "In his old passport no. {$passportChange->old_passport_number}, ";
        }

        // Only bold changed info (name, father, mother, DOB)
        $oldParts = [];
        $newParts = [];

        if ($passportChange->name_changed) {
            $oldParts[] = "his name has been mentioned as {$passportChange->old_name}";
            $newParts[] = "his actual name is <strong>{$passportChange->new_name}</strong>";
        }
        if ($passportChange->father_changed) {
            $oldParts[] = "his father’s name has been mentioned as {$passportChange->old_father_name}";
            $newParts[] = "his father’s actual name is <strong>{$passportChange->new_father_name}</strong>";
        }
        if ($passportChange->mother_changed) {
            $oldParts[] = "his mother’s name has been mentioned as {$passportChange->old_mother_name}";
            $newParts[] = "his mother’s actual name is <strong>{$passportChange->new_mother_name}</strong>";
        }
        if ($passportChange->dob_changed) {
            $oldParts[] = "his date of birth has been mentioned as " . \Carbon\Carbon::parse($passportChange->old_dob)->format('d F Y') . "";
            $newParts[] = "his actual date of birth is <strong>" . \Carbon\Carbon::parse($passportChange->new_dob)->format('d F Y') . "</strong>";
        }

        if (count($oldParts) > 0) {
            $text .= implode(', ', $oldParts) . ", which are not correct. ";
            $text .= implode(', ', $newParts) . " as mentioned in ";
        }

        // NID and BRC (normal text)
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

<!-- Signature -->
<table width="100%" style="margin-top: 50px; font-size: 12pt;">
    <tr>
        <!-- Wide empty column -->
        <td style="width: 60%;"></td>

        <!-- Signature column -->
        <td style="width: 40%; text-align: center;">
            <div class="signature">
                <p> {{ ($signature->name) }}</p>
                <p>{{ $signature->designation }}</p>
            </div>
        </td>
    </tr>
</table>


<!-- Footer -->
<footer>
    Lot No. 2469, Simpang-1028, Kampong Tanah Jambu, Jalan Muara, Bandar Seri Begawan, Negara Brunei Darussalam.
    Tel: 673-2342420 Fax: 673-2342421, Web: mission.bandarseribegawan@mofa.gov.bd
</footer>

</body>
</html>
