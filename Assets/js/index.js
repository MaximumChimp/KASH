$(document).ready(function() {
  // Cache jQuery selectors
  const $hamburger = $(".hamburger");
  const $navMenu = $(".nav-menu");
  const $navLink = $(".nav-link");

  // Function to toggle the menu
  function mobileMenu() {
      $hamburger.toggleClass("active");
      $navMenu.toggleClass("active");
  }


  // Function to close the menu
  function closeMenu() {
      $hamburger.removeClass("active");
      $navMenu.removeClass("active");
  }

  // Event listeners
  $hamburger.on("click", mobileMenu);
  $navLink.on("click", closeMenu);

  $('.tablinks').click(function() {
    $('.tablinks').removeClass('active');
    $(this).addClass('active');
  });


  var today = new Date();

  // Define arrays for month names and day names
  var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

  // Format the date
  var day = today.getDate();
  var month = monthNames[today.getMonth()];
  var dayOfWeek = dayNames[today.getDay()];

  // Create the formatted date string
  var formattedDate = `${day} ${month}, ${dayOfWeek}`;

  // Display the date in the #dateDisplay element
  $('#dateToday').text(formattedDate);


  var today = new Date();
            var currentDate = today.getDate();
            var currentMonth = today.getMonth();
            var currentYear = today.getFullYear();

            // Define arrays for day names
            var dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

            // Calculate the start of the week (Sunday) and the end of the week (Saturday)
            var startOfWeek = new Date(today);
            startOfWeek.setDate(today.getDate() - today.getDay()); // Move back to Sunday

            var endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6); // Move forward to Saturday


            // Populate the week with day names and dates
            var $weekDiv = $('.week');

            for (var i = 0; i < 7; i++) {
                var currentDay = new Date(startOfWeek);
                currentDay.setDate(startOfWeek.getDate() + i);

                var dayName = dayNames[currentDay.getDay()];
                var dayNumber = currentDay.getDate();
                
                // Create the dayblock element
                var $dayblock = $('<div>', { class: 'dayblock' });

                // Create and append the day name
                var $dayElem = $('<p>', { class: 'day', text: dayName });
                $dayblock.append($dayElem);

                // Create and append the day number
                var $dayNumberElem = $('<p>', { class: 'dayN', text: dayNumber });
                $dayblock.append($dayNumberElem);

                // Append dayblock to the week div
                $weekDiv.append($dayblock);
            }
            const ctx = document.getElementById('myDoughnutChart').getContext('2d');

    
function openContent(evt, cityName) {
    // Hide all elements with class="tabcontent"
    $(".tabcontent").hide();

    // Remove the class "active" from all elements with class="tablinks"
    $(".tablinks").removeClass("active");
    $('.tabcontent').removeClass('active');

    // Show the current tab, and add an "active" class to the link that opened the tab
    $("#" + cityName).show();
    $(evt.currentTarget).addClass("active");
}   

    // Attach click event to tab links
   
    $(".tablinks").click(function(evt) {
        var cityName = $(this).data("content");
        openContent(evt, cityName);
    });
    

// Example data values for each category


const dataValues = [30, 150, 1];
const total = dataValues.reduce((a, b) => a + b, 0);
const percentage = Math.round((dataValues[0] / total) * 100); // Percentage for "Solved"

const myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Solved Tickets', 'Pending Tickets', 'Unsolved Tickets'],
        datasets: [{
            data: dataValues,
            backgroundColor: [
                '#2ed47a', // Color for Solved
                '#ffb946', // Color for Pending
                '#f7685b'  // Color for Unsolved
            ],
            borderColor: [
                '#2ed47a', // Color for Solved
                '#ffb946', // Color for Pending
                '#f7685b'  // Color for Unsolved
            ],
            borderWidth: 2, // Border width for segments
            borderRadius: 10 // Set the border radius for rounded ends
        }]
    },
    options: {
        responsive: true,
        cutout: '95%', // Adjust this value to make the doughnut thinner
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 20
                }
            },
            tooltip: {
                enabled: true // Disable tooltips if not needed
            }
        }
    },
    plugins: [{
        beforeDraw: function(chart) {
            const width = chart.width,
                  height = chart.height,
                  ctx = chart.ctx;

            ctx.restore();
            const fontSize = (height / 200).toFixed(2); // Dynamic font size
            ctx.font = fontSize + "em sans-serif";
            ctx.textBaseline = "middle";
            ctx.textAlign = "center";
            const text = percentage + "%"; // Text to display
            const textX = Math.round((width - ctx.measureText(text).width) / 2);
            const textY = height / 2;

            ctx.fillText(text, textX, textY);
            ctx.save();
        }
    }]
});
});

