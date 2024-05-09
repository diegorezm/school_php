<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentBulkRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\V1\StudentCollection;
use App\Http\Resources\V1\StudentResource;
use App\Models\Student;
use App\Filters\V1\StudentFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $filter = new StudentFilter();
        $filterItems = $filter->transform($request);
        return new StudentCollection(Student::query()->where($filterItems)->paginate());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): StudentResource
    {
        $student = Student::query()->create($request->all());
        return new StudentResource($student);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): StudentResource
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): StudentResource
    {
        $student->update($request->all());
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     * @return void
     */
    public function destroy(Student $student)
    {
        $student->delete();
    }
}
