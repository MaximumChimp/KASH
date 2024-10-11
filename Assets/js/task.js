let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

$(document).ready(function () {
    renderTasks();
});

function renderTasks() {
    const columns = ['todo', 'in-progress', 'done'];

    columns.forEach(columnId => {
        const column = $(`#${columnId}`);
        column.find('.task-container').html('');

        tasks.forEach(task => {
            if (task.status === columnId) {
                const taskElement = createTaskElement(task.content, task.id);
                column.find('.task-container').append(taskElement);
            }
        });
    });
}

function createTaskElement(arr, id) {
    const taskId = id;
    const task = $('<div></div>', {
        id: taskId,
        class: 'task',
        draggable: true,
        html: `
        <div class="task-col">
            <div class="task-row">
                <span id="priority">${arr[1]}</span>   
                <span>${arr[2]}</span>     
            </div>   
            <div class="task-row">
                <span class="task-title">${arr[0]}</span> 
            </div>  
            <div class="task-row">
                <div>
                    <span style="margin-right:15px"><i class="fa-solid fa-suitcase"></i> ${arr[3]}</span>
                    <span><i class="fa-regular fa-comments"></i> 74 comments</span> 
                </div>
            </div>  
            <div class="task-row">
                <span>Pic ${arr[4]}</span>
                <div class="dropdown">
                    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#6c757d">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li class="drop"><a class="dropdown-item" href="#"><i class="fa-regular fa-pen-to-square task-icon"></i> Edit</a></li>
                        <li class="drop"><a class="dropdown-item delete-btn" href="#" onclick="deleteTask('${taskId}')"><i class="fa-solid fa-trash task-icon"></i> Delete</a></li>
                        <li class="drop"><a class="dropdown-item" href="#"><i class="fa-solid fa-user-plus task-icon"></i> Add People</a></li>
                        <li class="drop"><a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-right-from-bracket task-icon"></i> Leave</a></li>
                    </ul>
                </div>
            </div>  
        </div>`
    });

    task.on('dragstart', drag);

    const prioritySpan = task.find("#priority");
    const priorityValue = arr[1];

    if (priorityValue === 'High') {
        prioritySpan.addClass('priority-high');
    } else if (priorityValue === 'Medium') {
        prioritySpan.addClass('priority-medium');
    } else if (priorityValue === 'Low') {
        prioritySpan.addClass('priority-low');
    }

    return task;
}

function deleteTask(taskId) {
    tasks = tasks.filter(task => task.id !== taskId);
    updateLocalStorage();
    renderTasks();
    toastMixin.fire({
        animation: false,
        title: 'Task Successfully Deleted'
      });   
}



function drag(event) {
    event.originalEvent.dataTransfer.setData("text/plain", event.target.id);
}


$('#todo, #in-progress, #done').on('drop', function(event) {
    drop(event, $(this).attr('id'));
}).on('dragover', function(event) {
    allowDrop(event);
});


function drop(event, columnId) {
    event.preventDefault();
    console.log('Drop event:', event);
    const dataTransfer = event.originalEvent.dataTransfer;

    if (!dataTransfer) {
        console.error('dataTransfer is not defined');
        return;
    }

    const data = dataTransfer.getData("text/plain");
    console.log('Data:', data);
    const draggedElement = $(`#${data}`);
    if (draggedElement.length) {
        const taskStatus = columnId;
        updateTaskStatus(data, taskStatus);
        $(event.target).find('.task-container').append(draggedElement);
    }
}


function allowDrop(event) {
    event.preventDefault();
}


function addTask(columnId) {
    const taskInput = $('#taskInput').val().trim();
    const priority = $('#priorityInput option:selected').text();
    const project = $('#projectInput option:selected').text();
    const Assigned = $('#AssignedInput option:selected').text();
    const duedate = $('#duedateInput').val();
    const option = { day: 'numeric', month: 'short', year: 'numeric' };

    let dueDate = duedate ? new Date(duedate) : new Date();
    const deadline = dueDate.toLocaleDateString("en-US", option);

    const arr = [taskInput, priority, deadline, project, Assigned];

    if (taskInput !== "") {
        const newTask = {
            id: "task-" + Date.now(),
            content: arr,
            status: columnId
        };
        tasks.push(newTask);
        updateLocalStorage();
        renderTasks();
        $('#taskInput').val('');
    }

    Swal.fire({
        icon: "success",
        title: "Task Successfully Added!",
        showConfirmButton: false,
        timer: 1000
      });
    
      $("#staticBackdrop").modal("hide");
}

function updateTaskStatus(taskId, newStatus) {
    tasks = tasks.map(task => {
        if (task.id === taskId) {
            return { ...task, status: newStatus };
        }
        return task;
    });
    updateLocalStorage();
}

function updateLocalStorage() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function updateTaskCounts() {
    $('#todo-count').text(`(${$("#todo .task-container").children().length})`);
    $('#in-progress-count').text(`(${$("#in-progress .task-container").children().length})`);
    $('#done-count').text(`(${$("#done .task-container").children().length})`);
}

var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

function deleteTasksInDoneColumn() {
    const tasksInDone = $("#done .task-container").children();
    const todoCount = tasks.filter(task => task.status === 'done').length;
    if (todoCount > 0) {
        tasksInDone.each(function () {
            const taskId = $(this).attr('id');
            deleteTask(taskId);
          
            toastMixin.fire({
                animation: false,
                title: 'Task Successfully Deleted'
              });
            
        });
    }
}

setInterval(deleteTasksInDoneColumn, 3600000);



function countColumn(){
    const todoCount = tasks.filter(task => task.status === 'todo').length;
const inprogressCount = tasks.filter(task => task.status === 'in-progress').length;
const doneCount = tasks.filter(task => task.status === 'done').length;
    $("#todo-count").text(`(${todoCount})`);
    $("#in-progress-count").text(`(${inprogressCount})`);
    $("#done-count").text(`(${doneCount})`);
}

setInterval(countColumn,100)

