<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    protected static array $encryptedKeys = [
        'mail_password',
    ];

    /**
     * Cache key for all settings.
     */
    protected static string $cacheKey = 'app_settings_all';

    /**
     * Cache duration in seconds (60 minutes).
     */
    protected static int $cacheTtl = 3600;

    /**
     * Get a setting value with caching.
     * All settings are loaded once and cached for 60 minutes.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember(static::$cacheKey, static::$cacheTtl, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });

        if (! isset($settings[$key])) {
            return $default;
        }

        $value = $settings[$key];

        if (in_array($key, static::$encryptedKeys)) {
            try {
                return Crypt::decryptString($value);
            } catch (\Exception $e) {
                return $default;
            }
        }

        return $value;
    }

    /**
     * Set a setting value and clear the cache.
     */
    public static function set(string $key, mixed $value): void
    {
        if (in_array($key, static::$encryptedKeys) && $value) {
            $value = Crypt::encryptString($value);
        }

        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        static::clearCache();
    }

    /**
     * Clear the settings cache.
     */
    public static function clearCache(): void
    {
        Cache::forget(static::$cacheKey);
    }
}
