<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Team extends Model
{
    //
    protected $fillable = ['name','size'];
    public function members()
    {
    	return $this->hasMany(User::class,'team_id');
    }
    public function countMembers()
    {
    	return $this->members()->count();
    }
    public function addMember($user)
    {
    	$method = $user instanceof User ? 'save' : 'saveMany';
    	$this->checkMaxSizeOfTeam();
    	$this->members()->$method($user);
    }
    public function removeMember($user)
    {
    	if($user instanceof User){
    		$user->team_id = null;
    		$user->save();
    	}
    	else{
    		foreach($user as $member){
    			$member->team_id = null;
    			$member->save();
    		}
    	}
    }

    protected function checkMaxSizeOfTeam(){

    	if($this->countMembers() >= $this->size){
    		throw new \Exception;
    	}
    }
}
