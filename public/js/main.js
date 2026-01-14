import { Modal } from "./Modal.js";
import { menumaker } from "./utils/menu-responsive.js";
import { storeNewsletter } from "./utils/storeNewsletter.js";

const modal = new Modal(
    "#modal-attendance",
    "#open-modal-attendance",
    "#modal-close"
);
modal.init();

// Executa ao carregar a página
document.addEventListener("DOMContentLoaded", function () {
    const menuTop = document.getElementById("menu-dropdown-top");
    if (menuTop) {
        menumaker(menuTop, { format: "multitoggle" });
    }

    const menu = document.getElementById("menu-dropdown");
    if (menu) {
        menumaker(menu, { format: "multitoggle" });
    }

    const formNewsletter = document.getElementById("contact-newsletter-form");
    storeNewsletter(formNewsletter);
});
