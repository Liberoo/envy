/**
 * Kamil Test Pattern Script
 * Testuje czy enqueue w patternach działa
 */

console.log('� KAMIL TEST PATTERN - Script załadowany!');
console.log('⏰ Timestamp:', new Date().toLocaleString());

// Sprawdź czy dane z wp_localize_script dotarły
if (typeof kamilTestPattern !== 'undefined') {
    console.log('✅ wp_localize_script działa!', kamilTestPattern);
    console.log('� Wiadomość z PHP:', kamilTestPattern.message);
    console.log('� Theme URL:', kamilTestPattern.theme_url);
} else {
    console.log('❌ wp_localize_script nie załadował danych');
}

// Dodaj event listener gdy DOM będzie gotowy
document.addEventListener('DOMContentLoaded', function() {
    console.log('� DOM załadowany - szukam patternu...');
    
    const pattern = document.querySelector('.kamil-test-enqueue-pattern');
    if (pattern) {
        console.log('� Pattern znaleziony!', pattern);
        
        // Dodaj klasę CSS do wizualnego potwierdzenia
        pattern.style.border = '3px solid #16a34a';
        pattern.style.borderRadius = '10px';
        pattern.style.padding = '20px';
        pattern.style.background = 'linear-gradient(45deg, #f0f9ff, #ecfdf5)';
        
        // Znajdź przycisk i dodaj dodatkowy event
        const button = pattern.querySelector('#kamil-test-button');
        if (button) {
            console.log('� Przycisk znaleziony!', button);
            
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('� SUKCES! wp_enqueue_script w patternie działa!');
                console.log('� Event details:', {
                    timestamp: new Date(),
                    pattern: pattern.className,
                    buttonId: button.id
                });
                
                // Pokaż alert jako dodatkowe potwierdzenie
                alert('� DZIAŁA! Sprawdź console (F12) po więcej detali.');
            });
        }
    } else {
        console.log('❌ Pattern nie znaleziony na stronie');
    }
});

// Test funkcji dostępnych w WordPress
console.log('� Testowanie dostępnych obiektów...');
console.log('jQuery dostępne?', typeof jQuery !== 'undefined' ? '✅ TAK' : '❌ NIE');
console.log('wp dostępne?', typeof wp !== 'undefined' ? '✅ TAK' : '❌ NIE');

// Dodaj marker że script się wykonał
window.kamilTestPatternLoaded = true;
console.log('✨ Kamil Test Pattern Script - GOTOWY!');
