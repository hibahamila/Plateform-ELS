
// document.addEventListener("DOMContentLoaded", function () {
//     let responseCountInput = document.getElementById("response_count");
//     let reponsesContainer = document.getElementById("reponses-container");
//     let existingResponses = JSON.parse(document.getElementById("existing-responses")?.textContent || "[]");
//     let errorMessage = document.getElementById("error-message");
//     let dynamicResponsesInput = document.getElementById("dynamic-responses");

//     // Fonction pour vider le conteneur des réponses
//     function clearResponseFields() {
//         reponsesContainer.innerHTML = ''; // Vide le conteneur des réponses
//     }

//     // Fonction pour ajouter un champ de réponse
//     function addResponseField(index, existingReponse = { contenu: "", est_correcte: 0, id: "" }) {
//         let reponseDiv = document.createElement("div");
//         reponseDiv.classList.add("mb-3", "d-flex", "align-items-center", "reponse-item");

//         reponseDiv.innerHTML = `
//             <input type="text" name="reponses[${index}][contenu]" class="form-control me-2 response-input"
//                    value="${existingReponse.contenu}" required>
//             <input type="hidden" name="reponses[${index}][id]" value="${existingReponse.id}">
//             <input type="hidden" name="reponses[${index}][est_correcte]" value="0">
//             <input type="checkbox" name="reponses[${index}][est_correcte]" value="1" ${existingReponse.est_correcte ? 'checked' : ''}>
//             <button type="button" class="btn btn-danger btn-sm ms-2 remove-btn">X</button>
           
//             <div class="invalid-feedback">Veuillez entrer une réponse valide.</div>
//         `;

//         reponsesContainer.appendChild(reponseDiv);
//         updateRemoveButtons();
//         updateDynamicResponsesInput();
//     }

//     function updateRemoveButtons() {
//         document.querySelectorAll(".remove-btn").forEach(button => {
//             button.onclick = function () {
//                 if (document.querySelectorAll(".reponse-item").length > 1) {
//                     this.parentElement.remove();
//                     reindexResponseFields();
//                     responseCountInput.value = document.querySelectorAll(".reponse-item").length;
//                     updateDynamicResponsesInput();
//                 }
//             };
//         });
//     }

//     function reindexResponseFields() {
//         document.querySelectorAll(".reponse-item").forEach((item, index) => {
//             item.querySelector('input[name*="[contenu]"]').setAttribute("name", `reponses[${index}][contenu]`);
//             item.querySelector('input[name*="[id]"]').setAttribute("name", `reponses[${index}][id]`);
//             item.querySelector('input[name*="[est_correcte]"]').setAttribute("name", `reponses[${index}][est_correcte]`);
//             item.querySelector('input[type="checkbox"]').setAttribute("name", `reponses[${index}][est_correcte]`);
//         });
//     }

//     function updateDynamicResponsesInput() {
//         let responses = [];
//         document.querySelectorAll(".reponse-item").forEach((item, index) => {
//             let contenu = item.querySelector('input[name*="[contenu]"]').value;
//             let id = item.querySelector('input[name*="[id]"]').value;
//             let est_correcte = item.querySelector('input[type="checkbox"]').checked ? 1 : 0;
//             responses.push({ contenu, id, est_correcte });
//         });
//         dynamicResponsesInput.value = JSON.stringify(responses);
//     }

//     function generateResponseFields(responseCount) {
//         let currentFields = document.querySelectorAll(".reponse-item").length;

//         for (let i = currentFields; i < responseCount; i++) {
//             addResponseField(i);
//         }

//         while (document.querySelectorAll(".reponse-item").length > responseCount) {
//             reponsesContainer.lastChild.remove();
//         }

//         responseCountInput.value = responseCount;
//         updateDynamicResponsesInput();
//     }

//     // Vider les réponses existantes avant de générer de nouvelles réponses
//     clearResponseFields();

//     if (existingResponses.length > 0) {
//         existingResponses.forEach((reponse, index) => {
//             addResponseField(index, reponse);
//         });
//     }

//     if (dynamicResponsesInput.value) {
//         let dynamicResponses = JSON.parse(dynamicResponsesInput.value);
//         dynamicResponses.forEach((reponse, index) => {
//             if (!document.querySelector(`input[name="reponses[${index}][contenu]"]`)) {
//                 addResponseField(index, reponse);
//             }
//         });
//     }

//     responseCountInput.addEventListener("change", function () {
//         let responseCount = parseInt(this.value);
//         if (responseCount < 1) responseCount = 1;
//         generateResponseFields(responseCount);
//     });

//     document.querySelector("form").addEventListener("submit", function (event) {
//         let isEmptyField = false;
//         let isNoChecked = false;

//         // Vérification des champs vides
//         document.querySelectorAll(".response-input").forEach(input => {
//             input.classList.remove("is-invalid");
//         });
//         document.querySelectorAll(".invalid-feedback").forEach(feedback => {
//             feedback.style.display = "none";
//         });

//         document.querySelectorAll(".response-input").forEach(input => {
//             if (!input.value.trim()) {
//                 input.classList.add("is-invalid");
//                 input.parentElement.querySelector(".invalid-feedback").style.display = "block";
//                 isEmptyField = true;
//             }
//         });

//         // Vérification des cases cochées
//         let atLeastOneChecked = false;
//         document.querySelectorAll('input[type="checkbox"][name*="[est_correcte]"]').forEach(checkbox => {
//             if (checkbox.checked) {
//                 atLeastOneChecked = true;
//             }
//         });

//         // Affichage du message d'erreur pour les cases cochées
//         if (!atLeastOneChecked) {
//             isNoChecked = true;
//             errorMessage.style.display = "block";
//             errorMessage.textContent = "Vous devez sélectionner au moins une réponse correcte.";
            
//             // Disparition après 3 secondes
//             setTimeout(function() {
//                 errorMessage.style.display = "none";
//             }, 3000);
//         } else {
//             errorMessage.style.display = "none";
//         }
        
//         // Pour faire disparaître les messages des champs vides après 3 secondes
//         if (isEmptyField) {
//             setTimeout(function() {
//                 document.querySelectorAll(".is-invalid").forEach(input => {
//                     input.classList.remove("is-invalid");
//                 });
//                 document.querySelectorAll(".invalid-feedback").forEach(feedback => {
//                     feedback.style.display = "none";
//                 });
//             }, 3000);
//         }

//         // Empêcher la soumission du formulaire si des erreurs sont présentes
//         if (isEmptyField || isNoChecked) {
//             event.preventDefault();
//         }
//     });
// });







document.addEventListener("DOMContentLoaded", function () {
    let responseCountInput = document.getElementById("response_count");
    let reponsesContainer = document.getElementById("reponses-container");
    let existingResponses = JSON.parse(document.getElementById("existing-responses")?.textContent || "[]");
    let errorMessage = document.getElementById("error-message");
    let dynamicResponsesInput = document.getElementById("dynamic-responses");

    // Fonction pour vider le conteneur des réponses
    function clearResponseFields() {
        reponsesContainer.innerHTML = ''; // Vide le conteneur des réponses
    }

    // Fonction pour ajouter un champ de réponse
    function addResponseField(index, existingReponse = { contenu: "", est_correcte: 0, id: "" }) {
        let reponseDiv = document.createElement("div");
        reponseDiv.classList.add("mb-3", "d-flex", "align-items-center", "reponse-item");

        reponseDiv.innerHTML = `
            <input type="text" name="reponses[${index}][contenu]" class="form-control me-2 response-input"
                   value="${existingReponse.contenu}" required>
            <input type="hidden" name="reponses[${index}][id]" value="${existingReponse.id}">
            <input type="hidden" name="reponses[${index}][est_correcte]" value="0">
            <input type="checkbox" name="reponses[${index}][est_correcte]" value="1" ${existingReponse.est_correcte ? 'checked' : ''}>
            <button type="button" class="btn btn-danger btn-sm ms-2 remove-btn"><i class="fas fa-trash"></i></button>
            <div class="invalid-feedback">Veuillez entrer une réponse valide.</div>
        `;

        reponsesContainer.appendChild(reponseDiv);
        updateRemoveButtons();
        updateDynamicResponsesInput();
    }

    function updateRemoveButtons() {
        document.querySelectorAll(".remove-btn").forEach(button => {
            button.onclick = function () {
                if (document.querySelectorAll(".reponse-item").length > 1) {
                    this.parentElement.remove();
                    reindexResponseFields();
                    responseCountInput.value = document.querySelectorAll(".reponse-item").length;
                    updateDynamicResponsesInput();
                }
            };
        });
    }

    function reindexResponseFields() {
        document.querySelectorAll(".reponse-item").forEach((item, index) => {
            item.querySelector('input[name*="[contenu]"]').setAttribute("name", `reponses[${index}][contenu]`);
            item.querySelector('input[name*="[id]"]').setAttribute("name", `reponses[${index}][id]`);
            item.querySelector('input[name*="[est_correcte]"]').setAttribute("name", `reponses[${index}][est_correcte]`);
            item.querySelector('input[type="checkbox"]').setAttribute("name", `reponses[${index}][est_correcte]`);
        });
    }

    function updateDynamicResponsesInput() {
        let responses = [];
        document.querySelectorAll(".reponse-item").forEach((item, index) => {
            let contenu = item.querySelector('input[name*="[contenu]"]').value;
            let id = item.querySelector('input[name*="[id]"]').value;
            let est_correcte = item.querySelector('input[type="checkbox"]').checked ? 1 : 0;
            responses.push({ contenu, id, est_correcte });
        });
        dynamicResponsesInput.value = JSON.stringify(responses);
    }

    function generateResponseFields(responseCount) {
        let currentFields = document.querySelectorAll(".reponse-item").length;

        for (let i = currentFields; i < responseCount; i++) {
            addResponseField(i);
        }

        while (document.querySelectorAll(".reponse-item").length > responseCount) {
            reponsesContainer.lastChild.remove();
        }

        responseCountInput.value = responseCount;
        updateDynamicResponsesInput();
    }

    // Vider les réponses existantes avant de générer de nouvelles réponses
    clearResponseFields();

    if (existingResponses.length > 0) {
        existingResponses.forEach((reponse, index) => {
            addResponseField(index, reponse);
        });
    }

    if (dynamicResponsesInput.value) {
        let dynamicResponses = JSON.parse(dynamicResponsesInput.value);
        dynamicResponses.forEach((reponse, index) => {
            if (!document.querySelector(`input[name="reponses[${index}][contenu]"]`)) {
                addResponseField(index, reponse);
            }
        });
    }

    responseCountInput.addEventListener("change", function () {
        let responseCount = parseInt(this.value);
        if (responseCount < 1) responseCount = 1;
        generateResponseFields(responseCount);
    });

    document.querySelector("form").addEventListener("submit", function (event) {
        let isEmptyField = false;
        let isNoChecked = false;

        // Vérification des champs vides
        document.querySelectorAll(".response-input").forEach(input => {
            input.classList.remove("is-invalid");
        });
        document.querySelectorAll(".invalid-feedback").forEach(feedback => {
            feedback.style.display = "none";
        });

        document.querySelectorAll(".response-input").forEach(input => {
            if (!input.value.trim()) {
                input.classList.add("is-invalid");
                input.parentElement.querySelector(".invalid-feedback").style.display = "block";
                isEmptyField = true;
            }
        });

        // Vérification des cases cochées
        let atLeastOneChecked = false;
        document.querySelectorAll('input[type="checkbox"][name*="[est_correcte]"]').forEach(checkbox => {
            if (checkbox.checked) {
                atLeastOneChecked = true;
            }
        });

        // Affichage du message d'erreur pour les cases cochées
        if (!atLeastOneChecked) {
            isNoChecked = true;
            errorMessage.style.display = "block";
            errorMessage.textContent = "Vous devez sélectionner au moins une réponse correcte.";
            
            // Disparition après 3 secondes
            setTimeout(function() {
                errorMessage.style.display = "none";
            }, 3000);
        } else {
            errorMessage.style.display = "none";
        }
        
        // Pour faire disparaître les messages des champs vides après 3 secondes
        if (isEmptyField) {
            setTimeout(function() {
                document.querySelectorAll(".is-invalid").forEach(input => {
                    input.classList.remove("is-invalid");
                });
                document.querySelectorAll(".invalid-feedback").forEach(feedback => {
                    feedback.style.display = "none";
                });
            }, 3000);
        }

        // Empêcher la soumission du formulaire si des erreurs sont présentes
        if (isEmptyField || isNoChecked) {
            event.preventDefault();
        }
    });
});





