document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const charCountDisplay = document.getElementById('char-count');
    const maxChars = 1000;
    const clearButton = document.querySelector('input[type="reset"]');

    updateCharCount();

    contentInput.addEventListener('input', function() {
        updateCharCount();
        
        if (contentInput.value.length > maxChars) {
            contentInput.value = contentInput.value.substring(0, maxChars);
        }
    });

    clearButton.addEventListener('click', function(e) {
        e.preventDefault(); 
        
        if (confirm('Are you sure you want to clear all content?')) {
            titleInput.value = '';
            contentInput.value = '';
            updateCharCount();
            
            titleInput.classList.remove('error');
            contentInput.classList.remove('error');
        }
    });

    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        titleInput.classList.remove('error');
        contentInput.classList.remove('error');
        
        if (titleInput.value.trim() === '') {
            titleInput.classList.add('error');
            isValid = false;
        }
        
        if (contentInput.value.trim() === '') {
            contentInput.classList.add('error');
            isValid = false;
        }
        
        if (contentInput.value.length > maxChars) {
            contentInput.classList.add('error');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            const firstError = document.querySelector('.error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    function updateCharCount() {
        const currentCount = contentInput.value.length;
        charCountDisplay.textContent = currentCount;
        
        charCountDisplay.className = '';
        
        if (currentCount >= maxChars) {
            charCountDisplay.classList.add('limit-reached');
        } else if (currentCount >= maxChars * 0.9) {
            charCountDisplay.classList.add('approaching-limit');
        }
    }
});