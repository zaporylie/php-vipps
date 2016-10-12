<?php

namespace Vipps;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class ScriptHandler
{

    /**
     * Generate dummy yaml.
     */
    public static function createExamplesConfigFile()
    {
        $fs = new Filesystem();
        $root = __DIR__ . '/../examples/';
        if (!$fs->exists($root . 'settings.yml')) {
            $settings = [
                'cert' => '',
                'id' => '',
                'serialNumber' => '',
                'token' => '',
                'transaction' => [
                    'orderID' => '',
                    'mobilePhone' => '',
                    'amount' => 123,
                    'callback' => '',
                    'text' => 'test',
                ],
            ];
            $content = Yaml::dump($settings);
            $fs->dumpFile($root . 'settings.yml', $content);
        }
    }
}
