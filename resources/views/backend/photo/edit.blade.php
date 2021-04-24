@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success">
                        {{\Illuminate\Support\Facades\Session::get('message')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Update photo</div>

                    <div class="card-body">
                        <form action="{{route('photos.update', [$photo->id])}}" method="post" enctype="multipart/form-data">@csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror" value="{{$photo->title}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          name="description">{{$photo->description}}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>File</label>
                                <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror"
                                       accept="image/*">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
