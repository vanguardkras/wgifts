<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    /**
     * Get a gift List instance of the current gift.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function giftList()
    {
        return $this->belongsTo('App\GiftList');
    }

    /**
     * Pick a particular gift.
     */
    public function pick()
    {
        $this->picked = true;
        $this->save();
    }

    /**
     * Add gift comment.
     *
     * @param string $comment
     */
    public function comment(?string $comment)
    {
        if ($comment) {
            $this->comment = $comment;
            $this->save();
        }
    }
}
