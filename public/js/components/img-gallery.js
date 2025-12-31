const mainFeatured = document.getElementById("current-featured");
const lbModal = document.getElementById("lbModal");
const lbImg = document.getElementById("lbImg");
const thumbs = document.querySelectorAll(".item-thumb");
let currentIdx = 0;

thumbs.forEach((thumb, index) => {
    thumb.addEventListener("click", () => {
        // Muda imagem de destaque na página
        mainFeatured.src = thumb.getAttribute("data-full");

        // Gerencia classe ativa
        thumbs.forEach((t) => t.classList.remove("active"));
        thumb.classList.add("active");
        currentIdx = index;
    });
});

// Abre o Modal
function openModal(index) {
    currentIdx = index;
    console.log(thumbs[currentIdx]);
    lbImg.src = thumbs[currentIdx].getAttribute("data-full");
    lbModal.style.display = "flex";
}

// Evento no clique da imagem principal
mainFeatured.onclick = () => openModal(currentIdx);

// Navegação do Modal
document.querySelector(".lb-next").onclick = (e) => {
    e.stopPropagation();
    currentIdx = (currentIdx + 1) % thumbs.length;
    lbImg.src = thumbs[currentIdx].getAttribute("data-full");
};

document.querySelector(".lb-prev").onclick = (e) => {
    e.stopPropagation();
    currentIdx = (currentIdx - 1 + thumbs.length) % thumbs.length;
    lbImg.src = thumbs[currentIdx].getAttribute("data-full");
};

// Fechar
document.querySelector(".lb-close").onclick = () =>
    (lbModal.style.display = "none");
lbModal.onclick = (e) => {
    if (e.target === lbModal) lbModal.style.display = "none";
};
