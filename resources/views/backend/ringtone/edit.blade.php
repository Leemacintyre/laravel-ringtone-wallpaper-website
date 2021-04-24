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
                    <div class="card-header">Update Ringtone</div>

                    <div class="card-body">
                        <form action="{{route('ringtones.update',[$ringtone->id])}}" method="post" enctype="multipart/form-data">@csrf
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$ringtone->title}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" >{{$ringtone->description}}
                                </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>File</label>
                                <input type="file" name="file" class="form-control  @error('file') is-invalid @enderror" accept="audio/*">
                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Choose category</label>
                                <select name="category" class="form-control @error('file') is-invalid @enderror" >
                                    <option value="" >Select Category</option>
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{$category->id}}"
                                        @if($category->id==$ringtone->category_id)selected @endif
                                        >{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
