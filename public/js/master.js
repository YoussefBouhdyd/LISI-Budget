// Transmitter Modal

document.getElementById('openModalBtn').onclick = function() {
    document.getElementById('transmitterModal').style.display = 'flex';
};

document.getElementById('closeModalBtn').onclick = function() {
    document.getElementById('transmitterModal').style.display = 'none';
};

// Delete Confirmation Modal

document.addEventListener('DOMContentLoaded', function () {
    let deleteBtns = document.querySelectorAll('.delete-btn');
    let deleteModal = document.getElementById('deleteConfirmModal');
    let cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    let confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    let deleteAction = null;

    deleteBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            deleteAction = btn; // Save the button or related data for deletion
            deleteModal.style.display = 'block';
        });
    });

    cancelDeleteBtn.onclick = function() {
        deleteModal.style.display = 'none';
        deleteAction = null;
    };

    confirmDeleteBtn.onclick = function() {
        // Here you should trigger the actual deletion (e.g., submit a form or send AJAX)
        // For demo, just hide the modal
        deleteModal.style.display = 'none';
        // Example: remove the row from the table (for demo only)
        if(deleteAction) {
            let row = deleteAction.closest('tr');
            if(row) row.remove();
        }
        deleteAction = null;
    };

    window.onclick = function(event) {
        if (event.target == deleteModal) {
            deleteModal.style.display = "none";
            deleteAction = null;
        }
    }
});

// Edit Transmitter Modal

// Open edit modal and fill data
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('edit_name').value = this.dataset.name;
        document.getElementById('edit_budget').value = this.dataset.budget;
        document.getElementById('edit_date').value = this.dataset.date;
        document.getElementById('edit_profession').value = this.dataset.profession;
        document.getElementById('editTransmitterModal').style.display = 'block';
    });
});

// Close edit modal
document.getElementById('cancelEditBtn').onclick = function(e) {
    e.preventDefault();
    document.getElementById('editTransmitterModal').style.display = 'none';
};

// close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('editTransmitterModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
};