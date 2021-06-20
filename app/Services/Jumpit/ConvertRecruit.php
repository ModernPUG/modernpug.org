<?php

namespace App\Services\Jumpit;

use App\Models\Recruit;
use stdClass;

class ConvertRecruit
{
    public function convert(stdClass $recruit): Recruit
    {
        return new Recruit([
            'title' => $recruit->title,
            'company_name' => $recruit->companyName,
            'description' => $recruit->contents,
            'skills' => implode(',', $recruit->techStacks),
            'link' => $recruit->link,
            'image_url' => $recruit->thumbnail,
            'address' => $recruit->location,
            'expired_at' => $recruit->closedAt,
        ]);
    }
}
