const user_menu_btn = document.getElementById('user_menu_btn');
const user_menu = document.getElementById('user_menu');

// Toggle menu visibility
user_menu_btn.addEventListener('click', (e) => {
    e.stopPropagation(); // Prevent this click from bubbling to the document
    user_menu.classList.toggle('hidden');
});

// Hide menu when clicking outside
document.addEventListener('click', (e) => {
    if (!user_menu.contains(e.target) && !user_menu_btn.contains(e.target)) {
        user_menu.classList.add('hidden');
    }
});

// Make the mobile menu work
document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.getElementById('mobile_menu_btn');
    const mobileMenu = document.getElementById('mobile_menu');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
});