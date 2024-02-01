<?php

namespace App\Tests\Form;

use Symfony\Component\Form\Test\TypeTestCase;
use App\Form\TaskType;
use App\Entity\Task;

class TaskTypeTest extends TypeTestCase
{

    public function testSubmitValidData()
    {
        $formData = [
            'title' => 'Test Title',
            'content' => 'Test content',
        ];

        $model = new Task();
        $form = $this->factory->create(TaskType::class, $model);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($model->getTitle(), $formData['title']);
        $this->assertEquals($model->getContent(), $formData['content']);


        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

}
