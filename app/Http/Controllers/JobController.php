<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);


            $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

//        Mail::to($job->employer->user)->send(
        Mail::to($job->employer->user)->queue(
          new JobPosted($job)
       );
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        //*2 Gates, is a barrier, if you are authorize the gate open

//authorize /laravel handling, denies, allows
        //Gate::authorize('edit-job', $job);

        return view('jobs.edit', ['job' => $job]);
//2
        //        Gate::define('edit-job', function(User $user, Job $job) {
//            return $job->employer->user->is($user);
////        });
//        if (Auth::guest()) {
//            return redirect('/login');
//        }

        //*1-user need to be sign in to edit a job
//        if (Auth::guest()){
//            return redirect('/login');
//        }
        //user need to be the creator of the job
        //give the job, with employer with user associated an if is not authenticate
        //is() method of comparison,determine if 2 models have the same Id and belong to the same table
        //isNot: invers
//        if ($job->employer->user->isNot(Auth::user())){
//            abort(403);

    }


    public function update(Job $job)
    {
        // authorize
       Gate::authorize('edit-job', $job);

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // authorize
       // Gate::authorize('edit-job', $job);

        $job->delete();

        return redirect('/jobs');
    }
}
