<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>

{{--    //accessing our attributes as array key, create before eloquent--}}
        {{--    <h2 class="font-bold text-lg">{{ $job['title'] }}</h2>--}}
        {{--    <p>--}}
        {{--        This job pays {{ $job['salary'] }} per year.--}}
        {{--    </p>--}}
        {{--    //here accessing our attributes as properties--}}
        {{--    <p class="mt-6">--}}
        {{--        <x-button href="/$jobs/{{ $job->id }}/edit">Edit Job</x-button>--}}
        {{--    </p>--}}

{{--    //refresh to keep consistence--}}
    <h2 class="font-bold text-lg">{{ $job->title }}</h2>
    <p>
        This job pays {{ $job->salary }} per year.
    </p>
{{--    //here accessing our attributes as properties with eloquent--}}
    <p class="mt-6">
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
    </p>
</x-layout>


