<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'version',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function testCases()
    {
        return $this->hasMany(TestCase::class);
    }

    public function executions()
    {
        return $this->hasMany(TestExecution::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-red-100 text-red-800',
            'maintenance' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'active' => 'Ativo',
            'inactive' => 'Inativo',
            'maintenance' => 'Manutenção',
            default => $this->status
        };
    }
}