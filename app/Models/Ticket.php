<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Ticket extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'subject',
        'label',
        'assignee_id',
        'submitter_id',
        'priority',
        'status',
    ];

    public function submitter(){

        return $this->belongsTo(User::class,'submitter_id');
    }

    public function assignee(){

        return $this->belongsTo(User::class,'assignee_id');
    }

    public function comments(){

        return $this->hasMany(Comment::class);

    }

    public function user(){

        return $this->hasMany(User::class, 'id');

    }
}
