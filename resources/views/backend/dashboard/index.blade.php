@extends('backend.layouts.master')

@section('title',$title)
@section('main-content')
  <div class="card-header">
    <h3 class="card-title">{{$title}}</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Products</span>
            <span class="info-box-number">{{$data['total_products']}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Category</span>
            <span class="info-box-number">{{$data['total_categories']}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Roles</span>
            <span class="info-box-number">{{$data['total_role']}}<small>%</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Subcategory</span>
            <span class="info-box-number">{{$data['total_subcategories']}}<small>%</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <div id="canvas-holder" style="">
            <canvas id="chart-area"></canvas>
          </div>
        </div>
    </div>

  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    Footer
  </div>
  <!-- /.card-footer-->
@endsection

@section('js')
  <script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
  <script src="https://www.chartjs.org/samples/latest/utils.js"></script>

  <script>
    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };

    var config = {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            50,90,25,65,87
          ],
          backgroundColor: [
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.yellow,
            window.chartColors.green,
            window.chartColors.blue,
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Red',
          'Orange',
          'Yellow',
          'Green',
          'Blue'
        ]
      },
      options: {
        responsive: true
      }
    };

    window.onload = function() {
      var ctx = document.getElementById('chart-area').getContext('2d');
      window.myPie = new Chart(ctx, config);
    };
    </script>
  @endsection