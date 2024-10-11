<!-- mainBlock starts -->

<div class="main tabcontent" id="tasks">
        <!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #0bcf97;color:#ffffff">
  Add new 
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create New Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <div class="row g-2">
                <div class="col-md">
                        <div class="form-floating">
                                <select class="form-select" id="projectInput" aria-label="Floating label select example">
                                      
                                        <option selected value="1">KERP</option>
                                        <option value="2">KHRIS</option>
                                        <option value="3">KASH</option>
                                </select>
                                <label for="floatingSelectGrid">Projects</label>
                        </div>
                </div>
                <div class="col-md">
                        <div class="form-floating">
                                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                        
                                        <option selected value="1">Information Technology</option>
                                        <option value="2">Accounting</option>
                                        <option value="3">Production</option>
                                </select>
                                <label for="floatingSelectGrid">Department</label>
                        </div>
                </div>
                </div>
                <div class="row g-2">
                        <div class="col-md mt-3">
                                <div class="form-floating">
                                <input type="email" class="form-control task-input"  placeholder="name@example.com"  id="taskInput">
                                <label for="floatingInputGrid">Title</label>
                                </div>
                        </div>
                        <div class="col-md mt-3">
                                <div class="form-floating">
                                        <select class="form-select" id="priorityInput" aria-label="Floating label select example">
                                                <option selected value="1">Low</option>
                                                <option value="2">Medium</option>
                                                <option value="3">High</option>
                                        </select>
                                        <label for="floatingSelectGrid">Priority</label>
                                </div>
                        </div>
                </div>
                <div class="row g-2">
                        <div class="form-floating mt-3">
                        <textarea class="form-control" placeholder="Leave a comment here"></textarea>
                        <label for="floatingTextarea2">Description</label>
                        </div>
                </div>
                <div class="row g-2">
                        <div class="col-md mt-3">
                                <div class="form-floating">
                                        <select class="form-select" id="AssignedInput" aria-label="Floating label select example">
                                                <option selected value="1">Arvin</option>
                                                <option value="2">Bryan</option>
                                        </select>
                                        <label for="floatingSelectGrid">Assigned To</label>
                                </div>
                        </div>
                        <div class="col-md mt-3">
                                <div class="form-floating">
                                <input type="date" class="form-control" id="duedateInput" placeholder="name@example.com" value="mdo@example.com">
                                <label for="floatingInputGrid">Due Date</label>
                                </div>
                        </div>
                </div>
        </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add-task-btn" id="btntodo" onclick="addTask('todo')">Create</button>
                </div>
                </div>
                </div>
                </div>
                <div class="board">
                <div class="container-column">
                <h2>Todo <span id="todo-count">(1)</span></h2>
                <div id="todo" class="column" ondrop="drop(event, 'todo')" ondragover="allowDrop(event)">
                        <div class="task-container"></div>
                </div>
                </div>
                <div class="container-column">
                <h2>In Progress <span id="in-progress-count">(2)</span></h2>
                <div id="in-progress" class="column" ondrop="drop(event, 'in-progress')" ondragover="allowDrop(event)">
                        <div class="task-container"></div>
                </div>
                </div>
                <div class="container-column">
                <h2>Done <span id="done-count">(3)</span></h2>
                <div id="done" class="column" ondrop="drop(event, 'done')" ondragover="allowDrop(event)">
                        <div class="task-container"></div>
                </div>
                </div>

    </div>
</div>
  <!--      main ends -->