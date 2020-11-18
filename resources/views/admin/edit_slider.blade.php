@extends('layouts.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $message=Session::get('message');
                        ?>
                        @if ($message)
                            <p class="alert alert-success">
                                <?php
                                    echo $message;
                                    Session::put('message',null);   
                                ?>
                            </p>
                        @endif
                        <h4 class="card-title">Update slider</h4>
                        {!! Form::open(['action'=>'SliderController@update_slider','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
                            <fieldset>
                            <div class="form-group">
                                <label for="cname">Description one</label>
                                <input id="cname" class="form-control" name="description1" minlength="2" type="text" value="{{$select_slider->description1}}" required>
                                <input id="cname" class="form-control" name="slider_id" minlength="2" type="hidden" value="{{$select_slider->id}}" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Description two</label>
                                <input id="cname" class="form-control" name="description2" minlength="2" type="text" value="{{$select_slider->description2}}" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Slider image</label>
                                {{Form::file('slider_image',['class'=>'form-control'])}}
                            </div>
                            {{Form::submit('Update slider',['class'=>'btn btn-primary'])}}
                            </fieldset>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection