import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Код для автоматической отправки формы при смене статуса
const selectElements = document.querySelectorAll('.status-form #status_id');
console.log(selectElements);

for (let elem of selectElements) {
    elem.addEventListener('change', function() {
        this.form.submit(); // Отправляет форму, которой принадлежит select
    });
}