<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Background extends Model
{
    /**
     * Update background data.
     *
     * @param Request $request
     * @return Background
     */
    public function dataUpdate(Request $request)
    {
        if ($request->has('file')) {
            $file = $request->file('file');
            $file->store('backgrounds', 'public');
            $this->file = $file->hashName();
        }

        $this->name = $request->name;
        $this->save();

        return $this;
    }
}
