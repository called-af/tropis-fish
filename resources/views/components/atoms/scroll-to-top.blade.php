<button
    id="scroll-to-top"
    class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group opacity-0 invisible translate-y-4"
    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
    aria-label="Scroll to top"
>
    <x-heroicon-o-arrow-up class="w-6 h-6 group-hover:scale-110 transition-transform" />
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollToTopBtn = document.getElementById('scroll-to-top');
        let lastScrollY = window.scrollY;

        function handleScroll() {
            const currentScrollY = window.scrollY;

            if (currentScrollY > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible', 'translate-y-4');
                scrollToTopBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible', 'translate-y-4');
                scrollToTopBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
            }

            lastScrollY = currentScrollY;
        }

        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check
    });
</script>
