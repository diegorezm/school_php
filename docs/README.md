# Documentation

# Filtering 
- `eq`:  Equal to
- `lt`: Less than
- `lte`: Less than or equal to
- `gt`: Greater than
- `gte`: Greater than or equal to

## Student API endpoints
| HTTP Method | URL                                   | Description                                                     | Response Data Format                                       |
|---|---|---|---|
| GET     | `/api/{version}/students`                           | Retrieves all students (paginated by default).                 | `StudentCollection` containing paginated student data.      |
| GET     | `/api/{version}/students?{filter_parameters}`       | Retrieves students filtered based on specific criteria.      | `StudentCollection` containing filtered and paginated student data. |
| GET     | `/api/{version}/students/{id}`                       | Retrieves a specific student by their ID.                       | `StudentResource` containing details of the requested student. |
| POST    | `/api/{version}/students`                           | Creates a new student record.                                  | `StudentResource` containing details of the newly created student. |
| PUT     | `/api/{version}/students/{id}`                       | Updates an existing student record.                           | `StudentResource` containing details of the updated student. |
| DELETE  | `/api/{version}/students/{id}`                       | Deletes a student record.                                       | No response data (empty response).                           |
### Filtering
| Column Name | Filter Operators | Description |
|---|---|---|
| name | `eq` | Filters students where their name exactly matches the provided value. |
| email | `eq` | Filters students where their email address exactly matches the provided value. |
| age | `eq`, `lt`, `lte`, `gt`, `gte` | Filters students based on their age:  
| courseId | `eq`, `lt`, `lte`, `gt`, `gte` | Filters students based on the course ID they are enrolled in. |
 - Exemple: ```GET /api/v1/students?name[eq]=Mario```

## Course API Endpoints

| HTTP Method | URL                                         | Description                                                                                                                | Response Data Format                                                 |
|---|---|---|---|
| GET     | `/api/{version}/courses`                                  | Retrieves all courses (paginated by default). Optionally, includes related students if `includeStudents` query parameter is set to `"true"`. | `CourseCollection` containing paginated course data (with students if included). |
| GET     | `/api/{version}/courses/{id}`                               | Retrieves a specific course by its ID.                                                                                          | `CourseResource` containing details of the requested course.        |
| POST    | `/api/{version}/courses`                                  | Creates a new course record.                                                                                                   | `CourseResource` containing details of the newly created course.     |
| PUT     | `/api/{version}/courses/{id}`                               | Updates an existing course record.                                                                                                 | `CourseResource` containing details of the updated course.            |
| DELETE  | `/api/{version}/courses/{id}`                               | Deletes a course record.                                                                                                        | No response data (empty response).                                   |
### Filtering
| Column Name | Filter Operators | Description |
|---|---|---|
| name | `eq` | Filters the course name. |
 - Exemple: ```GET /api/v1/courses?name[eq]=Mario```
