// NAVIGATION MOBILE
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll pour les liens
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Gestion du panier
    const cartButton = document.querySelector('.btn-cart');
    const cartBadge = document.querySelector('.cart-badge');
    let cartCount = 0;

    cartButton.addEventListener('click', function() {
        console.log('Panier - Articles: ' + cartCount);
    });

    // Buttons interactifs
    document.querySelector('.btn-primary').addEventListener('click', function() {
        alert('Redirection vers la page de connexion/inscription');
    });

    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.benefit-card, .product-category, .service-item, .testimonial-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
});

// Fonction utilitaire pour les commandes
function addToCart(productId, productName) {
    console.log('Produit ajouté au panier: ' + productName);
    const badge = document.querySelector('.cart-badge');
    const currentCount = parseInt(badge.textContent);
    badge.textContent = currentCount + 1;
}