function initModalEvents() {
    const modals = document.querySelectorAll('.doctor-modal');
    modals.forEach(modal => {
        if (modal.dataset.initiliazed) {
            return;
        }
        modal.dataset.initiliazed = "true";
        const closeBtn = modal.querySelector('.doctor-modal__content-header-close');
        closeBtn.addEventListener('click', () => {
            modal.remove();
        });
    });
}