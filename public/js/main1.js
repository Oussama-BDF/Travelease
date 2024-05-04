// Get the current URL
var currentUrl = window.location.href;

// Get all navigation links
var navLinks = document.querySelectorAll(".navbar-nav .nav-item");

// Loop through each link
navLinks.forEach(function (li) {
    // Get all <a> elements inside the <li>
    var links = li.querySelectorAll("a");

    // Check each <a> element
    links.forEach(function (link) {
        // Check if the link's href matches the current URL
        if (link.href === currentUrl) {
            // Add the "active" class to the parent <li> element
            li.classList.add("active");
            link.classList.add('active')
            // Show the collapse
            var collapseElement = li.querySelector('.collapse');
            if(collapseElement) {
                var bootstrapCollapse = new bootstrap.Collapse(collapseElement);
                bootstrapCollapse.show();
            }
        }
    });
});


// Add An Activity
var btnAddActivity = document.getElementById("add-activity");
var activityContainer = document.getElementById("activity-container");
if (btnAddActivity) {
    var activity = `<div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Activity Price:</label>
                            <input class="form-control" type="text" name="activity_price[]" placeholder="Enter activity price">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label>Activity Name:</label>
                            <input class="form-control" type="text" name="activity_name[]" placeholder="Enter activity name">
                        </div>
                    </div>
                    <button onclick="removeActivity(this)" id="delete-activity" type="button" class="delete-activity col-auto btn btn-danger rounded-circle">X</button>
                </div>`;
    btnAddActivity.addEventListener("click", function () {
        var tempDiv = document.createElement("div"); // Create a temporary div element
        tempDiv.innerHTML = activity; // Set the HTML content of the temporary div
        var newElement = tempDiv.firstChild; // Get the first child of the temporary div (which is the div created from elementFile)
        activityContainer.appendChild(newElement); // Append the new element to elementsFiles
    });
}

// Remove An Activity
var btnRemoveActivity = document.querySelectorAll("button.delete-activity");
function removeActivity(ele) {
    ele.parentNode.remove();
}

// Delete Image
function deleteImage(checkbox) {
    // Find the parent container of the checkbox
    const parentContainer = checkbox.parentNode;

    // Find the previous sibling (input element) of the parent container
    const input =
        parentContainer.previousElementSibling.querySelector(
            'input[type="file"]'
        );

    // If checkbox is checked, disable the input; otherwise, enable it
    input.disabled = checkbox.checked;
}
