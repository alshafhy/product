<?php

namespace App\Models;

use App\Http\Traits\AttachmentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppBaseModel;

class Post extends AppBaseModel
{
    use HasFactory;
    use AttachmentTrait;

    protected $fillable = ['title', 'body'];
}
