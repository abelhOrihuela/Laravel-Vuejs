<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Candidate;
use App\CandidateEconomic;
class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function candidates()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }


}
