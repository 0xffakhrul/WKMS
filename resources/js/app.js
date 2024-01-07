import "./bootstrap";
import Swal from "sweetalert2";

document.addEventListener("DOMContentLoaded", function () {
    const rejectButton = document.getElementById("reject-btn");

    if (rejectButton) {
        rejectButton.addEventListener("click", function () {
            Swal.fire({
                title: "Enter Rejection Reason",
                input: "text",
                inputLabel: "Reason",
                inputPlaceholder: "Enter the reason for rejection",
                showCancelButton: true,
                confirmButtonText: "Submit",
                cancelButtonText: "Cancel",
                showLoaderOnConfirm: true,
                preConfirm: (reason) => {
                    if (reason) {
                        submitFormWithReason(reason);
                    } else {
                        Swal.showValidationMessage(
                            "Please enter a reason for rejection"
                        );
                    }
                },
            });
        });
    }

    function submitFormWithReason(reason) {
        let formData = new FormData();
        formData.append("rejection_reason", reason);

        fetch(document.getElementById("leave-form").action, {
            method: "PUT", // Change this to PUT
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        })
            .then((response) => response.json())
            .then((data) => handleResponse(data))
            .catch((error) => handleError(error));
    }

    function handleResponse(data) {
        console.log("Response:", data);

        if (data.success) {
            Swal.fire({
                title: "Leave Rejected!",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
            });
            // Optionally, you can redirect or perform other actions
        } else {
            Swal.fire({
                title: "Error!",
                text: "Failed to reject leave.",
                icon: "error",
                confirmButtonText: "OK",
            });
        }
    }

    function handleError(error) {
        console.error("Error:", error);
    }
});

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
