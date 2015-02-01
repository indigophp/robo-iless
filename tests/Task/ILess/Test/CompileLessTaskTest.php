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
        $this->assertSame($this->task, $this->task->run());
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
        $this->task->run();

        $this->assertFileEquals(
            // Reference CSS file
            'resources' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style.css',
            // The one previously built
            'build' . DIRECTORY_SEPARATOR . 'style.css'
        );
    }
}
