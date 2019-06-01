<?php

namespace Tests\Mock;

use App\Services\Rss\TagsConverter;

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
