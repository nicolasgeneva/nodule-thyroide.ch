document.addEventListener('DOMContentLoaded', function() {
    var header = document.querySelector('.header');
    var hamburger = document.querySelector('.hamburger');
    var nav = document.querySelector('.nav');
    var navLinks = document.querySelectorAll('.nav a');
    var faqItems = document.querySelectorAll('.faq-item');

    window.addEventListener('scroll', function() {
        header.classList.toggle('scrolled', window.scrollY > 50);
    });

    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        nav.classList.toggle('active');
    });

    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            nav.classList.remove('active');
        });
    });

    faqItems.forEach(function(item) {
        var btn = item.querySelector('.faq-question');
        var answer = item.querySelector('.faq-answer');
        btn.addEventListener('click', function() {
            var isActive = item.classList.contains('active');
            faqItems.forEach(function(other) {
                other.classList.remove('active');
                other.querySelector('.faq-answer').style.maxHeight = null;
            });
            if (!isActive) {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.benefit-card, .step-item, .gallery-item').forEach(function(el) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Cookie banner
    var banner = document.getElementById('cookie-banner');
    var acceptBtn = document.getElementById('cookie-accept');
    if (banner && !localStorage.getItem('cookies-accepted')) {
        banner.style.display = 'block';
    }
    if (acceptBtn) {
        acceptBtn.addEventListener('click', function() {
            localStorage.setItem('cookies-accepted', '1');
            banner.style.display = 'none';
        });
    }

    // Privacy modal
    var privacySection = document.getElementById('privacy');
    document.querySelectorAll('a[href="#privacy"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            privacySection.style.display = 'block';
        });
    });
    if (privacySection) {
        privacySection.addEventListener('click', function(e) {
            if (e.target === privacySection) {
                privacySection.style.display = 'none';
            }
        });
    }
});
