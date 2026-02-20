$(document).ready(function () {
    // Clear previous form data when modal is opened
    $("#editRoom").on("show.bs.modal", function () {
        $("#editform .is-invalid").removeClass("is-invalid");
        $("#editform .invalid-feedback").empty();
        $("#newImageContainer").hide();
        $("#editImg").val('');
    });

    // Handle edit button click
    $(".editroom").on("click", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        const code = $(this).data("code");
        
        $.ajax({
            url: "/dashboard/rooms/" + code + "/edit",
            type: "get",
            success: function (response) {
                // Populate form with room data
                $("#id").val(response.room.id);
                $("#editCode").val(response.room.code);
                $("#editName").val(response.room.name);
                $("#editFloor").val(response.room.floor);
                $("#editCapacity").val(response.room.capacity);
                $("#editBuildingId").val(response.room.building_id);
                $("#editType").val(response.room.type);
                $("#editDescription").val(response.room.description);
                
                // Set form action
                $("#editform").attr("action", "/dashboard/rooms/" + response.room.code);
                
                // Display current image if exists
                if (response.room.img) {
                    let imagePath;
                    if (response.room.img.startsWith('assets/')) {
                        imagePath = '/storage/' + response.room.img;
                    } else {
                        imagePath = '/' + response.room.img;
                    }
                    
                    $("#currentImage").attr("src", imagePath);
                    $("#currentImageContainer").show();
                } else {
                    $("#currentImageContainer").hide();
                }
            },
            error: function(xhr) {
                console.error("Error loading room data:", xhr);
                alert("Error loading room data");
            }
        });
    });

    // Handle form submission
    $("#editform").on("submit", function (e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr("action");
        const formData = new FormData(this);
        
        // Clear previous validation errors
        form.find(".is-invalid").removeClass("is-invalid");
        form.find(".invalid-feedback").empty();
        
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.success) {
                    // Find the correct row using the room code
                    const roomCode = $("#editCode").val();
                    const row = $(`.editroom[data-code="${roomCode}"]`).closest("tr");
                    
                    // Update table data
                    row.find("td").eq(1).text($("#editCode").val()); // Code column (shifted due to image column)
                    row.find("td").eq(2).find("a").text($("#editName").val()); // Name column
                    row.find("td").eq(3).text($("#editCapacity").val() + " Kursi"); // Capacity column
                    
                    // Update image if new image was uploaded
                    if ($("#editImg")[0].files && $("#editImg")[0].files[0]) {
                        const imageCell = row.find("td").eq(0); // Image column
                        const newImageSrc = $("#editRoomPreview").attr("src");
                        const roomName = $("#editName").val();
                        
                        imageCell.html(`
                            <img src="${newImageSrc}" alt="${roomName}" 
                                 class="img-thumbnail room-thumbnail" 
                                 style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                 onclick="showImageModal('${newImageSrc}', '${roomName}')">
                        `);
                    }
                    
                    // Update the data attributes and href
                    const editLink = row.find(".editroom");
                    editLink.attr("data-code", $("#editCode").val());
                    row.find("a[href*='/dashboard/rooms/']").attr("href", "/dashboard/rooms/" + $("#editCode").val());
                    
                    // Close modal
                    $("#editRoom").modal("hide");
                    
                    // Show success message
                    const alert = `
                        <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show" style="margin-top: 50px" role="alert">
                            Data ruangan berhasil diubah
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    $(".card-body .alert").remove(); // Remove any existing alerts
                    $(".card-body").prepend(alert);
                } else {
                    alert("Error updating room data");
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Validation error
                    const errors = xhr.responseJSON.errors;
                    if(errors) {
                        Object.keys(errors).forEach(function(key) {
                            let inputId = key;
                            // Map field names to input IDs
                            switch(key) {
                                case 'code': inputId = 'editCode'; break;
                                case 'name': inputId = 'editName'; break;
                                case 'floor': inputId = 'editFloor'; break;
                                case 'capacity': inputId = 'editCapacity'; break;
                                case 'building_id': inputId = 'editBuildingId'; break;
                                case 'type': inputId = 'editType'; break;
                                case 'description': inputId = 'editDescription'; break;
                                case 'img': inputId = 'editImg'; break;
                            }
                            
                            const input = $(`#${inputId}`);
                            input.addClass("is-invalid");
                            input.next(".invalid-feedback").text(errors[key][0]);
                        });
                    }
                } else {
                    alert("Error updating room data");
                }
            }
        });
    });
});

// Function to preview image
function previewImage(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            
            // For edit modal, show the new image container
            if (previewId === 'editRoomPreview') {
                document.getElementById('newImageContainer').style.display = 'block';
            }
        };
        
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        
        // For edit modal, hide the new image container
        if (previewId === 'editRoomPreview') {
            document.getElementById('newImageContainer').style.display = 'none';
        }
    }
}
