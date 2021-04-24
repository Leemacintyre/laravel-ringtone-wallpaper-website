@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($wallpapers as $wallpaper)
                    <div class="card">
                        <div class="card-header">{{$wallpaper->title}}</div>
                        <div class="card-body">
                            <p>{{$wallpaper->description}}</p>
                            <p>
                                <img src="/uploads/{{$wallpaper->file}}" alt="{{$wallpaper->title}}"
                                     class="img-thumbnail">
                            </p>
                        </div>
                    </div>
            </div>
            <div class="col-md-3 mt-4">
                <form action="{{route('download1',[$wallpaper->id])}}" method="post">@csrf
                    <p>
                        <button class="btn btn-primary" type="submit">Download 800 x 600</button>
                    </p>
                </form>
                <p>
                </p>
                <form action="{{route('download2',[$wallpaper->id])}}" method="post">@csrf
                    <p>
                        <button class="btn btn-primary" type="submit">Download 1280 x 1024</button>
                    </p>
                </form>
                <form action="{{route('download3',[$wallpaper->id])}}" method="post">@csrf
                    <p>
                        <button class="btn btn-primary" type="submit">Download 316 x 255</button>
                    </p>
                </form>
                <form action="{{route('download4',[$wallpaper->id])}}" method="post">@csrf
                    <p>
                        <button class="btn btn-primary" type="submit">Download 118 x 95</button>
                    </p>
                </form>

            </div>
            @endforeach
            {{$wallpapers->links()}}
        </div>
    </div>
@endsection
