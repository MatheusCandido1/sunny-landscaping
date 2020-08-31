@extends('layouts.partials')
@section('content')
<div class="container-fluid">
  <br>
<div class="row">
  <div class="col-lg-6">
  <div class="card text-white bg-success" style="">
  <div class="card-header">Approved on {{$approved->month}}  <a type="button" href="{{ route('dashboard.status')}}" style="color: white" class="btn btn-link float-right btn-sm">
      See all
    </a></div>
    <div class="card-body">
      <h5 class="card-title">Total amount: US$ {{number_format($approved->total,2)}} </h5> 
      <h5>Quantity: {{$approved->quantity}}</h5>
      </div>
  </div>
  </div>
  <div class="col-lg-6">
    <div class="card text-white bg-primary" style="">
    <div class="card-header">Sent Proposal on {{$selected->month}} <a type="button" href="{{ route('dashboard.total')}}" style="color: white" class="btn btn-link float-right btn-sm">
        See all
      </a></div>
      <div class="card-body">
        <h5 class="card-title">Total amount: US$ {{number_format($selected->total,2)}} </h5>
        <h5> Quantity: {{$selected->quantity}} </h5>
      </div>
    </div>
    </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="card border-dark" style="">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
            <i class="fas fa-chart-bar"></i> Approved and Disapproved by Month
          </div>
          <div class="col-lg-6">
            <i class="fas fa-chart-pie"></i> Projects by Status <a type="button" href="{{ route('dashboard.visits', ['status' => 1])}}">
              (See visit's details)
            </a><span class="float-right"> <i class="fas fa-file"></i> Quotes <a type="button" href="{{ route('dashboard.quotes') }}">
              (See all quotes) </a></span>
              </div>
        </div>
      </div>
      <div class="card-body text-dark">
       <div class="row">
         <div class="col-lg-6">
          {!! $chart2->container() !!}

           </div>
           <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-6">
              <a href="{{ route('dashboard.visits', ['status' => 1]) }}" style="text-decoration: none">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem; height: 6rem;">
              <div class="card-body">
                <h5 class="card-title text-center">Schedule Visit</h5>
                <p class="card-text text-center"><i class="fas fa-home"></i> {{$quantityByStatus[1]->quantity}} </h5>
                </p>
              </div>
            </div>
                </a>
              </div>
              <div class="col-lg-6">
                <a href="{{ route('dashboard.visits', ['status' => 2]) }}" style="text-decoration: none">

                <div class="card text-white bg-primary mb-3" style="max-width: 18rem; height: 6rem;">
                  <div class="card-body">
                    <h5 class="card-title text-center">Sent Proposal</h5>
                    <p class="card-text text-center"><i class="fas fa-envelope"></i> {{$quantityByStatus[2]->quantity}
                    </p>
                  </div>
                </div>
              </a>
                  </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <a href="{{ route('dashboard.visits', ['status' => 3]) }}" style="text-decoration: none">

                <div class="card text-white mb-3" style="max-width: 18rem; height: 6rem; background-color: #64ea8d
                ">

              <div class="card-body">
                <h5 class="card-title text-center">Project Approved</h5>
                <p class="card-text text-center"><i class="fas fa-check"></i> {{$quantityByStatus[3]->quantity}} </h5>
                </p>
              </div>
            </div>
          </a>
              </div>
              <div class="col-lg-6">
                <a href="{{ route('dashboard.visits', ['status' => 4]) }}" style="text-decoration: none">

                <div class="card text-white mb-3" style="max-width: 18rem; height: 6rem; background-color: rgba(78, 51, 87, 1.0)">
                  <div class="card-body">
                    <h5 class="card-title text-center">HOA</h5>
                    <p class="card-text text-center"><i class="fas fa-hotel"></i> {{$quantityByStatus[4]->quantity}} </h5>
                    </p>
                  </div>
                </div>
              </a>
                  </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <a href="{{ route('dashboard.visits', ['status' => 5]) }}" style="text-decoration: none">

            <div class="card  bg-light mb-3" style="max-width: 18rem; height: 6rem;">
              <div class="card-body">
                <h5 class="card-title text-center">Ready to Start</h5>
                <p class="card-text text-center"><i class="fas fa-play-circle"></i> {{$quantityByStatus[5]->quantity}} </h5>
                </p>
              </div>
            </div>
          </a>
              </div>
              <div class="col-lg-6">
                <a href="{{ route('dashboard.visits', ['status' => 6]) }}" style="text-decoration: none">

                <div class="card text-white bg-warning mb-3" style="max-width: 18rem; height: 6rem;">
                  <div class="card-body">
                    <h5 class="card-title text-center">Working!</h5>
                    <p class="card-text text-center"><i class="fas fa-hammer"></i> {{$quantityByStatus[6]->quantity}} 
                    </h5>
                    </p>
                  </div>
                </div>
              </a>
                  </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <a href="{{ route('dashboard.visits', ['status' => 7]) }}" style="text-decoration: none">

                <div class="card text-white bg-success mb-3" style="max-width: 18rem; height: 6rem;">
                  <div class="card-body">
                <h5 class="card-title text-center">Project Concluded</h5>
                <p class="card-text text-center"><i class="fas fa-trophy"></i> {{$quantityByStatus[7]->quantity}} </h5>
                </p>
              </div>
            </div>
          </a>
              </div>
              <div class="col-lg-6">
                <a href="{{ route('dashboard.visits', ['status' => 8]) }}" style="text-decoration: none">

                <div class="card text-white bg-danger mb-3" style="max-width: 18rem; height: 6rem;">
                  <div class="card-body">
                    <h5 class="card-title text-center">Project Declined</h5>
                    <p class="card-text text-center"><i class="fas fa-times"></i> {{$quantityByStatus[8]->quantity}} </h5>
                    </p>
                  </div>
                </div>
              </a>
                  </div>
            </div>
            
          </div>
           </div>
  </div>
</div>
  </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart2->script() !!}



@endsection
