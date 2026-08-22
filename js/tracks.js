function toggleRoadmap(button) {
    button.classList.toggle("active");

    const roadmapContent = button.nextElementSibling;
    roadmapContent.classList.toggle("show");
}