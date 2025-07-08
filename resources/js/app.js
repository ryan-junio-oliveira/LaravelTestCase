import './bootstrap';

// Toggle mobile menu
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMobileMenu = document.getElementById('close-mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
        });
    }

    if (closeMobileMenu && mobileMenu) {
        closeMobileMenu.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
        });
    }

    // Close mobile menu when clicking outside
    if (mobileMenu) {
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }
});

// Dynamic step management for test cases
window.addTestStep = function() {
    const container = document.getElementById('steps-container');
    const stepCount = container.children.length;
    const newStepHtml = `
        <div class="step-item border border-gray-200 rounded-lg p-4">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium text-gray-700">Passo ${stepCount + 1}</span>
                <button type="button" onclick="removeTestStep(this)" class="p-1 text-red-600 hover:text-red-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ação</label>
                    <textarea name="steps[${stepCount}][action]" rows="2" class="form-textarea" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Resultado Esperado</label>
                    <textarea name="steps[${stepCount}][expected_result]" rows="2" class="form-textarea" required></textarea>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newStepHtml);
    updateStepNumbers();
};

window.removeTestStep = function(button) {
    const container = document.getElementById('steps-container');
    if (container.children.length > 1) {
        button.closest('.step-item').remove();
        updateStepNumbers();
    }
};

function updateStepNumbers() {
    const steps = document.querySelectorAll('.step-item');
    steps.forEach((step, index) => {
        const stepNumber = step.querySelector('span');
        if (stepNumber) {
            stepNumber.textContent = `Passo ${index + 1}`;
        }
        
        // Update input names
        const inputs = step.querySelectorAll('textarea');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/\[\d+\]/, `[${index}]`);
                input.setAttribute('name', newName);
            }
        });
    });
}