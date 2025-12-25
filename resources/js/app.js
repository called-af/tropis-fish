// Lazy Loading Images dengan Intersection Observer
document.addEventListener('DOMContentLoaded', function() {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;

                // Load image
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }

                // Load srcset if exists
                if (img.dataset.srcset) {
                    img.srcset = img.dataset.srcset;
                    img.removeAttribute('data-srcset');
                }

                // Load background image
                if (img.dataset.bg) {
                    img.style.backgroundImage = `url(${img.dataset.bg})`;
                    img.removeAttribute('data-bg');
                }

                img.classList.remove('lazy');
                img.classList.add('lazy-loaded');
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '50px 0px',
        threshold: 0.01
    });

    // Observe all lazy images
    document.querySelectorAll('img[loading="lazy"], .lazy, [data-src], [data-bg]').forEach(img => {
        imageObserver.observe(img);
    });

    // Lazy Loading Videos
    const videoObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const video = entry.target;

                if (video.dataset.src) {
                    const source = video.querySelector('source');
                    if (source && video.dataset.src) {
                        source.src = video.dataset.src;
                        video.load();
                    }
                    video.removeAttribute('data-src');
                }

                observer.unobserve(video);
            }
        });
    }, {
        rootMargin: '100px 0px',
        threshold: 0.01
    });

    // Observe all lazy videos
    document.querySelectorAll('video[data-src]').forEach(video => {
        videoObserver.observe(video);
    });
});

// Preload critical resources
if ('connection' in navigator && navigator.connection.effectiveType !== 'slow-2g') {
    const criticalImages = document.querySelectorAll('img[data-preload="true"]');
    criticalImages.forEach(img => {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.as = 'image';
        link.href = img.src || img.dataset.src;
        document.head.appendChild(link);
    });
}

// Service Worker Registration untuk PWA (optional)
if ('serviceWorker' in navigator && import.meta.env.PROD) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {
            // Service worker not available
        });
    });
}
