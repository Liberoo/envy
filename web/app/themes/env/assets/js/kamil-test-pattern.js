/**
 * Kamil Test Pattern Script
 * Testuje czy enqueue w patternach dziaÅ‚a
 */

console.log('íº€ KAMIL TEST PATTERN - Script zaÅ‚adowany!');
console.log('â° Timestamp:', new Date().toLocaleString());

// SprawdÅº czy dane z wp_localize_script dotarÅ‚y
if (typeof kamilTestPattern !== 'undefined') {
    console.log('âœ… wp_localize_script dziaÅ‚a!', kamilTestPattern);
    console.log('í³§ WiadomoÅ›Ä‡ z PHP:', kamilTestPattern.message);
    console.log('í¿  Theme URL:', kamilTestPattern.theme_url);
} else {
    console.log('âŒ wp_localize_script nie zaÅ‚adowaÅ‚ danych');
}

// Dodaj event listener gdy DOM bÄ™dzie gotowy
document.addEventListener('DOMContentLoaded', function() {
    console.log('í³„ DOM zaÅ‚adowany - szukam patternu...');
    
    const pattern = document.querySelector('.kamil-test-enqueue-pattern');
    if (pattern) {
        console.log('í¾¯ Pattern znaleziony!', pattern);
        
        // Dodaj klasÄ™ CSS do wizualnego potwierdzenia
        pattern.style.border = '3px solid #16a34a';
        pattern.style.borderRadius = '10px';
        pattern.style.padding = '20px';
        pattern.style.background = 'linear-gradient(45deg, #f0f9ff, #ecfdf5)';
        
        // ZnajdÅº przycisk i dodaj dodatkowy event
        const button = pattern.querySelector('#kamil-test-button');
        if (button) {
            console.log('í´˜ Przycisk znaleziony!', button);
            
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('í¾‰ SUKCES! wp_enqueue_script w patternie dziaÅ‚a!');
                console.log('í³Š Event details:', {
                    timestamp: new Date(),
                    pattern: pattern.className,
                    buttonId: button.id
                });
                
                // PokaÅ¼ alert jako dodatkowe potwierdzenie
                alert('í¾‰ DZIAÅA! SprawdÅº console (F12) po wiÄ™cej detali.');
            });
        }
    } else {
        console.log('âŒ Pattern nie znaleziony na stronie');
    }
});

// Test funkcji dostÄ™pnych w WordPress
console.log('í´ Testowanie dostÄ™pnych obiektÃ³w...');
console.log('jQuery dostÄ™pne?', typeof jQuery !== 'undefined' ? 'âœ… TAK' : 'âŒ NIE');
console.log('wp dostÄ™pne?', typeof wp !== 'undefined' ? 'âœ… TAK' : 'âŒ NIE');

// Dodaj marker Å¼e script siÄ™ wykonaÅ‚
window.kamilTestPatternLoaded = true;
console.log('âœ¨ Kamil Test Pattern Script - GOTOWY!');
