# ILess Robo Task

[![Latest Version](https://img.shields.io/github/release/indigophp/robo-iless.svg?style=flat-square)](https://github.com/indigophp/robo-iless/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/robo-iless.svg?style=flat-square)](https://travis-ci.org/indigophp/robo-iless)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/robo-iless.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/robo-iless)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/robo-iless.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/robo-iless)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/robo-iless.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/robo-iless)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/robo-iless.svg?style=flat-square)](https://packagist.org/packages/indigophp/robo-iless)

**ILess Robo Task is a Robo task that enables Robo to perform LESS compilation through the ILess library.**

## Install

Via Composer

``` bash
$ composer require indigophp/robo-iless
```


## Usage

```php
class RoboFile extends \Robo\Tasks
{
    use \Robo\Task\ILess\loadTasks;

    public function less()
    {
        $this->taskCompileLess()
            ->paths([
                'some/path/to/css.css' => 'some/path/to/less.less',
                'some/path/to/css2.css' => 'some/path/to/less2.less',
            ])
            ->run();
    }
}
```

## Testing

``` bash
$ vendor/bin/phpunit
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Tamás Barta](https://github.com/TamasBarta)
- [All Contributors](https://github.com/indigophp/robo-iless/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
