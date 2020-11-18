@extends('layouts.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <?php
            $increment=1;
            $all_categories=DB::table('tbl_category')->get();
          ?>
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
          <h4 class="card-title">Categories</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order</th>
                        <th>Product category</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($all_categories as $category)
                      <tr>
                        <td>{{$increment}}</td>
                        <td>{{$category->category_name}}</td>
                        <td>
                          <button class="btn btn-outline-primary"><a href="{{URL::to('/edit_category/'.$category->id)}}">Update</a></button>
                          <button class="btn btn-outline-danger"><a href="{{URL::to('/delete_category/'.$category->id)}}" id="delete">Delete</a></button>
                        </td>
                      </tr>
                      <?php
                        $increment+=1;
                      ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
