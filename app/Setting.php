<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Current setting id.
     */
    protected static $id = 1;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get current price
     *
     * @return int
     */
    public static function getPrice(): int
    {
        return (int) self::getSetting('price');
    }

    /**
     * Check whether payment required or not.
     *
     * @return bool
     */
    public static function isPaymentRequired(): bool
    {
        return (bool) self::getSetting('active');
    }

    /**
     * Update price
     *
     * @param $price
     */
    public static function updatePrice($price)
    {
        self::updateSetting('price', $price);
    }

    /**
     * Update payment requirement.
     *
     * @param bool $require
     */
    public static function updatePaymentRequirement(bool $require)
    {
        self::updateSetting('active', $require);
    }

    /**
     * Get a setting by name.
     *
     * @param string $settingName
     * @return mixed
     */
    private static function getSetting(string $settingName)
    {
        $setting = self::findOrFail(self::$id, $settingName);
        return $setting->$settingName;
    }

    /**
     * Update setting by name.
     *
     * @param string $settingName
     * @param $value
     */
    private static function updateSetting(string $settingName, $value)
    {
        $setting = self::findOrFail(self::$id);
        $setting->$settingName = $value;
        $setting->save();
    }
}
