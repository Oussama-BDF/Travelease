(function () {
    "use strict";

    var tinyslider = function () {
        var el = document.querySelectorAll(".testimonial-slider");

        if (el.length > 0) {
            var slider = tns({
                container: ".testimonial-slider",
                items: 1,
                axis: "horizontal",
                controlsContainer: "#testimonial-nav",
                swipeAngle: false,
                speed: 700,
                nav: true,
                controls: true,
                autoplay: true,
                autoplayHoverPause: true,
                autoplayTimeout: 3500,
                autoplayButtonOutput: false,
            });
        }
    };
    tinyslider();

    var sitePlusMinus = function () {
        var value,
            quantity = document.getElementsByClassName("quantity-container");

        function createBindings(quantityContainer) {
            var quantityAmount =
                quantityContainer.getElementsByClassName("quantity-amount")[0];
            var increase =
                quantityContainer.getElementsByClassName("increase")[0];
            var decrease =
                quantityContainer.getElementsByClassName("decrease")[0];
            increase.addEventListener("click", function (e) {
                increaseValue(e, quantityAmount);
            });
            decrease.addEventListener("click", function (e) {
                decreaseValue(e, quantityAmount);
            });
        }

        function init() {
            for (var i = 0; i < quantity.length; i++) {
                createBindings(quantity[i]);
            }
        }

        function increaseValue(event, quantityAmount) {
            value = parseInt(quantityAmount.value, 10);

            console.log(quantityAmount, quantityAmount.value);

            value = isNaN(value) ? 0 : value;
            value++;
            quantityAmount.value = value;
        }

        function decreaseValue(event, quantityAmount) {
            value = parseInt(quantityAmount.value, 10);

            value = isNaN(value) ? 0 : value;
            if (value > 0) value--;

            quantityAmount.value = value;
        }

        init();
    };
    sitePlusMinus();
})();

/************************* Nav bar shrink *************************/
window.addEventListener("DOMContentLoaded", (event) => {
    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector("#mainNav");
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove("navbar-shrink");
        } else {
            navbarCollapsible.classList.add("navbar-shrink");
        }
    };

    // Shrink the navbar
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener("scroll", navbarShrink);
});


/************************* links *************************/
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
            link.classList.add("active");
            // Show the collapse
            var collapseElement = li.querySelector(".collapse");
            if (collapseElement) {
                var bootstrapCollapse = new bootstrap.Collapse(collapseElement);
                bootstrapCollapse.show();
            }
        }
    });
});


/************************* Image *************************/
document.addEventListener("DOMContentLoaded", function () {
    // Add event listener to all file input elements with the class 'image_upload'
    var fileInputs = document.querySelectorAll(".image_upload");
    fileInputs.forEach(function (input) {
        input.addEventListener("change", previewImage);
    });

    // Add event listener to all remove buttons with the class 'image_remove'
    var removeButtons = document.querySelectorAll(".image_remove");
    removeButtons.forEach(function (button) {
        button.addEventListener("click", removeImage);
    });

    // Add event listener to all remove checkboxs with the class 'image_delete'
    var deleteCheckbox = document.querySelectorAll(".image_delete");
    deleteCheckbox.forEach(function (checkbox) {
        checkbox.addEventListener("change", deleteImage);
    });
});

// Preview the image uploaded
function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function () {
        // Select the uploaded image view (uploaded_image_view)
        var uploadedImgView = input.parentElement.parentElement.querySelector(
            ".uploaded_image_view"
        );
        uploadedImgView.classList.add("show");
        // Select the image element
        var img = uploadedImgView.querySelector("img");
        img.src = reader.result;
        img.classList.add("show");
        if (
            (imgView =
                uploadedImgView.parentElement.querySelector(".image_view"))
        ) {
            imgView.classList.remove("show");
        }
    };

    reader.readAsDataURL(input.files[0]);
}

// Remove the image uploaded
function removeImage(event) {
    var button = event.target;
    // Check if the clicked element has the class "image_remove" or if its parent has the class
    if (button && !button.classList.contains("image_remove")) {
        button = button.parentElement;
    }

    var uploadedImgView = button.parentElement;
    console.log(uploadedImgView);
    uploadedImgView.classList.remove("show");
    var img = uploadedImgView.querySelector("img");
    console.log(img);
    img.src = "#"; // Clear the image source
    img.classList.remove("show");
    var input = uploadedImgView.parentElement.querySelector(".image_upload");
    input.value = ""; // Clear the file input value

    if (
        (imgView = uploadedImgView.parentElement.querySelector(".image_view"))
    ) {
        imgView.classList.add("show");
    }
}


/************************* Delete An Image *************************/
function deleteImage(event) {
    var checkbox = event.target;
    var imgContainer = checkbox.parentElement;
    var input = imgContainer.parentElement.querySelector(".image_upload");
    var uploadImgButton =
        imgContainer.parentElement.querySelector(".btn_upload");
    // If checkbox is checked, disable the input; otherwise, enable it
    input.disabled = checkbox.checked;
    // Toggle the class disabled of the elements input and uploadImgButton
    input.classList.toggle("disabled");
    uploadImgButton.classList.toggle("disabled");
}

/************************* Alert *************************/
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