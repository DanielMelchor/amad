<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class model_has_roles extends Model
{
    protected $table = 'model_has_roles';
    use Userstamps;
}
