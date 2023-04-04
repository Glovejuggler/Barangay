<?php

namespace App\Models;

use App\Models\Barangay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'barangay_id', 'address'
    ];

    protected $appends = [
        'full_name', 'complete_address', 'barangay_number'
    ];

    public function getFullNameAttribute()
    {
        return $this->middle_name ?
            $this->first_name.' '.$this->middle_name.' '.$this->last_name :
            $this->first_name.' '.$this->last_name;
    }

    public function getCompleteAddressAttribute()
    {
        return $this->address.' Brgy. '.$this->barangay->name.', Calauan, Laguna';
    }

    public function getBarangayNumberAttribute()
    {
        return sprintf('%02d', $this->barangay_id).'-'.sprintf('%06d', $this->id);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name','like','%'.$search.'%')
                    ->orwhere('middle_name','like','%'.$search.'%')
                    ->orwhere('last_name','like','%'.$search.'%');
            });
        });
    }
}
