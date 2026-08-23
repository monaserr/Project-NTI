function toggleRoadmap(button) {
    button.classList.toggle("active");

    const roadmapContent = button.nextElementSibling;
    roadmapContent.classList.toggle("show");
}

document.addEventListener("DOMContentLoaded", function () {

    const cards = document.querySelectorAll(".track-card");

    const observer = new IntersectionObserver(function (entries, observer) {

        entries.forEach(function (entry) {

            if (entry.isIntersecting) {

                entry.target.classList.add("show");

                observer.unobserve(entry.target);
            }

        });

    }, {
        threshold: 0.15
    });


    cards.forEach(function (card) {
        observer.observe(card);
    });

});