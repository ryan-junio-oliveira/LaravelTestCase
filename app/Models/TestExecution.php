<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestExecution extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_case_id',
        'system_id',
        'executed_by',
        'status',
        'notes',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function testCase()
    {
        return $this->belongsTo(TestCase::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function results()
    {
        return $this->hasMany(TestStepResult::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'passed' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'running' => 'bg-blue-100 text-blue-800',
            'blocked' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'passed' => 'Aprovado',
            'failed' => 'Reprovado',
            'running' => 'Executando',
            'blocked' => 'Bloqueado',
            default => 'Pendente'
        };
    }
}