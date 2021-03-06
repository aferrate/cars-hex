<?php

namespace App\Tests\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;

abstract class AbstractTest extends KernelTestCase
{
    protected $entityManager;

    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);

        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    protected function service($id)
    {
        return self::$container->get($id);
    }
}