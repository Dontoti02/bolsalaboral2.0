<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'document_type',
        'document_number',
        'names',
        'phone',
        'email',
        'sex',
        'birth_date',
        'native_language',
    ];

    /**
     * Get the users associated with this person record.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'person_id');
    }
}
