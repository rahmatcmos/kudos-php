@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <h1>{{ trans('dashboard.dashboard') }}</h1>
        </div>
        <div class="col-md-6 text-right dates">
          <input type="text" class="datepicker"><i class="fa fa-calendar"></i><input type="text" class="datepicker">
        </div>
      </div>
    </div>
  </div>
  
  <section class="container-fluid">
    
    <div class="row">
      <div class="col-lg-8">
        <canvas id="visitors-sales" width="1080" height="400"></canvas>
      </div>
      <div class="col-lg-4">
        <canvas id="conversions" width="800" height="500"></canvas>
      </div>
    </div>
    
    <hr>
    
    <p class="form-inline">
      {{ trans('dashboard.enter ga') }} <input type="text" class="form-control" placeholder="UA-XXXXX-X">
    </p>
    
    <!--<ul class="row">
      <li class="col-md-2">
        <div style="background: #FF5454">#FF5454</div>
      </li>
      <li class="col-md-2">
        <div style="background: #FABB3D">#FABB3D</div>
      </li>
      <li class="col-md-2">
        <div style="background: #99C83D">#99C83D</div>
      </li>
      <li class="col-md-2">
        <div style="background: #1E8FC6">#1E8FC6</div>
      </li>
      <li class="col-md-2">
        <div style="background: #219FDD">#219FDD</div>
      </li>
      <li class="col-md-2">
        <div style="background: #36A9E1">#36A9E1</div>
      </li>
    </ul>
    <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput">-->
    
  </section>
    
@endsection

@section('foot')
<script>
  var ctx = document.getElementById("visitors-sales");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: 'Visitors',
            data: [112, 119, 113, 115, 112, 113, 112, 119, 113, 115, 112, 113],
            backgroundColor: 'rgba(255, 155, 0, 0.2)',
            borderColor: 'rgba(255, 155, 0, 1)',
            borderWidth: 1
        },
        {
            label: 'Sales',
            data: [1, 2, 0, 1, 2, 3, 7, 2, 3, 5, 2, 3],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
  });
  
  var ctpie = document.getElementById("conversions");
  var myPieChart = new Chart(ctpie,{
    type: 'pie',
    data: {
      labels: [
          "Red",
          "Blue",
          "Yellow"
      ],
      datasets: [
      {
          data: [300, 50, 100],
          backgroundColor: [
              "#FF6384",
              "#36A2EB",
              "#FFCE56"
          ],
          hoverBackgroundColor: [
              "#FF6384",
              "#36A2EB",
              "#FFCE56"
          ]
      }]
    }
  });
  
</script>
@endsection


