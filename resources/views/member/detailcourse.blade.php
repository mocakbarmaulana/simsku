@extends('layouts.member')

@section('head')
<title>{{$course->course->name}} | Detail Course</title>
@endsection

@section('content')
<div class="p-4">
    <h1>{{$course->course->name}}</h1>
    <div class="row mt-4">
        <div class="col">
            <img src="{{asset('storage/assets/images/course/'.$course->course->image_course)}}" height="400px"
                alt="image-course" width="100%">
        </div>
        <div class="col-4">
            <ul class="list-unstyled">
                <li class="mb-3"><b>Event Date :</b><br>
                    {{date('d-m-Y', strtotime($course->course->event_date))}}
                </li>
                <li class="mb-3"><b>Description :</b><br>
                    {{$course->course->description}}
                </li>
                <li class="mb-3"><b>Link :</b><br>
                    {{$course->course->link}}
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
