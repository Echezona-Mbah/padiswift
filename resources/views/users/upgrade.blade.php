@include('users.head')
      <!-- partial:partials/_sidebar.html -->
      @include('users.sidebar')
      <!-- partial -->

      
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('users.nav')
        @include('sweetalert::alert')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="{{asset('ass/assets/images/dashboard/Group126%402x.png')}}" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Select your preferred membership package plan</h4>
                        {{-- <p class="mb-0 font-weight-normal d-none d-sm-block">Select your preferred membership package plan!</p> --}}
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        {{-- <span>
                          <a href="https://www.bootstrapdash.com/product/corona-admin-template/" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade to PRO</a>
                        </span> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>






            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Select your preferred membership package plan</h4>
                    <span>The following table contains the list of all available membership package plans on padiswiftcom</span><br><br>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </th>
                            <th> PLAN NAME</th>
                            <th> REGISTRATION FEE </th>
                            <th> REGISTRATION BONUS</th>
                            <th>MAX COMMISSION LEVE </th>
                            <th> PV QUANTITY (PV)</th>
                            <th> ACTION </th>
                          </tr>
                        </thead>
                        @foreach ($packages as $package )
                            
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </td>
                            <td>{{$package->package_name}}</td>
                            <td> {{$package->reg_fee}} </td>
                            <td> {{$package->reg_bonus}}</td>
                            <td> {{$package->level_commission}} </td>
                            <td> {{$package->point_value}}</td>
                            <td>
                              @if (auth()->user()->no_of_upgrades == $package->level_commission)
                              <div class="dropdown">
                                  <button class="btn btn-warning" disabled> Current Plan </button>
                              </div>
                              @else
                              <div class="dropdown">
                                  <button class="btn btn-primary" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Choose Plan </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="showConfirmationModal('{{ route('payment.confirm', ['level' => $package->level_commission]) }}')">Pay with wallet</a>
                                  </div>
                              </div>
                              @endif
                          </td>
                          </tr>


                        </tbody>



                        <div id="walletConfirmationModal" class="modal" style="display: none;">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title">Payment Confirmation</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <p>Are you sure you want to pay for the plan upgrade with your Wallet?</p>
                                      <p>Your Wallet Balance: ₦{{ auth()->user()->wallet_balance }}</p>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  </div>
                              </div>
                          </div>
                      </div>






                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
          </div>


<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>


<!-- Your additional scripts go here -->

<!-- Your JavaScript code -->
<script>
  function showConfirmationModal(route) {
      // Populate wallet balance dynamically from the server or database
      var walletBalance = {{ auth()->user()->wallet_balance }};

      // Display the modal with the updated wallet balance
      $('#walletConfirmationModal').find('.modal-body p:last-child').text('Your Wallet Balance: ₦' + walletBalance);

      // Show the modal
      $('#walletConfirmationModal').modal('show');

      // Redirect when the modal is closed
      $('#walletConfirmationModal').on('hidden.bs.modal', function () {
          window.location.href = route;
      });
  }
</script>

         
   @include('users.footer')
   