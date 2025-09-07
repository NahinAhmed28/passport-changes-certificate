<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'date',
        'old_passport_number',
        'old_name',
        'old_father_name',
        'old_mother_name',
        'old_dob',
        'new_passport_number',
        'new_name',
        'new_father_name',
        'new_mother_name',
        'new_dob',
        'name_changed',
        'father_changed',
        'mother_changed',
        'dob_changed',
        'nid',          // ✅ Add this
        'brc',          // ✅ Add this
        'name',          // ✅ Add this
        'new_passport_issue_date',          // ✅ Add this
    ];

    protected $casts = [
        'name_changed' => 'boolean',
        'father_changed' => 'boolean',
        'mother_changed' => 'boolean',
        'dob_changed' => 'boolean',
        'nid' => 'boolean',  // ✅ Cast as boolean
        'brc' => 'boolean',  // ✅ Cast as boolean
        'new_passport_issue_date' => 'date',  // ✅ Cast properly

    ];
}
