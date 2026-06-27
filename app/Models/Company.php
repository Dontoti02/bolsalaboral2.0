<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_opportunity_company';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'ruc',
        'email',
        'phone',
        'mailbox',
        'is_verified',
        'description',
        'website',
        'address',
        'logo',
    ];

    /**
     * Get the users for the company.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }
}
