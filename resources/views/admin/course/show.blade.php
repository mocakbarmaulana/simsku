@extends('layouts.admin')

@section('title')
<title>List Course</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active"><a href="{{route('course.index')}}">{{$active}}</a></li>
        <li class="breadcrumb-item active"><a>{{$course->name}}</a></li>
    </ol>
</nav>
<div class="mx-3 p-2 bg-light">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>List Member Course</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped">
                        <thead class="">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->orders as $order)
                            <tr>
                                <td style="width: 30px">{{$loop->index + 1}}.</td>
                                <td>{{$order->student->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>{{$course->name}}</h5>
                </div>
                <div class="card-body">
                    <img src="{{asset('storage/assets/images/course/'.$course->image_course)}}" width="100%"
                        alt="image-logo" class="mb-3">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <b>Description :</b><br>
                            {{$course->description}}
                        </li>
                        <li class="mb-3">
                            <b>Expert :</b><br>
                            By. {{$course->teacher->name}}
                        </li>
                        <li class="mb-3">
                            <b>Event Date :</b><br>
                            {{date('d-m-Y', strtotime($course->event_date))}}
                        </li>
                        <li class="mb-3">
                            <b>Slot :</b><br>
                            {{ $course->quota_student}}
                        </li>
                        <li class="mb-3">
                            <b>Skill :</b><br>
                            {{ $course->skill->name}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
