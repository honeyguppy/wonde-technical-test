<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loadTestData($filename)
    {
        $file = base_path() . '/tests/Mock/' . $filename;
        $json = file_get_contents($file);
        return json_decode($json, true);
    }
}
