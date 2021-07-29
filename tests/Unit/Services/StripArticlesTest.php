<?php

namespace Tests\Unit\Services;

use App\Services\Blog\StripPosts;
use Tests\TestCase;

class StripArticlesTest extends TestCase
{
    public function testPanel()
    {
        $originText = "<html><head><style>.html{}</style></head><body><h1>제목</h1><br>본문 <script>console.log('test')</script></body></html>";

        $resultText = StripPosts::panel($originText);

        $this->assertEquals('제목본문', $resultText);

        $resultText = StripPosts::panel(null);

        $this->assertEquals('', $resultText);
    }

    public function testView()
    {
        $originText = "<html><head><style>.html{}</style></head><body><h1>제목</h1><br>본문 <script>console.log('test')</script></body></html>";

        $resultText = StripPosts::view($originText);

        $this->assertEquals('제목<br>본문', $resultText);


        $resultText = StripPosts::view(null);

        $this->assertEquals('', $resultText);
    }

    public function testSlack()
    {

        $originText = "<html><head><style>.html{}</style></head><body><h1>제  목</h1><br>본\n\n문<script>console.log('test')</script></body></html>";

        $resultText = StripPosts::slack($originText);

        $this->assertEquals("제 목본\n문", $resultText);


        $resultText = StripPosts::slack(null);

        $this->assertEquals('', $resultText);

    }
}
