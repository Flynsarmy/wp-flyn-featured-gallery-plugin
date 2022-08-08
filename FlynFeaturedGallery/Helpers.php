<?php

namespace Flyn\FeaturedGallery;

class Helpers
{
    /**
     * @param array<mixed> $array
     * @param int|string  $key
     * @param mixed $default
     * @return mixed
     */
    public static function arrayGet(array $array, int | string $key, $default = null): mixed
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    /**
     * @param array<mixed> $array
     * @param array<string|int> $keys
     * @return array<mixed>
     */
    public static function arrayOnly(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    /**
     * @param string $filepath
     * @param array<mixed> $vars
     * @return string
     */
    public static function requireWith(string $filepath, array $vars = []): string
    {
        extract($vars);

        ob_start();

        require $filepath;

        return ob_get_clean();
    }

    public static function currentUrl(): string
    {
        return "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    }

    /**
     * @param string $var
     * @param int|string|array<mixed>|null $default
     * @return mixed
     */
    public static function GET(string $var, int | string | array | null $default = null): mixed
    {
        return isset($_GET[$var]) ? $_GET[$var] : $default;
    }

    /**
     * @param string $var
     * @param int|string|array<mixed>|null $default
     * @return mixed
     */
    public static function POST(string $var, int | string | array | null $default = null): mixed
    {
        return isset($_POST[$var]) ? $_POST[$var] : $default;
    }

    public static function REQUEST(string $var, int | string | null $default = null): mixed
    {
        return isset($_REQUEST[$var]) ? $_REQUEST[$var] : $default;
    }

    public static function SERVER(string $var, string | null $default = null): int | string
    {
        return isset($_SERVER[$var]) ? $_SERVER[$var] : $default;
    }

    public static function humanFileSize(int $size, string $unit = ""): string
    {
        if ((!$unit && $size >= 1 << 30) || $unit === "GB") {
            return number_format($size / (1 << 30), 2) . " GB";
        }

        if ((!$unit && $size >= 1 << 20) || $unit === "MB") {
            return number_format($size / (1 << 20), 2) . " MB";
        }

        if ((!$unit && $size >= 1 << 10) || $unit === "KB") {
            return number_format($size / (1 << 10), 2) . " KB";
        }

        return number_format($size) . " B";
    }

    public static function safeCLIArg(string $arg): string
    {
        $arg = strip_tags($arg);
        $arg = addslashes($arg);
        // $arg = str_replace(["\r\n", "\n\r", "\n", "\r"], '\n', $arg);

        return $arg;
    }

    /**
     * Fix network attachment image source.
     *
     * @param string $src
     * @param int $image_blog_id
     * @return string
     */
    public static function fixNetworkAttachmentImageSrc(string $src, int $image_blog_id): string
    {
        // On the server (works on localhost), for some reason the src
        // doesn't have the correct blog site url, but instead, the url of the blog
        // you're requesting from prior to switch_to_blog().
        if (($start = strstr($src, '/wp-content/uploads/')) !== false) {
            $src = get_site_url($image_blog_id) . substr($start, 0);
        }

        // Files sourced from child blogs on the main blog don't have the
        // '/files/' directory replacement.
        if (!is_main_site()) {
            $src = str_replace('/wp-content/uploads/', '/files/', $src);
        }

        return $src;
    }

    /**
     * Allows you to determine if we are on a certain admin page.
     *
     * @param array<mixed> $pages
     * @return bool
     */
    public static function isPageNow(array $pages = []): bool
    {
        global $pagenow;

        return !empty($pagenow) && in_array($pagenow, $pages);
    }
}
