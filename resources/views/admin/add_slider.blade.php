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
                        <h4 class="card-title">Add slider</h4>
                        {!! Form::open(['action'=>'SliderController@save_slider','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
                            <fieldset>
                            <div class="form-group">
                                <label for="cname">Description one</label>
                                <input id="cname" class="form-control" name="description1" minlength="2" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Description two</label>
                                <input id="cname" class="form-control" name="description2" minlength="2" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Slider image</label>
                                {{Form::file('slider_image',['class'=>'form-control'])}}
                            </div>
                            <div class="form-group">
                                <label for="cname">Status</label>
                                <input id="cname"  name="slider_status" type="checkbox" value="1" required>
                            </div>
                            {{Form::submit('Add slider',['class'=>'btn btn-primary'])}}
                            </fieldset>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection