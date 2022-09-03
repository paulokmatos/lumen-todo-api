<?php

namespace Features\app\Http\Controllers;

use App\Models\Todo;
use Laravel\Lumen\Testing\DatabaseMigrations;

class TodoControllerTest extends  \TestCase
{
    use DatabaseMigrations;

    public function testUserCanListTodos() {
        //Prepare
        Todo::factory(5)->create();
        //Act
        $response = $this->get('/todos');

        $response->assertResponseOk();
        $response->seeJsonStructure(['current_page']);
        //Assert
    }

    public function testUserCanCreateATodo() {
//    Prepare
        $payload = [
            'title' => 'Tirar o lixo',
            'description' => 'Não esquecer de tirar o lixo as 11:00h AM'
        ];
//    Act
        $result = $this->post('/todos', $payload);

//    Assert
    $result->assertResponseStatus(201);
    $result->seeInDatabase('todos', $payload);

    }

    public  function testUserShouldSendTitleAndDescription() {
        //Prepare
        $payload = [
            'varios' => 'nada'
        ];
        //Act
        $response = $this->post('/todos', $payload); //422 Unprocessable Entity
        //Assert
        $response->assertResponseStatus(422);


    }

    public function testUserCanRetreaveAnSpecificTodo() {
        $todo = Todo::factory()->create();

        //Act
        $uri = '/todos/' . $todo->id;
        $response = $this->get($uri);

        //Assert
        $response->assertResponseOk();
        $response->seeJsonContains(['title' => $todo->title]);
    }

    public function testUserShouldReceiveStatus404WhenSearchForSomethingThatNoExists() {
        //Prepare

        //Act
        $response = $this->get('todos/1');
        //Assert
        $response->assertResponseStatus(404);
        $response->seeJsonContains(['error' => 'not found']);
    }

    public function testUserCanDeleteATodo() {
        //Prepare
        $model = Todo::factory()->create();
        //Act
        $response = $this->delete('/todos/' . $model->id);
        //Assert
        $response->assertResponseStatus(204); // 204 = No Content
        $response->notSeeInDatabase('todos', [
            'id' => $model->id
        ]);
    }

    public function testUserCanSetTodoDone() {
        //Prepare
        $model = Todo::factory()->create();
        //Act
        $response = $this->post('/todos/' . $model->id . '/status/done');
        //Assert
        $response->assertResponseStatus(200);
        $response->seeInDatabase('todos', [
            'id' => $model->id,
            'done' => true
        ]);
    }

    public function testUserCanSetTodoUndone() {
        //Prepare
        $model = Todo::factory()->create(['done' => true]);
        //Act
        $response = $this->post('/todos/' . $model->id . '/status/undone');
        //Assert
        $response->assertResponseStatus(200);
        $response->seeInDatabase('todos', [
            'id' => $model->id,
            'done' => false
        ]);
    }
}
