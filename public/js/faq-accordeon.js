const questions = document.querySelectorAll(".faq-question");

questions.forEach((question) => {
    question.addEventListener("click", () => {
        const item = question.parentElement;
        const answer = item.querySelector(".faq-answer");
        const isOpen = item.classList.contains("active");

        document.querySelectorAll(".faq-item").forEach((otherItem) => {
            otherItem.classList.remove("active");
            otherItem.querySelector(".faq-answer").style.maxHeight = null;
        });

        if (!isOpen) {
            item.classList.add("active");
            answer.style.maxHeight = answer.scrollHeight + "px";
        }
    });
});
