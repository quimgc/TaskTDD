<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use PhpParser\Builder\Use_;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewUsersTasks extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_user_can_see_is_own_tasks()
    {

        //Preparar test

        $user = factory(User::class)->create();
        $tasks = factory(Task::class,5) -> create();

        $user->tasks()->saveMany($tasks);


        //Executar codi

        $this->withoutExceptionHandling();

        $response = $this->get('user/'.$user->id.'/tasks');

        //$response->dump();

        //Comprovacions
        $response->assertSuccessful();
        $response->assertViewIs('user_tasks');
        $response->assertViewHas('tasks',$user->tasks);
        $response->assertViewHas('user',$user);

        $response->assertSeeText($user->name . ' Tasks:');

        foreach ($tasks as $task) {
            $response->assertSeeText($task->name);
        }


//
//        $response->assertSeeText($tasks[0]->name);
//        $response->assertSeeText($tasks[1]->name);
//        $response->assertSeeText($tasks[2]->name);
//        $response->assertSeeText($tasks[3]->name);
//        $response->assertSeeText($tasks[4]->name);
//
//        // return view['user_tasks'];



    }
}
