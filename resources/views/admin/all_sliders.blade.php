@extends('layouts.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Sliders</h4>
          <?php
              $all_sliders=DB::table('tbl_sliders')
                              ->get();
              $increment=1;
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
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order</th>
                        <th>Image</th>
                        <th>Description one</th>
                        <th>Description two</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($all_sliders as $slider)
                      <tr>
                        <td>{{$increment}}</td>
                        <td><img src="/storage/cover_image/{{$slider->slider_image}}" alt=""></td>
                        <td>{{$slider->description1}}</td>
                        <td>{{$slider->description2}}</td>
                        @if ($slider->status==1)
                          <td>
                            <label class="badge badge-success">Activated</label>
                          </td>
                        @else
                          <td>
                            <label class="badge badge-danger">Unactivated</label>
                          </td>
                        @endif

                        <td>
                          <button class="btn btn-outline-primary"><a href="{{URL::to('/edit_slider/'.$slider->id)}}">Update</a></button>
                          <button class="btn btn-outline-danger"><a href="{{URL::to('/delete_slider/'.$slider->id)}}" id="delete">Delete</a></button>
                          @if ($slider->status==1)
                          <button class="btn btn-outline-warning"><a href="{{URL::to('/unactivate_slider/'.$slider->id)}}">Unactivate</a></button>
                          @else
                            <button class="btn btn-outline-success"><a href="{{URL::to('/activate_slider/'.$slider->id)}}">Activate</a></button>
                          @endif
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
