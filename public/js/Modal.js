// Get the modal
export class Modal {
    constructor(modalId, buttonId, closeId) {
        this.modal = document.querySelector(modalId);
        this.btn = document.querySelector(buttonId);
        this.span = document.querySelector(closeId);
    }

    init() {
        // When the user clicks on the button, open the modal
        this.btn.onclick = () => {
            this.modal.style.display = "block";
        };

        // When the user clicks on <span> (x), close the modal
        this.span.onclick = () => {
            this.close();
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = (event) => {
            if (event.target == this.modal) {
                this.close();
            }
        };
    }

    close() {
        this.modal.style.display = "none";
    }
}
