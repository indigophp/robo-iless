<?php

namespace Robo\Task\ILess\Test;

use Robo\Task\ILess\CompileLessTask;
use Robo\Task\ILess\loadTasks;

/**
 * This class tests the CompileLessTask class, and does not intend to test if
 * the CSS output we get is well compiled.
 *
 * @author Tamás Barta <barta.tamas.d@gmail.com>
 * @package indigophp/robo-iless
 */
class CompileLessTaskTest extends \PHPUnit_Framework_TestCase
{
    use loadTasks;

    /**
     * @var Robo\Task\ILess\CompileLessTask
     */
    private $task;

    public function setUp()
    {
        // If no build dir, create it
        is_dir('build') || mkdir('build');

        // One instance of task per test
        $this->task = $this->taskCompileLess([]);
    }

    public function testMethodChaining()
    {
        $this->assertSame($this->task, $this->task->paths([]));
        $this->assertSame($this->task, $this->task->addPaths([]));
        $this->assertSame($this->task, $this->task->importDirs([]));
        $result = $this->task->run();
        $this->assertInstanceOf('\Robo\Result', $result);
        $this->assertTrue($result->wasSuccessful(), 'The task must be run successfully');
    }

    public function testFail()
    {
        $this->task->importDirs([]);
        $this->task->paths([
            'build' . DIRECTORY_SEPARATOR . 'nowhere.css' => 'build' . DIRECTORY_SEPARATOR . 'nowhere.less'
        ]);
        $result = $this->task->run();
        $this->assertInstanceOf('\Robo\Result', $result);
        $this->assertFalse($result->wasSuccessful(), 'The task must be run with errors');
    }

    /**
     * Not trying to overcomplicate things. Only testing that the given input
     * produces the given output, not the whole LESS specification.
     *
     * @return void
     */
    public function testCompile()
    {
        $this->task->paths(array_combine(
            [
                'build' . DIRECTORY_SEPARATOR . 'style.css',
            ],
            [
                'resources' . DIRECTORY_SEPARATOR . 'less' . DIRECTORY_SEPARATOR . 'style.less',
            ]
        ));
        $this->task->importDirs([
            'resources' . DIRECTORY_SEPARATOR . 'import',
        ]);

        $result = $this->task->run();
        $this->assertInstanceOf('\Robo\Result', $result);
        $this->assertTrue($result->wasSuccessful(), 'The task must be run successfully');

        $this->assertFileEquals(
            // Reference CSS file
            'resources' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style.css',
            // The one previously built
            'build' . DIRECTORY_SEPARATOR . 'style.css'
        );
    }
}
