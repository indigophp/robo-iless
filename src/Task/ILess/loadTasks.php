<?php

namespace Robo\Task\ILess;

/**
 * Lets you compile LESS files with the aid of the ILess library.
 */
trait loadTasks
{
    public function taskCompileLess(array $paths)
    {
        return new CompileLessTask($paths);
    }
}
