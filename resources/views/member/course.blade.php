@extends('layouts.member')

@section('head')
<title>Course</title>
<link rel="stylesheet" href="{{asset('assets/css/member/member.css')}}">
@endsection

@section('content')
<div class="p-4">
    <div class="row">
        @foreach ($courses as $course)
        <div class="col-4 mb-4">
            <div class="card">
                <a href="{{route('member.getdetailcourse', $course->course_id)}}">
                    <div class="card-body course-content">
                        <div class="image-thumb" style="width: 100%; height: 200px">
                            <img src="{{asset('storage/assets/images/course/'.$course->course->image_course)}}"
                                alt="image-course" class="img-course" style="width: 100%; height: 100%">
                        </div>
                        <h5 class="my-2">{{$course->course->name}}</h5>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
