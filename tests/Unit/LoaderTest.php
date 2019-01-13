<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Libraries\ResourceLoader;

class LoaderTest extends TestCase
{
    /**
     * Download Resource (success)
     *
     * @return void
     */
    public function testDownloadSuccess()
    {
        $res = ResourceLoader::download(
            'https://images.pexels.com/photos/248797/pexels-photo-248797.jpeg'
        );
        $this->assertEquals('pexels-photo-248797.jpeg', $res);
    }

    /**
     * Download Resource (bad URL)
     *
     * @return void
     */
    public function testDownloadFail()
    {
        $res = ResourceLoader::download('lara');
        $this->assertFalse($res);
    }
}
