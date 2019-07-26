<?php

namespace Tests\Mock;

use App\Services\Blog\Rss\TagsConverter;

trait TagConverterMock
{
    /**
     * @return TagsConverter
     */
    private function getTagConverterMock(): TagsConverter
    {
        return new TagsConverter();
    }
}
