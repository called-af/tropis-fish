<!-- Scroll To Top Button -->
<button
    id="scroll-to-top"
    class="fixed bottom-24 right-6 z-50 w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group opacity-0 invisible translate-y-4"
    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
    aria-label="Scroll to top"
>
    <x-heroicon-o-arrow-up class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" />
</button>

<!-- WhatsApp Button -->
<a
    href="https://wa.me/6282117723604"
    target="_blank"
    rel="noopener noreferrer"
    class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group"
    aria-label="Chat via WhatsApp"
>
    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-7 h-7 group-hover:scale-110 transition-transform duration-300"
        fill="currentColor"
        viewBox="0 0 24 24">
        <path d="M20.52 3.48A11.86 11.86 0 0 0 12.04 0C5.4 0 .02 5.38.02 12c0 2.12.55 4.2 1.6 6.05L0 24l6.13-1.6A11.95 11.95 0 0 0 12.04 24C18.66 24 24 18.62 24 12c0-3.2-1.25-6.22-3.48-8.52ZM12.04 21.82a9.8 9.8 0 0 1-5-1.37l-.36-.21-3.64.95.97-3.55-.24-.37a9.77 9.77 0 1 1 8.27 4.55Zm5.38-7.35c-.29-.15-1.72-.85-1.99-.95-.27-.1-.47-.15-.67.15-.2.29-.77.95-.95 1.15-.17.2-.35.22-.64.07-.29-.15-1.24-.46-2.36-1.48-.87-.77-1.45-1.72-1.62-2.01-.17-.29-.02-.45.13-.6.13-.13.29-.35.44-.53.15-.18.2-.3.3-.5.1-.2.05-.37-.03-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.5h-.57c-.2 0-.52.08-.79.37-.27.29-1.04 1.02-1.04 2.49s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.09 4.49.71.31 1.27.5 1.7.64.71.22 1.36.19 1.87.11.57-.09 1.72-.7 1.96-1.37.24-.67.24-1.25.17-1.37-.07-.12-.27-.2-.56-.35Z"/>
    </svg>
</a>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const scrollToTopBtn = document.getElementById('scroll-to-top');

    function handleScroll() {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.remove('opacity-0', 'invisible', 'translate-y-4');
            scrollToTopBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
        } else {
            scrollToTopBtn.classList.add('opacity-0', 'invisible', 'translate-y-4');
            scrollToTopBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
        }
    }

    window.addEventListener('scroll', handleScroll);
    handleScroll();
});
</script>