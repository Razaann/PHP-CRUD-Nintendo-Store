// Read cookie reliably for localhost
function getThemeCookie() {
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        const [name, value] = cookie.trim().split('=');
        if (name === 'theme') return value;
    }
    return 'light'; // Default
}

// Apply theme on load
function initTheme() {
    const theme = getThemeCookie();
    document.documentElement.setAttribute('data-theme', theme);
}

// Toggle and save with localhost compatibility
function toggleTheme() {
    const current = document.documentElement.getAttribute('data-theme') || 'light';
    const newTheme = current === 'light' ? 'dark' : 'light';

    document.documentElement.setAttribute('data-theme', newTheme);
    document.cookie = `theme=${newTheme}; path=/; max-age=${30 * 24 * 60 * 60}`; // 30 days
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function () {
    initTheme();
    initCardHoverEffect();
    initBuyButtonHandler();
});

// Mengatur agar saat pemilihan format gambar
// yang akan diupload bisa gambar atau link
document.getElementById('upload-option').addEventListener('change', function () {
    document.getElementById('upload-section').style.display = 'block';
    document.getElementById('url-section').style.display = 'none';
    document.getElementById('img_url').value = '';
});

document.getElementById('url-option').addEventListener('change', function () {
    document.getElementById('upload-section').style.display = 'none';
    document.getElementById('url-section').style.display = 'block';
    document.getElementById('img').value = '';
});

// Fungsi untuk animasi hover pada kartu game
function initCardHoverEffect() {
    $('.card').hover(
        function () {
            $(this).animate({ marginTop: "-10px" }, 200);
        },
        function () {
            $(this).animate({ marginTop: "0px" }, 200);
        }
    );
}