<?php

namespace App\Filters\V1;

use App\Filters\BaseFilter;

class CourseFilter extends  BaseFilter {

    protected $safeParams = [
        "name" => ['eq'],
    ];
}
