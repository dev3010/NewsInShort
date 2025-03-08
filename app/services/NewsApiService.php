<?php

namespace App\Services;

use jcobhams\NewsApi\NewsApi;
/**
 *  @author Devesh Agrawal
 */
class NewsApiService
{
    protected $newsApi;

    public function __construct()
    {
        $this->newsApi = new NewsApi(env('NEWSAPI_KEY'));
    }

    public function getTopHeadlines($country = 'us', $category = null)
    {
        return $this->newsApi->getTopHeadlines(null, null, $country, $category);
    }

    public function getNewsByKeyword($query, $from = null, $to = null)
    {
        return $this->newsApi->getEverything($query, null, null, null, 'publishedAt', $from, $to);
    }

    public function getNewsBySource($source)
    {
        return $this->newsApi->getEverything(null, null, $source);
    }
}