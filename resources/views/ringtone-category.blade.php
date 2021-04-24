@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if(count($ringtones)>0)
                    @foreach($ringtones as $ringtone)


                        <div class="card" style="margin-top: 50px">
                            <div class="card-header">{{$ringtone->title}}</div>

                            <div class="card-body">
                                <audio controls onplay="pauseOthers(this)" controlsList="nodownload"
                                       src="/audio/{{$ringtone->file}}"
                                       type="audio/oog">your
                                    browser does not support this element
                                </audio>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('ringtones.show', [$ringtone->id, $ringtone->slug])}}">Info and
                                    Download</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>There are not any ringtones for this category</p>
                @endif
            </div>
                <div class="col-md-4" style="margin-top: 50px">
                    <div class="card-header">Categories</div>
                    @foreach(App\Models\Category::all() as $category)
                        <div class="card-header" style="background-color: #ccc;"><a href="{{route('ringtones.category',[$category->id])}}">{{$category->name}}</a></div>
                    @endforeach
                </div>
            {{$ringtones->links()}}
        </div>
    </div>
@endsection
