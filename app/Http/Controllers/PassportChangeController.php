<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use App\Models\PassportChange;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PassportChangeController extends Controller
{
    public function index()
    {
        // Show all passport change records in a table
//        $records = PassportChange::latest()->get();
        $records = PassportChange::orderBy('date', 'desc')->paginate(10);
        return view('passport.index', compact('records'));
    }

    public function create()
    {
        return view('passport.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data = $this->normaliseDates($data);

        // ✅ Normalize checkbox values
        $data['name_changed'] = $request->has('name_changed');
        $data['father_changed'] = $request->has('father_changed');
        $data['mother_changed'] = $request->has('mother_changed');
        $data['dob_changed'] = $request->has('dob_changed');

        $data['nid'] = $request->has('nid');
        $data['brc'] = $request->has('brc');

        PassportChange::create($data);

        return redirect()->route('passport.index')->with('success', 'Record added successfully!');
    }


    public function show(PassportChange $passportChange)
    {
        $signature= Signature::first();
        return view('passport.summary', compact('passportChange','signature'));
    }

    public function edit(PassportChange $passportChange)
    {
        return view('passport.edit', compact('passportChange'));
    }

    public function update(Request $request, PassportChange $passportChange)
    {
        $data = $request->all();

        $data = $this->normaliseDates($data);

        // Convert checkboxes to booleans
        $data['name_changed'] = $request->has('name_changed');
        $data['father_changed'] = $request->has('father_changed');
        $data['mother_changed'] = $request->has('mother_changed');
        $data['dob_changed'] = $request->has('dob_changed');
        $data['nid'] = $request->has('nid');
        $data['brc'] = $request->has('brc');

        $passportChange->update($data);

        return redirect()->route('passport.index')->with('success', 'Record updated successfully!');
    }

    public function print($id)
    {
        $signature = Signature::first();
        $passportChange = PassportChange::findOrFail($id);

        $pdf = Pdf::loadView('passport.summary-print', compact('passportChange', 'signature'))
            ->setPaper('A4', 'portrait');

        // Instead of download(), use stream() for direct preview
        return $pdf->stream('passport_summary.pdf');
    }

    protected function normaliseDates(array $data): array
    {
        $dateFields = [
            'date',
            'new_passport_issue_date',
            'old_dob',
            'new_dob',
        ];

        foreach ($dateFields as $field) {
            if (!array_key_exists($field, $data)) {
                continue;
            }

            $data[$field] = $this->normaliseDateValue($data[$field] ?? null);
        }

        return $data;
    }

    protected function normaliseDateValue($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        $formats = ['d-m-Y', 'Y-m-d'];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $value)->format('Y-m-d');
            } catch (\Throwable $exception) {
                // Try next format
            }
        }

        return null;
    }
}
