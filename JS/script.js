const images = [
  { src: "../images/campus.jpg", info: "Main Building: Administrative offices and classrooms." },
  { src: "../images/library.jpeg", info: "Library: Over 10,000 books and digital resources." },
  { src: "../images/lab.jpeg", info: "Computer Lab: Equipped with modern systems and internet." },
  { src: "../images/mess.jpeg", info: "Mess : Hygiene & Quality,Unlimited Quantity,Guest Access facilities,Meal Schedule." },
  { src: "../images/porch.jpg", info: "Corridor :Clean Corridor areas" },
  { src: "../images/sports.jpg", info: "Sports Ground: Football, cricket, and athletics facilities." },
  { src: "../images/innovation.jpg", info: "innovation" },
  { src: "../images/symbol.jpg", info: "Symbol of Collage" }
];

let currentIndex = 0;

function nextImage() {
  currentIndex = (currentIndex + 1) % images.length;
  const image = document.getElementById("campusImage");
  const info = document.getElementById("infoBox");

  image.src = images[currentIndex].src;
  info.textContent = images[currentIndex].info;
  info.style.animation = "fadeIn 1s ease-in-out";
}

document.getElementById("feedbackForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const name = document.getElementById("name").value;
  const comments = document.getElementById("comments").value;

  document.getElementById("thankYouMessage").textContent = `Thank you, ${name}! Your feedback has been received.`;
  this.reset();
});

/*campus"*/
function toggleMenu() {
  document.querySelector('.nav-links').classList.toggle('active');
}