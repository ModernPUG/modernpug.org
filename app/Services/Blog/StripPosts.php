<?php
/**
 * Created by PhpStorm.
 * User: kkame
 * Date: 18. 12. 3
 * Time: 오후 9:05.
 */

namespace App\Services\Blog;

use Illuminate\Support\Str;

class StripPosts
{
    public static function panel(?string $html)
    {
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        $html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
        $html = htmlspecialchars_decode($html);
        $html = html_entity_decode($html);
        $html = strip_tags($html);
        $html = trim($html);
        $html = Str::limit($html, 200);

        return $html;
    }

    public static function view(?string $html)
    {
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        $html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
        $html = htmlspecialchars_decode($html);
        $html = html_entity_decode($html);
        $html = strip_tags($html, '<img><br><br/>');
        $html = nl2br($html);
        $html = trim($html);
        $html = Str::limit($html, 200);

        return $html;
    }

    public static function slack(?string $html)
    {
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        $html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
        $html = htmlspecialchars_decode($html);
        $html = html_entity_decode($html);
        $html = strip_tags($html);
        $html = trim($html);
        $html = preg_replace("/[ \t]+/", ' ', $html);
        $html = preg_replace("/[ \n]{2,}/", "\n", $html);

        $html = Str::limit($html, 400);

        return $html;
    }
}
