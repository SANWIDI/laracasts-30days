<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
//    eager load, give me all jobs WITH the employer
//    get() = select*, it is fetching every single record of the table
    //$jobs = Job::with('employer')->get();
// so we need to be careful about the memory so we will use pagination
    //3= how many job you will see on the page
    //$jobs = Job::with('employer')->paginate(3);
//simple paginate: only see previous and next for page that your record use, no extra
    $jobs = Job::with('employer')->simplePaginate(3);
    //CursorPaginate, when hover the next button it gives the link
     //$jobs = Job::with('employer')->cursorPaginate(3);

    //$jobs = Job::all();

    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs-test', function () {
    $jobs = Job::all();
//    dd($jobs);
//    dd($jobs[0]);
    dd($jobs[0]->title . ' ' . $jobs[0]->salary);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
