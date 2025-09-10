/**
 * Kamil Test FIXED Pattern Script
 * Ładuje się TYLKO gdy pattern jest używany na stronie
 */

console.log('� KAMIL TEST FIXED PATTERN - Script załadowany TYLKO gdy pattern używany!');
console.log('⏰ Timestamp:', new Date().toLocaleString());

// Sprawdź czy dane z wp_localize_script dotarły
if (typeof kamilTestFixedPattern !== 'undefined') {
    console.log('✅ wp_localize_script działa!', kamilTestFixedPattern);
    console.log('�� Wiadomość z PHP:', kamilTestFixedPattern.message);
    console.log('� Theme URL:', kamilTestFixedPattern.theme_url);
} else {
    console.log('❌ wp_localize_script nie załadował danych');
}

// Dodaj event listener gdy DOM będzie gotowy
document.addEventListener('DOMContentLoaded', function() {
    console.log('� DOM załadowany - szukam FIXED patternu...');
    
    const pattern = document.querySelector('.kamil-test-enqueue-fixed-pattern');
    if (pattern) {
        console.log('� FIXED Pattern znaleziony!', pattern);
        
        // Dodaj wizualne potwierdzenie
        pattern.style.border = '3px solid #dc2626';
        pattern.style.borderRadius = '10px';
        pattern.style.padding = '20px';
        pattern.style.background = 'linear-gradient(45deg, #fef2f2, #fee2e2)';
        
        // Znajdź przycisk
        const button = pattern.querySelector('#kamil-test-fixed-button');
        if (button) {
            console.log('� FIXED Przycisk znaleziony!', button);
            
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('� SUKCES! Conditional enqueue działa poprawnie!');
                console.log('� Script ładuje się TYLKO gdy pattern jest na stronie!');
                console.log('� Event details:', {
                    timestamp: new Date(),
                    pattern: pattern.className,
                    buttonId: button.id,
                    message: 'FIXED Pattern works!'
                });
                
                alert('� FIXED DZIAŁA! Script ładuje się tylko na stronach z tym patternem!');
            });
        }
    } else {
        console.log('❌ FIXED Pattern nie znaleziony na stronie');
    }
});

// Test funkcji dostępnych w WordPress
console.log('� Testowanie dostępnych obiektów...');
console.log('jQuery dostępne?', typeof jQuery !== 'undefined' ? '✅ TAK' : '❌ NIE');
console.log('wp dostępne?', typeof wp !== 'undefined' ? '✅ TAK' : '❌ NIE');

// Dodaj marker że script się wykonał
window.kamilTestFixedPatternLoaded = true;
console.log('✨ Kamil Test FIXED Pattern Script - GOTOWY!');
console.log('� Ten script ładuje się TYLKO gdy pattern jest używany na stronie!');
