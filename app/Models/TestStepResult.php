<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStepResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_execution_id',
        'test_step_id',
        'status',
        'actual_result',
        'notes',
    ];

    public function execution()
    {
        return $this->belongsTo(TestExecution::class, 'test_execution_id');
    }

    public function step()
    {
        return $this->belongsTo(TestStep::class, 'test_step_id');
    }
}