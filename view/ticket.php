
<!-- mainBlock starts -->
<div class="main tabcontent" id="ticket">
<div class="tab">
    
    <div class="tab-action">
      <button class="tab-action--add">+</button>
    </div>
</div>
  <div class="container-fluid" id="ticket-tabs">
  <div class="d-flex">
    <ul class="nav nav-pills flex-column border-end" id="pills-tab" role="tablist">

      <!-- 
      / *********************************************************************************
      /   This line of code is for later use
      / *********************************************************************************
      /
      /  <li class="nav-item" role="presentation"> 
      /    <button class="nav-link" id="pills-yourunsolvedtickets-tab" data-bs-toggle="pill" data-bs-target="#pills-yourunsolvedtickets" type="button" role="tab" aria-controls="pills-home" aria-selected="true" active>Your unsolved tickets</button>
      /  </li>
      /  <li class="nav-item" role="presentation">
      /    <button class="nav-link" id="pills-unassigned-tab" data-bs-toggle="pill" data-bs-target="#pills-unassigned" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Unassigned tickets</button>
      /  </li>
      /
      / ********************************************************************************
      -->

      <li class="nav-item " role="presentation">
        <button class="nav-link active" id="pills-allunsolved-tab" data-bs-toggle="pill" data-bs-target="#pills-allunsolved" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">All unsolved tickets</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-recentlyupdated-tab" data-bs-toggle="pill" data-bs-target="#pills-recentlyupdated" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Recently updated tickets</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-newtickets-tab" data-bs-toggle="pill" data-bs-target="#pills-newtickets" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">New tickets in your groups</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-pendingtickets-tab" data-bs-toggle="pill" data-bs-target="#pills-pendingtickets" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Pending tickets</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-recentlysolved-tab" data-bs-toggle="pill" data-bs-target="#pills-recentlysolved" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Recently solved tickets</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-unsolvedtickets-tab" data-bs-toggle="pill" data-bs-target="#pills-unsolvedtickets" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Unsolved tickets in your groups</button>
      </li>
    </ul>
    <div class="tab-content p-2 flex-grow-1" id="pills-tabContent">
    <!-- 
    / ******************************************************************************************
    /
    / 
    /  <div class="tab-pane fade show active" id="pills-yourunsolvedtickets" role="tabpanel" aria-labelledby="pills-yourunsolvedtickets-tab">
    /    <div class="table-responsive" style="height: 100vh;">
    /      <table class="table" id="unsolvedtickets">
    /        <thead>
    /          <tr>
    /            <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
    /            <th scope="col">Ticket Status</th>
    /            <th scope="col">Subject</th>
    /            <th scope="col">Requester</th>
    /            <th scope="col">Type</th>
    /            <th scope="col">Priority</th>
    /          </tr>
    /        </thead>
    /        <tbody style="height:100%;margin-top:150px" >
    /        </tbody>
    /      </table>
    /    </div>
    /  </div>
    /  <div class="tab-pane fade" id="pills-unassigned" role="tabpanel" aria-labelledby="pills-unassigned-tab" style="height:100vh">
    /      <div class="table-responsive">
    /        <table class="table" id="unassignedtickets">
    /          <thead>
    /            <tr>
    /              <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
    /              <th scope="col">Ticket Status</th>
    /              <th scope="col">Subject</th>
    /              <th scope="col">Requester</th>
    /              <th scope="col">Type</th>
    /              <th scope="col">Priority</th>
    /            </tr>
    /          </thead>
    /          <tbody>
    /
    /          </tbody>
    /        </table>
    /      </div>
    /  </div>     
    / *****************************************************************************************
    -->

    <div class="tab-pane fade show active" id="pills-allunsolved" role="tabpanel" aria-labelledby="pills-allunsolved-tab">
          <div class="table-responsive">
            <table class="table" id="allunsolvedtickets">
              <thead>
                <tr>
                  <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
                  <th scope="col">Ticket Status</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Requester</th>
                  <th scope="col">Type</th>
                  <th scope="col">Priority</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
      </div>
      <div class="tab-pane fade" id="pills-recentlyupdated" role="tabpanel" aria-labelledby="pills-recentlyupdated-tab">
          <div class="table-responsive">
            <table class="table" id="recentlyupdatedtickets">
              <thead>
                <tr>
                  <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
                  <th scope="col">Ticket Status</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Requester</th>
                  <th scope="col">Type</th>
                  <th scope="col">Priority</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
      </div>
      <div class="tab-pane fade" id="pills-newtickets" role="tabpanel" aria-labelledby="pills-newtickets-tab">
          <div class="table-responsive">
            <table class="table" id="newtickets">
              <thead>
                <tr>
                  <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
                  <th scope="col">Ticket Status</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Requester</th>
                  <th scope="col">Type</th>
                  <th scope="col">Priority</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
      </div>
      <div class="tab-pane fade" id="pills-pendingtickets" role="tabpanel" aria-labelledby="pills-pendingtickets-tab">
          <div class="table-responsive">
            <table class="table" id="pendingtickets">
              <thead>
                <tr>
                  <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
                  <th scope="col">Ticket Status</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Requester</th>
                  <th scope="col">Type</th>
                  <th scope="col">Priority</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
      </div>
      <div class="tab-pane fade" id="pills-recentlysolved" role="tabpanel" aria-labelledby="pills-recentlysolved-tab">
          <div class="table-responsive">
            <table class="table" id="recentlysolvedtickets">
              <thead>
                <tr>
                  <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
                  <th scope="col">Ticket Status</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Requester</th>
                  <th scope="col">Type</th>
                  <th scope="col">Priority</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
      </div>
      <div class="tab-pane fade" id="pills-unsolvedtickets" role="tabpanel" aria-labelledby="pills-unsolvedtickets-tab">
          <div class="table-responsive">
            <table class="table" id="unsolvedtickets">
              <thead>
                <tr>
                  <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ></th>
                  <th scope="col">Ticket Status</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Requester</th>
                  <th scope="col">Type</th>
                  <th scope="col">Priority</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>
</div>
  <!--      main ends -->