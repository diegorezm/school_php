<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\V1\CourseCollection;
use App\Http\Resources\V1\CourseResource;
use App\Models\Course;
use App\Filters\V1\CourseFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $filter = new CourseFilter();
        $filterItems = $filter->transform($request);

        $includeStudents = $request->query('includeStudents');

        $courses = Course::query()->where($filterItems);

        if($includeStudents && $includeStudents === "true"){
            $courses->with('students');
        }

        return new CourseCollection($courses->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request): CourseResource
    {
        return new CourseResource(Course::query()->create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): CourseResource
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course): CourseResource
    {
        return new CourseResource($course->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): void
    {
        $course->delete();
    }

}
