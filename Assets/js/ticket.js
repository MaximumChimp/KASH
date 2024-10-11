$(document).ready(function() {
    var userData = [];

    $.ajax({
        url: "./ajaxGET/getTickets.php",
        data: {
            TODO: 'getUser'
        },
        context: document.body,
        async: false,
        success: function(d) {
            userData = JSON.parse(d);
        }
    });
    $.ajax({
        url: "./ajaxGET/getTickets.php",
        data: {
            TODO: 'getTicketTags'
        },
        context: document.body,
        async: false,
        success: function(d) {
            Tags = JSON.parse(d);
        }
    });

    /*
    /   *****************************************
    /   This lines of code is for later use
    /   *****************************************
    /   $.ajax({
    /        url: "./ajaxGET/getTickets.php",
    /        data: {
    /            TODO: 'getYourUnsolvedTickets'
    /        },
    /        context: document.body,         
    /        async: false,
    /        success: function(d) {
    /            viewUnsolvedTickets(d)
    /        
    /        }
    /    });    
    /   *****************************************
    */

    /*
    /   *****************************************
    /    This lines of code is for later use 
    /   *****************************************
    /   $.ajax({
    /    url: "./ajaxGET/getTickets.php",
    /    data: {
    /        TODO: 'getUnassignedTickets'
    /    },
    /    context: document.body,         
    /    async: false,
    /    success: function(d) {
    /        viewUnassignedTickets(d)
    /    }
    /    });
    /   ****************************************
    */

    $.ajax({
        url: "./ajaxGET/getTickets.php",
        data: {
            TODO: 'getAllUnsolvedTickets'
        },
        context: document.body,         
        async: false,
        success: function(d) {
            viewAllUnsolvedTickets(d)
        }
    });

    $.ajax({
        url: "./ajaxGET/getTickets.php",
        data: {
            TODO: 'getPendingTickets'
        },
        context: document.body,         
        async: false,
        success: function(d) {
            viewPendingTickets(d)
        }
    });
   
    function renderTabsFromLocalStorage() {
        var storedTabs = JSON.parse(localStorage.getItem('tabs')) || [];
        storedTabs.forEach(function(tab) {
            addTab(tab.id, tab.content, false);
        });
    }

    function addTab(tabId, tabContentHtml, setActive = true) {
        var newTab = $('<li>', { class: 'nav-item dynamic-tab' });
        var newTabButton = $('<button>', {
            class: 'nav-link',
            id: tabId,
            'data-bs-toggle': 'pill',
            'data-bs-target': '#' + tabId + '-content',
            type: 'button',
            role: 'tab',
            'aria-controls': tabId + '-content',
            'aria-selected': 'false',
            text: 'New Ticket'
        });

        var closeButton = $('<button>', {
            class: 'btn-close ms-2',
            'aria-label': 'Close',
            click: function() {
                removeTab(tabId);
                $("#pill-allunsolved .tab-pane").addClass("active");
            }
        });

        newTabButton.append(closeButton);
        newTab.append(newTabButton);
        $('.tab-action').before(newTab);

        var newTabContent = $('<div>', {
            class: 'tab-pane fade',
            id: tabId + '-content',
            role: 'tabpanel',
            'aria-labelledby': tabId,
            html: tabContentHtml
        });

        $('#pills-tabContent').append(newTabContent);

        if (setActive) {
            setActiveTab(tabId);
        }

        storeTabsInLocalStorage();
        initializeQuillEditors();
        RequesterSelect('#' + tabId + '-content #requester');
        TagsSelect('#' + tabId + '-content #autocomplete-input');
    }
       
    function setActiveTab(tabId) {
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');

        $('#' + tabId).addClass('active');
        $('#' + tabId + '-content').addClass('show active');
    }

    function initializeQuillEditors() {
        $('.tab-pane').each(function() {
            $(this).find('#editor-container').each(function() {
                var $editorContainer = $(this);
                if (!$editorContainer.data('quill')) {
                    var quill = new Quill($editorContainer[0], {
                        theme: 'snow'
                    });
                    $editorContainer.data('quill', quill);
                }
            });
        });
    }

    function removeTab(tabId) {
        $('#' + tabId).parent().remove();
        $('#' + tabId + '-content').remove();
        storeTabsInLocalStorage();
    }

    function storeTabsInLocalStorage() {
        var tabs = [];
        $('.nav-item.dynamic-tab .nav-link').each(function() {
            var tabId = $(this).attr('id');
            var tabContentHtml = $('#' + tabId + '-content').html();
            tabs.push({ id: tabId, content: tabContentHtml });
        });
        localStorage.setItem('tabs', JSON.stringify(tabs));
    }

    renderTabsFromLocalStorage();

    $('.tab-action--add').on('click', function() {
        var timestamp = Date.now();
        var tabId = 'new-tab-' + timestamp;
        const form = 
        `
        <h1>New Ticket</h1>
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Requester</label>
                                <select class="form-select" id="requester" aria-label="Default select example">
                                    <option selected>-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Type</label>
                                <select class="form-select" id="type">
                                    <option selected>-</option>
                                    <option value="1">Question</option>
                                    <option value="2">Incident</option>
                                    <option value="3">Problem</option>
                                    <option value="4">Task</option>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Tags</label>
                                <div class="autocomplete">
                                    <div id="tag-container" class="tag-container">
                                        <input id="autocomplete-input" type="text" placeholder="Select or Add tag...">
                                    </div>
                                    <div id="autocomplete-list" class="autocomplete-items"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Priority</label>
                                <select class="form-select" id="prioritystatus">
                                    <option selected>-</option>
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Right Column -->
                <div class="col-md-8 d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <label>Subject</label>
                        <input type="text" id="subject" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Comments</label>
                        <div id="editor-container" class="comments" style="height:400px;background-color:white"></div>
                    </div>
                    <div class="btn-group dropup" style="align-self:flex-end">
                        <button type="button" class="btn btn-secondary" id="addTicket" value='1'>
                            Submit as New
                        </button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" id="dropup">
                            <li><a class="dropdown-item" href="#" value="1" selected><span class="new"></span>New</a></li>
                            <li><a class="dropdown-item" href="#" value='2'><span class="open"></span>Open</a></li>
                            <li><a class="dropdown-item" href="#" value='3'><span class="inprogress"></span>In Progress</a></li>
                            <li><a class="dropdown-item" href="#" value='4'><span class="pending"></span>Pending</a></li>
                            <li><a class="dropdown-item" href="#" value='5'><span class="solved"></span>Solved</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    `
    ;
        addTab(tabId, form);
    });         
    $(document).on('click', '.nav-link', function() {
        setActiveTab($(this).attr('id'));
    });       

    var selectedDropdownValue;

    $(document).on('click', '.dropdown-item', function() {
        var dropdown_text = $(this).text();
        selectedDropdownValue = $(this).attr("value");
        $("#addTicket").text(`Submit as ${dropdown_text}`)
    });

  

    function removeXFromTags() {
        // Select all elements with the class 'tag' inside the 'tag-container'
        $('#tag-container .tag').each(function() {
            // Get the current text content of the tag
            var text = $(this).text();
            
            // Remove the trailing 'x' if it exists
            
        });
    }

    $(document).on('click', '#addTicket', function() {
        var tags = $('#tag-container .tag');
        
        // Create an array to hold the values of the tags
        var tagValues = [];
        
        // Iterate over each tag element and push its text content into the array
        tags.each(function() {
            if ($(this).text().endsWith('x')) {
                text = $(this).text().slice(0, -1); // Remove the last character
                $(this).text(text); // Update the tag text
            }
          return  tagValues.push($(this).text());
        });
        
        var $editorContainer = $(this).closest('.tab-pane').find('#editor-container');
        var quill = $editorContainer.data('quill');
        var STATUS =$(this).val()
        $.ajax({
            url: "./ajaxSET/setTickets.php",
            method:'POST',
            data: {
                TYPE: 'setTicket',
                REQUESTER:$('#requester').val(),
                ASSIGNEE:$('#assignee').val(),
                TAGS: tagValues.toString(),
                CATEGORY:$('#type').val(),
                PRIORITY:$('#prioritystatus').val(),
                STATUS:selectedDropdownValue ? selectedDropdownValue : STATUS,
                SUBJECT:$('#subject').val(),
                COMMENT: quill.root.innerHTML
            },
            context: document.body,
            async: false,
            success: function(d) {
            }
        });

        $("#tag-container .tag").remove();
    });

    function RequesterSelect(selector) {
        const $requesterSelect = $(selector);
        if ($requesterSelect.length) {
            $requesterSelect.empty();
            $.each(userData, function(index, user) {
                $requesterSelect.append($('<option>', {
                    value: user.USERNAME,
                    text: user.USERNAME
                }));
            });
        }
    }

    function TagsSelect(selector) {
        const $tagsSelect = $(selector);
        if ($tagsSelect.length) {
            $tagsSelect.empty();
            $.each(Tags, function(index, tag) {
             
            });
        }
    }
 
    // function AssigneeSelect(selector) {
    //     const $requesterSelect = $(selector);
    //     if ($requesterSelect.length) {
    //         $requesterSelect.empty();
    //         $requesterSelect.append($('<option>', {
    //             value: undefined,
    //             text: "-"
    //         }));
    //         $.each(userData, function(index, user) {
    //             $requesterSelect.append($('<option>', {
    //                 value: user.USERNAME,
    //                 text: user.USERNAME
    //             }));
    //         });
    //     }
    // }

/*
/   ****************************************************************************************************
/   This lines of code is for later use
/   ****************************************************************************************************
/
/ function viewUnsolvedTickets(d){
/        var tableRef = document.getElementById('unsolvedtickets').getElementsByTagName('tbody')[0];
/        const retOBJ = JSON.parse(d)
/
/        $("#unsolvedtickets > tbody" ).html();
/
/        for(var i =0; i < retOBJ.length;i++){
/            var newRow = tableRef.insertRow(tableRef.rows.length);
/            newRow.setAttribute("style","background-color:transparent");
/
/            var newCell0 = newRow.insertCell(0);
/            var newCheckBox0 = document.createElement('input');
/            newCheckBox0.type = 'checkbox';
/            newCheckBox0.name = i;
/            newCheckBox0.style = "width:20px;height:20px;margin:auto;";
/            newCheckBox0.className = "rowCHKHRPAYROLLREGISTERDETAILEDITVOLUNTARYCONTRIBUTION";
/            newCell0.appendChild(newCheckBox0);
/
/            var newCell1 = newRow.insertCell(1);
/            var spanElement = document.createElement("span");
/            
/            
/            if(retOBJ[i]["STATUS"] == '1'){
/                retOBJ[i]["STATUS"] = "New"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:#F8E472;padding:2px 20px 2px 20px;border-radius:5px;font-weight:bold;color:white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '2'){
/                retOBJ[i]["STATUS"] = "Open"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '3'){
/                retOBJ[i]["STATUS"] = "In Progress"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '4'){
/                retOBJ[i]["STATUS"] = "Pending"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:royalblue;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '5'){
/                retOBJ[i]["STATUS"] = "Solved"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:mediumseagreen;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/            }
/            
/          
/
/            var newCell2 = newRow.insertCell(2);
/            var newText2 = document.createTextNode(retOBJ[i]["TITLE"]);
/            newCell2.appendChild(newText2);
/            
/            var newCell3 = newRow.insertCell(3);
/            var newText3 = document.createTextNode(retOBJ[i]["REPORTED_BY"]);
/            newCell3.appendChild(newText3);
/
/
/            if(retOBJ[i]["CATEGORY"] == '1'){
/                retOBJ[i]["CATEGORY"] = "Question"
/            }
/            if(retOBJ[i]["CATEGORY"] == '2'){
/                retOBJ[i]["CATEGORY"] = "Incident"
/            }
/            if(retOBJ[i]["CATEGORY"] == '3'){
/                retOBJ[i]["CATEGORY"] = "Problem"
/            }
/            if(retOBJ[i]["CATEGORY"] == '4'){
/                retOBJ[i]["CATEGORY"] = "Task"
/            }
/
/            var newCell4 = newRow.insertCell(4);
/            var newText4 = document.createTextNode(retOBJ[i]["CATEGORY"]);
/            newCell4.appendChild(newText4);
/
/            if(retOBJ[i]["PRIORITY"] == '1'){
/                retOBJ[i]["PRIORITY"] = "Low"
/            }
/            if(retOBJ[i]["PRIORITY"] == '2'){
/                retOBJ[i]["PRIORITY"] = "Medium"
/            }
/            if(retOBJ[i]["PRIORITY"] == '3'){
/                retOBJ[i]["PRIORITY"] = "High"
/            }
/
/            var newCell5 = newRow.insertCell(5);
/            var newText5 = document.createTextNode(retOBJ[i]["PRIORITY"]);
/            newCell5.appendChild(newText5);
/        }
/   }
/   ***************************************************************************************************************
*/

/* 
/   ***************************************************************************************************************
/   This line of code is for later Use
/   ***************************************************************************************************************
/      
/    function viewUnassignedTickets(d){
/        var tableRef = document.getElementById('unassignedtickets').getElementsByTagName('tbody')[0];
/        const retOBJ = JSON.parse(d)
/
/        $("#unassignedtickets > tbody" ).html();
/
/        for(var i =0; i < retOBJ.length;i++){
/            var newRow = tableRef.insertRow(tableRef.rows.length);
/            newRow.setAttribute("style","background-color:transparent");
/
/            var newCell0 = newRow.insertCell(0);
/            var newCheckBox0 = document.createElement('input');
/            newCheckBox0.type = 'checkbox';
/            newCheckBox0.name = i;
/            newCheckBox0.style = "width:20px;height:20px;margin:auto;";
/            newCheckBox0.className = "rowCHKHRPAYROLLREGISTERDETAILEDITVOLUNTARYCONTRIBUTION";
/            newCell0.appendChild(newCheckBox0);
/
/            var newCell1 = newRow.insertCell(1);
/            var spanElement = document.createElement("span");
/            
/            
/            if(retOBJ[i]["STATUS"] == '1'){
/                retOBJ[i]["STATUS"] = "New"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:#F8E472;padding:2px 20px 2px 20px;border-radius:5px;font-weight:bold;color:white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '2'){
/                retOBJ[i]["STATUS"] = "Open"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '3'){
/                retOBJ[i]["STATUS"] = "In Progress"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '4'){
/                retOBJ[i]["STATUS"] = "Pending"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/                newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:royalblue;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/            }
/            if(retOBJ[i]["STATUS"] == '5'){
/                retOBJ[i]["STATUS"] = "Solved"
/                spanElement.textContent = retOBJ[i]["STATUS"];
/              newCell1.appendChild(spanElement);
/                spanElement.setAttribute("style", "background-color:mediumseagreen;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
/          }
/           
/         
/
/           var newCell2 = newRow.insertCell(2);
/            var newText2 = document.createTextNode(retOBJ[i]["TITLE"]);
/            newCell2.appendChild(newText2);
/            
/           var newCell3 = newRow.insertCell(3);
/            var newText3 = document.createTextNode(retOBJ[i]["REPORTED_BY"]);
/            newCell3.appendChild(newText3);
/
/
/            if(retOBJ[i]["CATEGORY"] == '1'){
/                retOBJ[i]["CATEGORY"] = "Question"
/            }
/            if(retOBJ[i]["CATEGORY"] == '2'){
/                retOBJ[i]["CATEGORY"] = "Incident"
/            }
/            if(retOBJ[i]["CATEGORY"] == '3'){
/                retOBJ[i]["CATEGORY"] = "Problem"
/            }
/            if(retOBJ[i]["CATEGORY"] == '4'){
/               retOBJ[i]["CATEGORY"] = "Task"
/            }
/
/            var newCell4 = newRow.insertCell(4);
/            var newText4 = document.createTextNode(retOBJ[i]["CATEGORY"]);
/            newCell4.appendChild(newText4);
/
/            if(retOBJ[i]["PRIORITY"] == '1'){
/                retOBJ[i]["PRIORITY"] = "Low"
/            }
/            if(retOBJ[i]["PRIORITY"] == '2'){
/                retOBJ[i]["PRIORITY"] = "Medium"
/            }
/            if(retOBJ[i]["PRIORITY"] == '3'){
/                retOBJ[i]["PRIORITY"] = "High"
/            }
/
/            var newCell5 = newRow.insertCell(5);
/            var newText5 = document.createTextNode(retOBJ[i]["PRIORITY"]);
/            newCell5.appendChild(newText5);
/        }
/    }
/
/   *************************************************************************************************************
*/


    function viewAllUnsolvedTickets(d){
        var tableRef = document.getElementById('allunsolvedtickets').getElementsByTagName('tbody')[0];
        const retOBJ = JSON.parse(d)

        $("#allunsolvedtickets > tbody" ).html();

        for(var i =0; i < retOBJ.length;i++){
            var newRow = tableRef.insertRow(tableRef.rows.length);
            newRow.setAttribute("style","background-color:transparent");

            var newCell0 = newRow.insertCell(0);
            var newCheckBox0 = document.createElement('input');
            newCheckBox0.type = 'checkbox';
            newCheckBox0.name = i;
            newCheckBox0.style = "width:20px;height:20px;margin:auto;";
            newCheckBox0.className = "rowCHKHRPAYROLLREGISTERDETAILEDITVOLUNTARYCONTRIBUTION";
            newCell0.appendChild(newCheckBox0);

            var newCell1 = newRow.insertCell(1);
            var spanElement = document.createElement("span");
            
            
            if(retOBJ[i]["STATUS"] == '1'){
                retOBJ[i]["STATUS"] = "New"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:#F8E472;padding:2px 20px 2px 20px;border-radius:5px;font-weight:bold;color:white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '2'){
                retOBJ[i]["STATUS"] = "Open"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '3'){
                retOBJ[i]["STATUS"] = "In Progress"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '4'){
                retOBJ[i]["STATUS"] = "Pending"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:royalblue;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '5'){
                retOBJ[i]["STATUS"] = "Solved"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:mediumseagreen;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            
          

            var newCell2 = newRow.insertCell(2);
            var newText2 = document.createTextNode(retOBJ[i]["TITLE"]);
            newCell2.appendChild(newText2);
            
            var newCell3 = newRow.insertCell(3);
            var newText3 = document.createTextNode(retOBJ[i]["REPORTED_BY"]);
            newCell3.appendChild(newText3);


            if(retOBJ[i]["CATEGORY"] == '1'){
                retOBJ[i]["CATEGORY"] = "Question"
            }
            if(retOBJ[i]["CATEGORY"] == '2'){
                retOBJ[i]["CATEGORY"] = "Incident"
            }
            if(retOBJ[i]["CATEGORY"] == '3'){
                retOBJ[i]["CATEGORY"] = "Problem"
            }
            if(retOBJ[i]["CATEGORY"] == '4'){
                retOBJ[i]["CATEGORY"] = "Task"
            }

            var newCell4 = newRow.insertCell(4);
            var newText4 = document.createTextNode(retOBJ[i]["CATEGORY"]);
            newCell4.appendChild(newText4);

            if(retOBJ[i]["PRIORITY"] == '1'){
                retOBJ[i]["PRIORITY"] = "Low"
            }
            if(retOBJ[i]["PRIORITY"] == '2'){
                retOBJ[i]["PRIORITY"] = "Medium"
            }
            if(retOBJ[i]["PRIORITY"] == '3'){
                retOBJ[i]["PRIORITY"] = "High"
            }

            var newCell5 = newRow.insertCell(5);
            var newText5 = document.createTextNode(retOBJ[i]["PRIORITY"]);
            newCell5.appendChild(newText5);
        }
    }

    function viewPendingTickets(d){
        var tableRef = document.getElementById('pendingtickets').getElementsByTagName('tbody')[0];
        const retOBJ = JSON.parse(d)

        $("#pendingtickets > tbody" ).html();

        for(var i =0; i < retOBJ.length;i++){
            var newRow = tableRef.insertRow(tableRef.rows.length);
            newRow.setAttribute("style","background-color:transparent");

            var newCell0 = newRow.insertCell(0);
            var newCheckBox0 = document.createElement('input');
            newCheckBox0.type = 'checkbox';
            newCheckBox0.name = i;
            newCheckBox0.style = "width:20px;height:20px;margin:auto;";
            newCheckBox0.className = "rowCHKHRPAYROLLREGISTERDETAILEDITVOLUNTARYCONTRIBUTION";
            newCell0.appendChild(newCheckBox0);

            var newCell1 = newRow.insertCell(1);
            var spanElement = document.createElement("span");
            
            
            if(retOBJ[i]["STATUS"] == '1'){
                retOBJ[i]["STATUS"] = "New"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:#F8E472;padding:2px 20px 2px 20px;border-radius:5px;font-weight:bold;color:white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '2'){
                retOBJ[i]["STATUS"] = "Open"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '3'){
                retOBJ[i]["STATUS"] = "In Progress"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:tomato;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '4'){
                retOBJ[i]["STATUS"] = "Pending"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:royalblue;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            if(retOBJ[i]["STATUS"] == '5'){
                retOBJ[i]["STATUS"] = "Solved"
                spanElement.textContent = retOBJ[i]["STATUS"];
                newCell1.appendChild(spanElement);
                spanElement.setAttribute("style", "background-color:mediumseagreen;padding:2px 20px 2px 20px;border-radius:5px;color: white;font-weight:700")
            }
            
          

            var newCell2 = newRow.insertCell(2);
            var newText2 = document.createTextNode(retOBJ[i]["TITLE"]);
            newCell2.appendChild(newText2);
            
            var newCell3 = newRow.insertCell(3);
            var newText3 = document.createTextNode(retOBJ[i]["REPORTED_BY"]);
            newCell3.appendChild(newText3);


            if(retOBJ[i]["CATEGORY"] == '1'){
                retOBJ[i]["CATEGORY"] = "Question"
            }
            if(retOBJ[i]["CATEGORY"] == '2'){
                retOBJ[i]["CATEGORY"] = "Incident"
            }
            if(retOBJ[i]["CATEGORY"] == '3'){
                retOBJ[i]["CATEGORY"] = "Problem"
            }
            if(retOBJ[i]["CATEGORY"] == '4'){
                retOBJ[i]["CATEGORY"] = "Task"
            }

            var newCell4 = newRow.insertCell(4);
            var newText4 = document.createTextNode(retOBJ[i]["CATEGORY"]);
            newCell4.appendChild(newText4);

            if(retOBJ[i]["PRIORITY"] == '1'){
                retOBJ[i]["PRIORITY"] = "Low"
            }
            if(retOBJ[i]["PRIORITY"] == '2'){
                retOBJ[i]["PRIORITY"] = "Medium"
            }
            if(retOBJ[i]["PRIORITY"] == '3'){
                retOBJ[i]["PRIORITY"] = "High"
            }

            var newCell5 = newRow.insertCell(5);
            var newText5 = document.createTextNode(retOBJ[i]["PRIORITY"]);
            newCell5.appendChild(newText5);
        }
    }
    // const suggestions = ;
// Event delegation for dynamically added input
const TagsContItem = [];
const TagsCont = [];
for(let i =0; i < Tags.length; i++){
   
    TagsContItem.push(Tags[i]["TAGS"])
}

TagsContItem.forEach(value => {
    const splitValues = value.split(",");

    splitValues.forEach(splitValue => {
        if (!TagsCont.includes(splitValue.trim())) {
            TagsCont.push(splitValue.trim());
        }
    });
});
$(document).on("input", "#autocomplete-input", function() {
    const $input = $(this);
    const val = $input.val().trim();
    closeAllLists();
    
    if (!val) return false;
    
    const $listContainer = $("<div>", {
        "id": this.id + "-autocomplete-list",
        "class": "autocomplete-items"
    });
    
    $input.parent().append($listContainer);
    
    let matchFound = false;

    

  
    
    $.each(TagsCont, function(i, tag) {
        if (tag.substr(0, val.length).toUpperCase() === val.toUpperCase()) {

            matchFound = true;

            const $item = $("<div>").html("<strong>" + tag.substr(0, val.length) + "</strong>" + tag.substr(val.length));

            $item.append($("<input>", {
                "type": "hidden",
                "value": tag
            }));

            $item.on("click", function() {
                const selectedValue = $(this).find("input").val();
                addTag(selectedValue);
                closeAllLists();
                $input.val(''); // Clear the input after selecting
            });
            
            $listContainer.append($item);
        }

    });

    // Clear existing keypress handler before adding a new one
    $input.off("keypress").on("keypress", function(e) {
        if (e.which === 9) { // tab key
            e.preventDefault(); // Prevent form submission if inside a form
            const text = $input.val().trim();
            if (text && !$(".tag").filter(function() { return $(this).text().trim() === text; }).length) {
                addTag(text);
            }
            text.split(',').forEach(text => {
                addTag(text);
            });
            closeAllLists();
            $input.val(''); // Clear the input after adding
        }
    });
    
});

// Handle blur event to add custom text as a tag if no match found
$(document).on("blur", "#autocomplete-input", function() {
    const $input = $(this);
    const val = $input.val().trim();
    if (val && !$(".autocomplete-items div").length) {
        if (!$(".tag").filter(function() { return $(this).text().trim() === val; }).length) {
            addTag(val);
        }
        closeAllLists();
        $input.val(''); // Clear the input after adding
        $(this).focus();
    }
    
});

function addTag(text) {
    const $input = $("#autocomplete-input");
    const $tagContainer = $("#tag-container");

    // Check if the string contains a semicolon
    if (text.indexOf(',') !== -1) {
        // Split the text by semicolon
        const tags = text.split(',');

        // Loop through the tags and create a tag for each
        tags.forEach(tagText => {
            // Trim whitespace from each tag
            const trimmedText = tagText.trim();
            if (trimmedText) { // Only add non-empty tags
                const $tag = $("<div>", { "class": "tag" }).text(trimmedText);
               
                const $closeBtn = $("<span>", { "class": "close-btn" }).text("x").on("click", function() {
                    $(this).parent().remove(); // Remove the tag when the close button is clicked
                });

                $tag.append($closeBtn);
                $tagContainer.append($tag);
            }
        });
    } else {
        // If no semicolon, just create a single tag
        const $tag = $("<div>", { "class": "tag" }).text(text);
        const $closeBtn = $("<span>", { "class": "close-btn" }).text("x").on("click", function() {
            $(this).parent().remove(); // Remove the tag when the close button is clicked
        });

        $tag.append($closeBtn);
        $tagContainer.append($tag);
    }

    $tagContainer.append($input); // Move the input after the tag
}

function closeAllLists(elmnt) {
    $(".autocomplete-items").each(function() {
        if (elmnt !== this && elmnt !== $("#autocomplete-input")[0]) {
            $(this).remove();
        }
    });
}

$(document).on("click", function(e) {
    closeAllLists(e.target);
});

   
});
