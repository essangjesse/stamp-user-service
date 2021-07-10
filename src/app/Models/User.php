<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'avatar',
        'email',
        'password',
        'phone_number',
        'gender',
        'corps_member_id',
        'place_of_deployment',
        'batch',
        'next_of_kin',
        'next_of_kin_phone',
        'is_admin',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'is_admin'
    ];

    public function getFirstNameAttribute($value){
      return ucwords($value);
    }

    public function setFirstNameAttribute($value){
      return $this->attributes['first_name'] = strtolower(trim($value));
    }

    public function getMiddleNameAttribute($value){
      return ucwords($value);
    }

    public function setMiddleNameAttribute($value){
      return $this->attributes['middle_name'] = strtolower(trim($value));
    }

    public function getLastNameAttribute($value){
      return ucwords($value);
    }

    public function setLastNameAttribute($value){
      return $this->attributes['last_name'] = strtolower(trim($value));
    }

    public function getGenderAttribute($value){
      return ucwords($value);
    }

    public function setGenderAttribute($value){
      return $this->attributes['gender'] = strtolower(trim($value));
    }

    public function getPlaceOfDeploymentAttribute($value){
      return ucwords($value);
    }

    public function setCorpsMemberIdAttribute($value){
      return $this->attributes['corps_member_id'] = strtolower(trim($value));
    }

    public function getCorpsMemberIdAttribute($value){
      return strtoupper($value);
    }

    public function setPlaceOfDeploymentAttribute($value){
      return $this->attributes['place_of_deployment'] = strtolower(trim($value));
    }

    public function getBatchAttribute($value){
      return ucwords($value);
    }

    public function setBatchAttribute($value){
      return $this->attributes['batch'] = strtolower(trim($value));
    }

    public function setEmailAttribute($value){
      return $this->attributes['email'] = strtolower(trim($value));
    }

    public function setPhoneNumberAttribute($value){
      return $this->attributes['phone_number'] = trim($value);
    }

    public function getCreatedAtAttribute($value){
      return Carbon::parse($value)->format('H:iA Y-m-d');
    }

    public function location(){
      return $this->hasOne(Location::class);
    }
}
