<?php

namespace App\Observers;

use App\Models\Point;

class PointObserver
{
    /**
     * Handle the Point "created" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function created(Point $point)
    {
        if (is_numeric($point->receive_user->{$point->type.'_point'})) {
            $point->receive_user->{$point->type.'_point'} += $point->point;
            $point->receive_user->save();
        }
    }

    /**
     * Handle the Point "updated" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function updated(Point $point)
    {
        //
    }

    /**
     * Handle the Point "deleted" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function deleted(Point $point)
    {
        //
    }

    /**
     * Handle the Point "restored" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function restored(Point $point)
    {
        //
    }

    /**
     * Handle the Point "force deleted" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function forceDeleted(Point $point)
    {
        //
    }
}
