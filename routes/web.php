<?php


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/main', function () {
//     return view('layouts.main');
// });
// Route::get('/t', function (){
// 	return view('teacher.teacherdashboard');
//  });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/addcourse','DashboardController@submit')->middleware(['auth','can:access-teacher']);
//Route::get('/addcourse2','DashboardController@addcourse2')->name('addcourse2');
Route::get('/dashboard/student', 'DashboardController@student')->middleware(['auth','can:access-student']);
Route::get('/dashboard/teacher', 'DashboardController@teacher')->middleware(['auth','can:access-teacher']);

Route::get('/dashboard/teacher/addcourse','DashboardController@teacheraddcourse')->middleware(['auth','can:access-teacher']);

Route::post('/dashboard/teacher/addcourse','SubjectController@store')->middleware(['auth','can:access-teacher']);

Route::get('/dashboard/teacher/result','DashboardController@result')->middleware(['auth','can:access-teacher']);

Route::get('/dashboard/teacher/result/{subject}','DashboardController@teacherResultSubject')->middleware(['auth','can:access-teacher']);

Route::get('/dashboard/teacher/option/result/{subject}', 'DashboardController@teacherResultOption')->name('test')->middleware(['auth','can:access-teacher']);
Route::get('/dashboard/teacher//result/semester-final-result/{subject}', 'DashboardController@semesterFinalResult')->middleware(['auth','can:access-teacher']);

//  i have to work on these
Route::get('/dashboard/teacher/result/edit/{mark}','DashboardController@teacherResultMarkEdit')->middleware(['auth','can:access-teacher']);
Route::post('/dashboard/teacher/result/edit/{mark}','DashboardController@teacherResultMarkStore')->middleware(['auth','can:access-teacher']);
//mine

Route::get('/dashboard/teacher/result/in-course/edit/{mark}','DashboardController@teacherIncourseMarksEdit')->middleware(['auth','can:access-teacher']);
Route::post('/dashboard/teacher/result/in-course/edit/{mark}','DashboardController@teacherIncourseMarksStore')->middleware(['auth','can:access-teacher']);

Route::get('/dashboard/teacher/result/semester-final/edit/{mark}','DashboardController@teacherSemFinalMarkEdit')->middleware(['auth','can:access-teacher']);
Route::post('/dashboard/teacher/result/semester-final/edit/{mark}','DashboardController@teacherSemFinalMarkStore')->middleware(['auth','can:access-teacher']);

Route::post('/dashboard/teacher/unregister','SubjectController@unregister')->middleware(['auth','can:access-teacher']);

Route::get('/dashboard/student/result','DashboardController@studentresult')->middleware(['auth','can:access-student']);

Route::get('/dashboard/student/addcourse','DashboardController@studentaddcourse')->middleware(['auth','can:access-student']);

Route::get('/dashboard/student/unregister/{subject}','DashboardController@studentunregister')->middleware(['auth','can:access-student']);

Route::get('/dashboard/student/register/{subject}','DashboardController@studentregister')->middleware(['auth','can:access-student']);

 // admin



Route::get('/admin','AdminController@dashboard');
Route::get('/admin/login','AdminController@login')->name('adminlogin');
Route::post('/admin/login','AdminController@loginpost');
Route::post('/adminlogout','AdminController@logout');

Route::resource('/admin/departments','DepartmentController')->middleware('auth:admin');
Route::resource('/admin/courses','CourseController')->middleware('auth:admin');
Route::resource('/admin/students','StudentController')->middleware('auth:admin');
Route::resource('/admin/teachers','TeacherController')->middleware('auth:admin');

// result marking work
Route::resource('/admin/results','MarkController')->middleware('auth:admin');

// end of result marking
Route::get('/admin/teachers/approve/{teacher}','TeacherController@approve')->middleware('auth:admin');
Route::get('/admin/teachers/block/{teacher}','TeacherController@block')->middleware('auth:admin');