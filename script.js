// Confirmation suppression
document.addEventListener("DOMContentLoaded", function(){
    const deleteLinks = document.querySelectorAll("a.btn-danger");
    deleteLinks.forEach(link => {
        link.addEventListener("click", function(e){
            if(!confirm("Êtes-vous sûr de vouloir supprimer ?")){
                e.preventDefault();
            }
        });
    });
});

// Animation fade-in pour les cartes
const cards = document.querySelectorAll(".card");
cards.forEach((card, index) => {
    card.style.opacity = 0;
    setTimeout(() => {
        card.style.transition = "opacity 0.8s ease-in-out";
        card.style.opacity = 1;
    }, index*150);
});

// Toast simple pour transactions
function showToast(message){
    let toast = document.createElement("div");
    toast.innerText = message;
    toast.style.position = "fixed";
    toast.style.bottom = "20px";
    toast.style.right = "20px";
    toast.style.backgroundColor = "#6f42c1";
    toast.style.color = "#fff";
    toast.style.padding = "10px 15px";
    toast.style.borderRadius = "5px";
    toast.style.boxShadow = "0px 2px 8px rgba(0,0,0,0.3)";
    document.body.appendChild(toast);
    setTimeout(()=>{ document.body.removeChild(toast); }, 3000);
}

// Exemple : on peut appeler showToast("Message") après une transaction réussie