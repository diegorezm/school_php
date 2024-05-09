<?php

namespace App\Filters\V1;

use App\Filters\BaseFilter;

class StudentFilter extends BaseFilter {
    protected $safeParams = [
        "name" => ['eq'],
        "email" => ['eq'],
        "age" => ['eq', 'lt', 'lte', 'gt', 'gte'],
        "courseId" => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];
    protected $columnMap = [
       "courseId"  => "course_id",
    ];
}
