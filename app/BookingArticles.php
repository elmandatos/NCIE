<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingArticles extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belogsTo(Warehouse::class);
    }
}
