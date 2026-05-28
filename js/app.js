document.addEventListener('DOMContentLoaded', function () {

  const loadingOverlay = document.getElementById('loadingOverlay');

  // Show the loading overlay.
  function showLoading() { if (loadingOverlay) loadingOverlay.classList.add('active'); }
  // Hide the loading overlay.
  function hideLoading() { if (loadingOverlay) loadingOverlay.classList.remove('active'); }

  const taskForm = document.getElementById('taskForm');

  // Clear form validation messages.
  function clearErrors() { document.querySelectorAll('.form-error').forEach(el => { el.style.display = 'none'; el.textContent = '' }); document.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('invalid')); }
  // Display a validation error message.
  function showError(id, msg) { const el = document.getElementById(id); if (el) { el.textContent = msg; el.style.display = 'block'; } }

  if (taskForm) {
    // Validate the task form before submit.
    taskForm.addEventListener('submit', function (e) {

      clearErrors();

      const title = (document.getElementById('title') || {}).value || '';
      const priority = (document.getElementById('priority') || {}).value || '';

      let hasError = false;

      if (title.trim() === '') { 

        showError('titleError', 'Task title is required.'); 
        document.getElementById('title').classList.add('invalid'); hasError = true;
      
      }

      else if (title.trim().length < 3) { 
        showError('titleError', 'Title must be at least 3 characters.');
        document.getElementById('title').classList.add('invalid'); hasError = true; 
        }

      if (priority === '') {
         showError('priorityError', 'Please select a priority.'); 
         document.getElementById('priority').classList.add('invalid'); hasError = true; }

      if (hasError) { 
        e.preventDefault();
         return false;
        }

      showLoading();
    });
  }

  const searchInput = document.getElementById('searchInput');

  if (searchInput) {
    // Filter visible task rows as the user types.
    searchInput.addEventListener('keyup', function () {

      const q = this.value.toLowerCase().trim();
      let visible = 0;

      document.querySelectorAll('tr.task-row').forEach(function (row) {

        const title = (row.dataset.title || '').toLowerCase();

        if (title.indexOf(q) !== -1) { 
          row.style.display = ''; 
          visible++; 
        } else {
           row.style.display = 'none'; 
          }
      });

      const noResults = document.getElementById('noResults');

      if (noResults) noResults.style.display = (visible === 0 ? '' : 'none');
    });
  }

  document.querySelectorAll('.delete-link').forEach(function (link) {
    // Confirm delete actions before navigation.
    link.addEventListener('click', function (e) {
      e.preventDefault();

      if (confirm('Are you sure you want to delete this task?')) {
        showLoading();
        window.location.href = this.href;
      }
    });
  });

  const flash = document.getElementById('flashAlert');
  // Auto-hide flash messages after a short delay.
  if (flash) { 
    setTimeout(() => { flash.style.transition = 'opacity .4s'; 
    flash.style.opacity = '0'; setTimeout(() => flash.remove(), 450); }, 4000); }

});
