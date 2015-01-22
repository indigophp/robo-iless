<?php

namespace Robo\Task\ILess;

/**
 * Task to compile LESS files utilizing the ILess library.
 *
 * @package Robo\Iless
 * @author Tamás Barta <barta.tamas.d@gmail.com>
 */
class CompileLessTask extends \Robo\Contract\TaskInterface
{
    /**
     * The associative array of paths to compile
     * @var array
     */
    protected $paths;

    /**
     * The array of directories to use as import directories in ILess
     * @var array
     */
    protected $importDirs;

    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    public function paths(array $paths)
    {
        $this->paths += $paths;
        return $this;
    }

    public function importDirs(array $importDirs)
    {
        $this->importDirs = $importDirs;
        return $this;
    }

    public function run()
    {
        $parser = new ILess_Parser([
            'import_dirs' => $this->$importDirs,
        ]);

        foreach ($this->paths as $destination => $source) {
            $parser->parseFile($source);
            file_put_contents($destination, $parser->getCSS());
        }
    }
}
