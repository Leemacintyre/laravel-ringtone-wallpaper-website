@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success">
                        {{\Illuminate\Support\Facades\Session::get('message')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">All Photos
                        <span class="float-right">
                        <a href="{{route('photos.create')}}">
                            <button class="btn btn-primary">Create Photo</button>
                        </a>
                    </span>
                    </div>
                    <div class="card-body">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">File</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Format</th>
                                <th scope="col">Size</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($photos)>0)
                                @foreach($photos as $key =>$photo)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>
                                            <img src="/uploads/{{$photo->file}}" width="180px" alt="audio">
                                        </td>
                                        <td>{{$photo->title}}</td>
                                        <td>{{$photo->description}}</td>

                                        <td>{{$photo->format}}</td>
                                        <td>{{round($photo->size,2)*0.001}}kb</td>
                                        <td>
                                            <a href="{{route('photos.edit', [$photo->id])}}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route('photos.destroy',[$photo->id])}}" method="post"
                                                  onsubmit="return confirm('Do you want to delete')">@csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn btn-danger">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td>No Photos to display</td>
                            @endif


                            </tbody>
                        </table>


                    </div>
                </div>
                {{$photos->links()}}
            </div>
        </div>
    </div>
@endsection
