// Add An Activity
var btnAddActivity = document.getElementById('add-activity');
var activityContainer = document.getElementById('activity-container');
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

btnAddActivity.addEventListener('click', function () {
    var tempDiv = document.createElement('div'); // Create a temporary div element
    tempDiv.innerHTML = activity; // Set the HTML content of the temporary div
    var newElement = tempDiv.firstChild; // Get the first child of the temporary div (which is the div created from elementFile)
    activityContainer.appendChild(newElement); // Append the new element to elementsFiles
});

// Remove An Activity
var btnRemoveActivity = document.querySelectorAll('button.delete-activity')
function removeActivity(ele) {
    ele.parentNode.remove()
}
