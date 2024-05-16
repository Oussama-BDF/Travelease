/****************** links *************************/
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


/****************** Activity *************************/
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


/****************** Alert *************************/
// Rmove the alert from the screen
document.addEventListener("DOMContentLoaded", function() {
    var alert = document.querySelector(".alert");
    if(alert) {
        alert.style.transition = "opacity 2s";
        alert.style.opacity = 1;
    
        setTimeout(function() {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = 0;
            setTimeout(function() {
                $(alert).alert('close')
            }, 500);
        }, 3000);
    }
});


/****************** Preview Image *************************/
document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to all file input elements with the class 'image_upload'
    var fileInputs = document.querySelectorAll('.image_upload');
    fileInputs.forEach(function(input) {
        input.addEventListener('change', previewImage);
    });

    // Add event listener to all remove buttons with the class 'image_remove'
    var removeButtons = document.querySelectorAll('.image_remove');
    removeButtons.forEach(function(button) {
        button.addEventListener('click', removeImage);
    });

    // Add event listener to all remove checkboxs with the class 'image_delete'
    var deleteCheckbox = document.querySelectorAll('.image_delete');
    deleteCheckbox.forEach(function(checkbox) {
        checkbox.addEventListener('change', deleteImage);
    });
});

// Preview the image uploaded
function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function(){
        // Select the uploaded image view (uploaded_image_view)
        var uploadedImgView = input.parentElement.parentElement.querySelector('.uploaded_image_view');
        uploadedImgView.classList.add('show');
        // Select the image element
        var img = uploadedImgView.querySelector("img");
        img.src = reader.result;
        img.classList.add('show');
        if (imgView = uploadedImgView.parentElement.querySelector('.image_view')) {
            imgView.classList.remove('show');
        }
    };

    reader.readAsDataURL(input.files[0]);
}

// Remove the image uploaded
function removeImage(event) {
    var button = event.target;
    var uploadedImgView = button.parentElement;
    uploadedImgView.classList.remove('show');
    var img = uploadedImgView.querySelector("img");
    img.src = "#"; // Clear the image source
    img.classList.remove('show');
    var input = uploadedImgView.parentElement.querySelector(".image_upload");
    input.value = ""; // Clear the file input value

    if (imgView = uploadedImgView.parentElement.querySelector('.image_view')) {
        imgView.classList.add('show');
    }
}


/****************** Delete Image *************************/
function deleteImage(event) {
    var checkbox = event.target;
    var imgContainer = checkbox.parentElement;
    var input = imgContainer.parentElement.querySelector(".image_upload");
    var uploadImgButton = imgContainer.parentElement.querySelector(".btn_upload");
    // If checkbox is checked, disable the input; otherwise, enable it
    input.disabled = checkbox.checked;
    // Toggle the class disabled of the elements input and uploadImgButton
    input.classList.toggle('disabled');
    uploadImgButton.classList.toggle('disabled');
}


/****************** Add Action On Modal Form *************************/
document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to all call modal anchor with the class 'call-delete-modal'
    var callModal = document.querySelectorAll('.call-delete-modal');
    callModal.forEach(function(button) {
        button.addEventListener('click', function(event) {
            var actionValue = event.target.dataset.action;
            var form = document.getElementById("modal-form");
            form.setAttribute('action', actionValue)
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to all call modal anchor with the class 'call-edit-modal'
    var callModal = document.querySelectorAll('.call-edit-modal');
    callModal.forEach(function(button) {
        button.addEventListener('click', function(event) {
            var actionValue = event.target.dataset.action;
            var name = event.target.dataset.name;
            var form = document.getElementById("modal-form-edit");
            var input = document.getElementById("name");
            form.setAttribute('action', actionValue)
            input.setAttribute('value', name)
        });
    });
});

// Show an alert if an option not selected
function validateForm(formId) {
    var form = document.getElementById(formId);
    var statusSelect = form.elements['status'];
    
    if (statusSelect.value === '') {
        alert('Please select a status');
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

