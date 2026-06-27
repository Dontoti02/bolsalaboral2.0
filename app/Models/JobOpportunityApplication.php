<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOpportunityApplication extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_opportunity_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'fullname',
        'program_study',
        'message',
        'status',
        'cv',
        'feedback',
        'feedback_date',
        'offer_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'feedback_date' => 'datetime',
    ];

    /**
     * Get the job offer associated with the application.
     */
    public function offer()
    {
        return $this->belongsTo(JobOpportunityOffer::class, 'offer_id');
    }

    /**
     * Get the user who applied.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
