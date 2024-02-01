<?php

namespace App\Tests\Form;

use Symfony\Component\Form\Test\TypeTestCase;
use App\Form\UserType;
use App\Entity\User;

class UserTypeTest extends TypeTestCase
{

    public function testSubmitValidDataEditModeFalse()
    {
        $formData = [
            'username' => 'TestUser',
            'password' => [
                'first' => 'password',
                'second' => 'password',
            ],
            'email' => 'test@example.com',
        ];

        $model = new User();

        $form = $this->factory->create(UserType::class, $model, ['edit_mode' => false]);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($model->getUsername(), $formData['username']);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }

        $this->assertArrayNotHasKey('roles', $children);
    }


    public function testSubmitValidDataEditModeTrue()
    {
        $formData = [
            'username' => 'TestUser',
            'password' => [
                'first' => 'password',
                'second' => 'password',
            ],
            'email' => 'test@example.com',
            'roles' => ['ROLE_ADMIN'],
        ];

        $model = new User();

        $form = $this->factory->create(UserType::class, $model, ['edit_mode' => true]);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($model->getUsername(), $formData['username']);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }

        $this->assertArrayHasKey('roles', $children);
    }

}
