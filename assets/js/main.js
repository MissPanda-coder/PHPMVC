
// Gestion des messages flash
document.addEventListener('DOMContentLoaded', () => {
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(flash => {
        setTimeout(() => { 
            flash.style.display = 'none'; 
        }, 5000); // Ferme le message après 5 secondes

        flash.querySelector('.close').addEventListener('click', () => {
            flash.style.display = 'none';
        });
    });
});

const checkboxEffect = document.querySelector('.checkEffect');

checkboxEffect.addEventListener('click', () => {
        const displayEffects = document.querySelector('.hiddenEffect');
        if (checkboxEffect.checked) {
            displayEffects.style.display = "block";
        } else {
            displayEffects.style.display = "none";
        }
    });


const checkboxIngredient = document.querySelector('.checkIngredient');

checkboxIngredient.addEventListener('click', () => {
        const displayIngredients = document.querySelector('.hiddenIngredients');
        if (checkboxIngredient.checked) {
            displayIngredients.style.display = "block";
        } else {
            displayIngredients.style.display = "none";
        }
    });
