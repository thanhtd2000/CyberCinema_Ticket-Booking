<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacts extends Model
{
    use HasFactory, Searchable;
    protected $table = 'contacts';

    protected $guarded = [];


    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->contents
        ];
    }
}
