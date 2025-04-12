<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//index: display all jobs
Route::get('/jobs', function () {
        //    eager load, give me all jobs WITH the employer
        //    get() = select*, it is fetching every single record of the table
        //$jobs = Job::with('employer')->get();
        // so we need to be careful about the memory so we will use pagination
        //3= how many job you will see on the page
        //$jobs = Job::with('employer')->paginate(3);
        //simple paginate: only see previous and next for page that your record use, no extra
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        //CursorPaginate, when hover the next button it gives the link
         //$jobs = Job::with('employer')->cursorPaginate(3);

        //$jobs = Job::all();

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    });

    //end of index

    //Route::get('/jobs-test', function () {
    //    $jobs = Job::all();
    ////    dd($jobs);
    ////    dd($jobs[0]);
    //    dd($jobs[0]->title . ' ' . $jobs[0]->salary);
    //});

    //Create :display Create job
Route::get('/jobs/create', function () {

        //dd('hello there.');
        return view('jobs.create');

    });
    //end of create


    //Store: store or process a job in the existing db
Route::post('/jobs', function () {
        //dd(request()->all()); getting all job create
        //we can specify what we want to be return /dd(request()->$title();
        //request clientside validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']

        ]);
        //before validation with the id
        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        return redirect('/jobs');

    });
    //end of store

//Edit: display Edit one job
Route::get('/jobs/{id}/edit', function ($id) {
        $job = Job::find($id);

        return view('jobs.edit', ['job' => $job]);
    });

    //end of edit

//Update: patch request : submit an update to this particular job
Route::patch('/jobs/{id}', function ($id) {
      //1/validate the record
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']

    ]);
        //2/authorize

        //update Job, with find a list of Job by the id
    //findorFairl
    $job=Job::findOrFail($id); //null

    $job->title = request('title');
    $job->salary = request('salary');
    $job->save();
    //persist
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

        //redirect to the job page
    return redirect('/jobs/' . $job->id);
    });
    //end of update

//delete request: destroy a record in the database
Route::delete('/jobs/{id}', function ($id) {
   //authorize the request
    //delete the job
//    $job = Job::findOrFail($id);
//        $job->delete();
     Job::findOrFail($id)->delete();
    // and redirect
    return redirect('/jobs');

});
//end of delete





//Show: display one job
Route::get('/jobs/{id}', function ($id) {
   $job = Job::find($id);
   // $job = Job::where('id',$id);

    return view('jobs.show', ['job' => $job]);
});

//end of show



Route::get('/contact', function () {
    return view('contact');
});
