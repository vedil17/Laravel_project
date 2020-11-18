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
                            $message1=Session::get('message1');
                        ?>
                        @if ($message)
                            <p class="alert alert-success">
                                <?php
                                    echo $message;
                                    Session::put('message',null);   
                                ?>
                            </p>
                        @endif
                        @if ($message1)
                            <p class="alert alert-danger">
                                <?php
                                    echo $message1;
                                    Session::put('message1',null);   
                                ?>
                            </p>
                        @endif
                        <h4 class="card-title">Add product</h4>
                        {!! Form::open(['action'=>'ProductController@save_product','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
                            <fieldset>
                            <div class="form-group">
                                <label for="cname">Product name</label>
                                <input id="cname" class="form-control" name="product_name" minlength="2" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Product price</label>
                                <input id="cname" class="form-control" name="product_price" minlength="2" type="number" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Category</label>
                                <select id="sortingField" class="form-control" name="product_category">
                                    <?php
                                        $categories=DB::table('tbl_category')->get();
                                    ?>
                                    <option>Select category</option>
                                    @foreach ($categories as $c)
                                        <option value="{{$c->category_name}}">{{$c->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cname">Image</label>
                                {{Form::file('product_image',['class'=>'form-control'])}}
                            </div>
                            <div class="form-group">
                                <label for="cname">Status</label>
                                <input id="cname"  name="product_status" type="checkbox" value="1">
                            </div>
                            {{Form::submit('Add product',['class'=>'btn btn-primary'])}}
                            </fieldset>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection