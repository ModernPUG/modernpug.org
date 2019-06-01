<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\StripPosts;

class StripArticlesTest extends TestCase
{
    public function testPanel()
    {
        $originText = "<html><head><style>.html{}</style></head><body><h1>제목</h1><br>본문 <script>console.log('test')</script></body></html>";

        $resultText = StripPosts::panel($originText);

        $this->assertEquals('제목본문', $resultText);
    }

    public function testView()
    {
        $originText = "<html><head><style>.html{}</style></head><body><h1>제목</h1><br>본문 <script>console.log('test')</script></body></html>";

        $resultText = StripPosts::view($originText);

        $this->assertEquals('제목<br>본문', $resultText);
    }
}
