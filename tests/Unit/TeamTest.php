<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Team;
use App\User;

class TeamTest extends TestCase
{
	use RefreshDatabase;
	
	 /** @test */
    public function a_team_has_a_name()
    {
    	$team = Team::create(['name'=>'Ahly',5]);

    	$this->assertEquals('Ahly', $team->name);
    }
    /** @test */
    public function a_team_can_add_memebers()
    {
    	$team = factory(Team::class)->create();

    	$user1 = factory(User::class)->create();
    	$user2 = factory(User::class)->create();
    	$team->addMember($user1);
    	$team->addMember($user2);

    	$this->assertEquals(2, $team->countMembers());
    }
    /** @test */
    public function a_team_has_maximum_size()
    {
    	$team = factory(Team::class)->create(['size'=>2]);

    	$user1 = factory(User::class)->create();
    	$user2 = factory(User::class)->create();
    	$user3 = factory(User::class)->create();
    	$team->addMember($user1);
    	$team->addMember($user2);

    	$this->expectException(\Exception::class);

    	$team->addMember($user3);

    	$this->assertEquals(2, $team->countMembers());
    }

    /** @test */
    public function a_team_can_add_multipul_members()
    {
    	$team = factory(Team::class)->create();
    	$usersToAdd = factory(User::class,2)->create();
    	$team->addMember($usersToAdd);

    	$this->assertEquals(2, $team->countMembers());
    }
    //TODO 	
    /** @test */
    public function a_team_can_can_remove_a_member()
    {
    	 $team = factory(Team::class)->create();
    	 $user = factory(User::class)->create();
    	 $team->addMember($user);
    	 $teamCountBeforeRemove = $team->countMembers();
    	 $team->removeMember($user);
    	 $teamCountAfterRemove = $team->countMembers();

    	 $userStillInTeam = $user->team_id == $team->id ? true : false;
    	 $this->assertEquals(false,$userStillInTeam);
    	 $this->assertEquals($teamCountBeforeRemove-1,$teamCountAfterRemove);

    }
	//TODO 
    /** @test */
    public function a_team_can_remove_all_memebers_at_once()
    {
    	 $team =  factory(Team::class)->create();
    	 $users = factory(User::class,2)->create();
    	 $team->addMember($users);
    	 $team->removeMember($users);

    	 //check if one of them still in the team
    	 $allRemoved = true;
    	 $membersCount = $team->countMembers();
    	 foreach ($users as $member) {
    	 	if($team->id == $member->team_id)
    	 		$allRemoved = false;
    	 }
    	 $this->assertEquals(true, $allRemoved);
    	 $this->assertEquals(0, $membersCount);

    }
}
