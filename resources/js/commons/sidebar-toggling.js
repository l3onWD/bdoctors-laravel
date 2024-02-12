// DOM Elems
const sidebarElem = document.querySelector('.app-sidebar');
const sidebarToggler = document.querySelector('.app-sidebar-toggler');
const sidebarOverlay = document.querySelector('.app-sidebar-overlay');

if (sidebarElem && sidebarToggler && sidebarOverlay) {

    // Functions
    const sidebarToggle = () => {
        sidebarToggler.classList.toggle('is-open');
        sidebarElem.classList.toggle('is-open');
        sidebarOverlay.classList.toggle('is-open');

        if (sidebarToggler.classList.contains('is-open')) {
            togglerIcon.classList.remove('fa-angle-right');
            togglerIcon.classList.add('fa-close');
        } else {
            togglerIcon.classList.add('fa-angle-right');
            togglerIcon.classList.remove('fa-close');
        }
    }

    // Logic
    // Get icon elem
    const togglerIcon = sidebarToggler.querySelector('i');

    // Events
    sidebarToggler.addEventListener('click', sidebarToggle);
    sidebarOverlay.addEventListener('click', sidebarToggle);
}