/**
 * Kamil Test FIXED Pattern Script
 * Åaduje siÄ™ TYLKO gdy pattern jest uÅ¼ywany na stronie
 */

console.log('í¾¯ KAMIL TEST FIXED PATTERN - Script zaÅ‚adowany TYLKO gdy pattern uÅ¼ywany!');
console.log('â° Timestamp:', new Date().toLocaleString());

// SprawdÅº czy dane z wp_localize_script dotarÅ‚y
if (typeof kamilTestFixedPattern !== 'undefined') {
    console.log('âœ… wp_localize_script dziaÅ‚a!', kamilTestFixedPattern);
    console.log('ï¿½ï¿½ WiadomoÅ›Ä‡ z PHP:', kamilTestFixedPattern.message);
    console.log('í¿  Theme URL:', kamilTestFixedPattern.theme_url);
} else {
    console.log('âŒ wp_localize_script nie zaÅ‚adowaÅ‚ danych');
}

// Dodaj event listener gdy DOM bÄ™dzie gotowy
document.addEventListener('DOMContentLoaded', function() {
    console.log('í³„ DOM zaÅ‚adowany - szukam FIXED patternu...');
    
    const pattern = document.querySelector('.kamil-test-enqueue-fixed-pattern');
    if (pattern) {
        console.log('í¾¯ FIXED Pattern znaleziony!', pattern);
        
        // Dodaj wizualne potwierdzenie
        pattern.style.border = '3px solid #dc2626';
        pattern.style.borderRadius = '10px';
        pattern.style.padding = '20px';
        pattern.style.background = 'linear-gradient(45deg, #fef2f2, #fee2e2)';
        
        // ZnajdÅº przycisk
        const button = pattern.querySelector('#kamil-test-fixed-button');
        if (button) {
            console.log('í´˜ FIXED Przycisk znaleziony!', button);
            
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('í¾‰ SUKCES! Conditional enqueue dziaÅ‚a poprawnie!');
                console.log('í¾¯ Script Å‚aduje siÄ™ TYLKO gdy pattern jest na stronie!');
                console.log('í³Š Event details:', {
                    timestamp: new Date(),
                    pattern: pattern.className,
                    buttonId: button.id,
                    message: 'FIXED Pattern works!'
                });
                
                alert('í¾¯ FIXED DZIAÅA! Script Å‚aduje siÄ™ tylko na stronach z tym patternem!');
            });
        }
    } else {
        console.log('âŒ FIXED Pattern nie znaleziony na stronie');
    }
});

// Test funkcji dostÄ™pnych w WordPress
console.log('í´ Testowanie dostÄ™pnych obiektÃ³w...');
console.log('jQuery dostÄ™pne?', typeof jQuery !== 'undefined' ? 'âœ… TAK' : 'âŒ NIE');
console.log('wp dostÄ™pne?', typeof wp !== 'undefined' ? 'âœ… TAK' : 'âŒ NIE');

// Dodaj marker Å¼e script siÄ™ wykonaÅ‚
window.kamilTestFixedPatternLoaded = true;
console.log('âœ¨ Kamil Test FIXED Pattern Script - GOTOWY!');
console.log('í¾¯ Ten script Å‚aduje siÄ™ TYLKO gdy pattern jest uÅ¼ywany na stronie!');
