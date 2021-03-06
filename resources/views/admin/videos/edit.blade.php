@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Video
        </h1>
   </section>
   <div class="content">
       @include('common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($video, ['route' => ['admin.videos.update', $video->id], 'method' => 'patch', 'class'=>'container-fluid']) !!}

                        @include('admin.videos.fields')

                   {!! Form::close() !!}

                    {!! Form::open(['method' => 'PUT', 'url' => route('admin.videos.publish', $video->id)]) !!}
                        <button type="submit" class="btn btn-warning btn-lg">Publish</button>
                    {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection