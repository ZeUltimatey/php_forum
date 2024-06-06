document.addEventListener('DOMContentLoaded', (event) => {
    const toggleThemeButton = document.querySelector('#toggle-theme-button');

    if (toggleThemeButton) {
        toggleThemeButton.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                toggleThemeButton.innerHTML = '<i class="fas fa-moon"></i>'; // Moon icon for dark mode
                localStorage.setItem('theme', 'dark');
            } else {
                toggleThemeButton.innerHTML = '<i class="fas fa-sun"></i>'; // Sun icon for light mode
                localStorage.setItem('theme', 'light');
            }
        });
    }

    // Check for saved 'theme' in localStorage
    let theme = localStorage.getItem('theme');
    // If the user already visited and enabled darkMode
    // start things off with it on
    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
        toggleThemeButton.innerHTML = '<i class="fas fa-moon"></i>'; // Moon icon for dark mode
    } else {
        document.body.classList.remove('dark-mode');
        toggleThemeButton.innerHTML = '<i class="fas fa-sun"></i>'; // Sun icon for light mode
    }
});