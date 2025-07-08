<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_case_id',
        'step_number',
        'action',
        'expected_result',
    ];

    public function testCase()
    {
        return $this->belongsTo(TestCase::class);
    }

    public function results()
    {
        return $this->hasMany(TestStepResult::class);
    }
}