const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// Transmitter Modal

const openModalBtn = document.getElementById('openModalBtn');
if (openModalBtn) {
    openModalBtn.onclick = function() {
        document.getElementById('transmitterModal').style.display = 'flex';
    };
}

const closeModalBtn = document.getElementById('closeModalBtn');
if (closeModalBtn) {
    closeModalBtn.onclick = function() {
        document.getElementById('transmitterModal').style.display = 'none';
    };
}

// Delete Confirmation Modal

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteModal = document.getElementById('deleteConfirmModal');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    let deleteAction = null;

    if (deleteButtons && deleteButtons.length > 0 && deleteModal && cancelDeleteBtn && confirmDeleteBtn) {
        deleteButtons.forEach(function(btn) {
            if (btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    deleteAction = btn; // Save the button or related data for deletion
                    deleteModal.style.display = 'block';
                });
            }
        });

        cancelDeleteBtn.onclick = function() {
            deleteModal.style.display = 'none';
            deleteAction = null;
        };

        confirmDeleteBtn.onclick = function() {
            const transmitterId = deleteAction.dataset.id;
            const request = new XMLHttpRequest();
            request.open('DELETE','remove-transmitter');
            request.setRequestHeader('Content-Type', 'application/json');
            request.setRequestHeader('X-CSRF-Token', csrfToken);
            request.send(JSON.stringify({ id: transmitterId }));
            request.onreadystatechange = function() {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        deleteModal.style.display = 'none';
                        deleteAction = null;
                        location.reload();
                    } else {
                        // Handle error case
                        console.error('Error deleting transmitter:', request.responseText);
                        alert('Error deleting transmitter. Please try again.');
                        deleteModal.style.display = 'none';
                        deleteAction = null;
                    }
                }
            };
        };

        window.onclick = function(event) {
            if (event.target == deleteModal) {
                deleteModal.style.display = "none";
                deleteAction = null;
            }
        }
    }
});

// Edit Transmitter Modal

// Open edit modal and fill data
const editBtns = document.querySelectorAll('.edit-btn');
if (editBtns && editBtns.length > 0) {
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const nameInput = document.getElementById('edit_name');
            const budgetInput = document.getElementById('edit_budget');
            const professionInput = document.getElementById('edit_profession');
            const emailInput = document.getElementById('edit_email');
            const idInput = document.getElementById('edit_id');
            const modal = document.getElementById('editTransmitterModal');
            if (idInput) idInput.value = this.dataset.id || '';
            if (nameInput) nameInput.value = this.dataset.name || '';
            if (budgetInput) budgetInput.value = this.dataset.budget || '';
            if (professionInput) professionInput.value = this.dataset.profession || '';
            if (emailInput) emailInput.value = this.dataset.email || '';
            if (modal) modal.style.display = 'block';
        });
    });
}

// Close edit modal
const cancelEditBtn = document.getElementById('cancelEditBtn');
if (cancelEditBtn) {
    cancelEditBtn.onclick = function(e) {
        e.preventDefault();
        const modal = document.getElementById('editTransmitterModal');
        if (modal) modal.style.display = 'none';
    };
}

// close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('editTransmitterModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

// Controls the progress bar color based on the budget

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.progress-bar-inner').forEach(function(bar) {
        const percent = parseFloat(bar.getAttribute('data-percent'));
        if (percent < 50) {
            bar.style.background = '#28a745'; // green
        } else if (percent >= 50 && percent < 80) {
            bar.style.background = '#fd7e14'; // orange
        } else if (percent >= 80) {
            bar.style.background = '#dc3545'; // red
        }
    });
});


// Modal for editing budget

const editBudgetBtn = document.getElementById('editBudgetBtn');
const editBudgetModal = document.getElementById('editBudgetModal');
const closeBudgetModal = document.getElementById('closeBudgetModal');

if (editBudgetBtn && editBudgetModal) {
    editBudgetBtn.onclick = function() {
        editBudgetModal.style.display = 'flex';
    };
}

if (closeBudgetModal && editBudgetModal) {
    closeBudgetModal.onclick = function() {
        editBudgetModal.style.display = 'none';
    };
}

// Optional: close modal when clicking outside content
if (editBudgetModal) {
    editBudgetModal.onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
}

// Edit Line budget Model 
document.addEventListener('DOMContentLoaded', function () {
    const editLinesBtn = document.getElementById('editLinesBtn');
    const editLinesModal = document.getElementById('editLinesModal');
    const closeLinesModal = document.getElementById('closeLinesModal');

    if (editLinesBtn && editLinesModal) {
        editLinesBtn.addEventListener('click', function () {
            editLinesModal.style.display = 'block';
        });
    }

    if (closeLinesModal && editLinesModal) {
        closeLinesModal.addEventListener('click', function () {
            editLinesModal.style.display = 'none';
        });
    }

    // Optional: close modal when clicking outside content
    if (editLinesModal) {
        editLinesModal.addEventListener('click', function (e) {
            if (e.target === editLinesModal) {
                editLinesModal.style.display = 'none';
            }
        });
    }
});

// Notification Box
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('notification-btn');
    const box = document.getElementById('notification-box');
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        box.style.display = box.style.display === 'none' || box.style.display === '' ? 'block' : 'none';
    });
    document.addEventListener('click', function () {
        box.style.display = 'none';
    });
    box.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    // Remove notification on eye icon click
    const notifEyes = document.querySelectorAll('.notif-eye');
    if (notifEyes && notifEyes.length > 0) {
        notifEyes.forEach(function(eye) {
            eye.addEventListener('click', function(e) {
                e.stopPropagation();
                const li = this.closest('li');
                if (li) li.remove();
            });
        });
    }
});