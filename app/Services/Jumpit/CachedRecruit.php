<?php


namespace App\Services\Jumpit;


use Exception;
use Illuminate\Support\Facades\Cache;

class CachedRecruit
{

    protected const CACHE_KEY = 'jumpit-recruits';
    private SearchRecruits $searchRecruits;

    public function __construct(SearchRecruits $searchRecruits)
    {
        $this->searchRecruits = $searchRecruits;
    }

    public function setCache(): bool
    {
        try {
            $response = $this->searchRecruits->getRecruits();
            if ($response->status != 200) {
                return false;
            }

            Cache::put(self::CACHE_KEY, $response);
            return true;
        } catch (Exception) {
            return false;
        }
    }

    public function getCachedRecruits()
    {
        return Cache::get(self::CACHE_KEY);
    }


}
