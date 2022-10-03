<?php

declare(strict_types=1);

namespace App\Tests\unit\config\fixtures\data_fixtures;

use App\DataFixtures\AppFixtures;
use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class AppFixturesTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function invokeProperty(&$object, $propertyName, $parameter)
    {
        $reflection = new \ReflectionClass(get_class($object));
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $parameter);

        return $object;
    }

    public function testGetDataSets()
    {
        $class = new AppFixtures;

        $result = $this->invokeMethod($class, 'getDataSets');

        self::assertIsArray($result);
    }

    public function testGetFilePathsMethod()
    {
        $class = new AppFixtures;

        $result = $this->invokeMethod($class, 'getFilePaths');

        self::assertIsArray($result);
    }

    public function testCreateQuiz()
    {
        $class = new AppFixtures;

        $data = [
            'title' => 'Test Quiz Title',
            'slug' => 'test-quiz-title'
        ];

        $result = $this->invokeMethod($class, 'CreateQuiz', [$this->entityManager, $data]);

        self::assertInstanceOf("App\Entity\Quiz", $result);
        self::assertEquals("Test Quiz Title", $result->getTitle());
        self::assertEquals("test-quiz-title", $result->getSlug());
    }

    public function testCreateQuestion()
    {
        $class = new AppFixtures;
        $quiz = new Quiz;
        $quiz = $this->invokeProperty($quiz, 'id', 10);

        $data = [
            'content' => 'Test question content',
        ];

        $result = $this->invokeMethod($class, 'CreateQuestion', [$this->entityManager, $data, $quiz]);

        self::assertInstanceOf("App\Entity\Question", $result);
        self::assertInstanceOf("App\Entity\Quiz", $result->getQuiz());
        self::assertEquals(10, $result->getQuiz()->getId());
        self::assertEquals("Test question content", $result->getContent());
    }
}