<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class GiftList extends Model
{
    protected $fillable = [
        'user_id',
        'domain',
        'title',
        'date',
        'background_id',
        'information',
        'comment_opt',
    ];

    /**
     * Activate current list.
     */
    public function activate()
    {
        $this->activated = true;
        $this->save();
    }

    /**
     * Background relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function background()
    {
        return $this->belongsTo('App\Background');
    }

    /**
     * Show date
     *
     * @return false|string
     */
    public function beautifulDate()
    {
        $date = strtotime($this->date);
        return date('d.m.Y', $date);
    }

    /**
     * Gifts of the current list.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gifts()
    {
        return $this->hasMany('App\Gift');
    }

    /**
     * Get a list by its domain
     *
     * @param string $domain
     * @return mixed
     */
    public static function getByDomain(string $domain)
    {
        return self::where('domain', $domain)->firstOrFail();
    }

    /**
     * Check if current list is activated.
     *
     * @return bool
     */
    public function isActivated(): bool
    {
        return (bool) $this->activated;
    }

    /**
     * Check if current list is outdated.
     *
     * @return bool
     */
    public function isOutdated(): bool
    {
        $date = Carbon::parse($this->date);

        return $date <= Carbon::tomorrow();
    }
}
