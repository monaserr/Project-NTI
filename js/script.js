const cards = document.querySelectorAll(".event-card");

const all = document.getElementById("all");
const workshop = document.getElementById("workshop");
const ai = document.getElementById("ai");
const competition = document.getElementById("competition");
const career = document.getElementById("career");
const hackathon = document.getElementById("hackathon");
function filter(category) {
  cards.forEach((card) => {
    if (category === "all" || card.dataset.category === category) {
      card.style.display = "block";
    } else {
      card.style.display = "none";
    }
  });
}
all.onclick = () => filter("all");
workshop.onclick = () => filter("Workshop");
ai.onclick = () => filter("AI");
competition.onclick = () => filter("Competition");
career.onclick = () => filter("Career");
hackathon.onclick = () => filter("Hackathon");

function openBooking(name, price) {
  document.getElementById("modalEventName").textContent = name;
  document.getElementById("modalPrice").textContent =
    price === 0 ? "Free" : `EGP ${price}`;
  document.getElementById("bookingTotal").innerHTML =
    price === 0 ? "Free" : `EGP ${price}`;
}