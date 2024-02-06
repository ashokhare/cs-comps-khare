const carouselImages = document.getElementsByClassName("carousel-images");
const previousButton = document.getElementById("previous-button");
const nextButton = document.getElementById("next-button");
let currentImageIndex = 0;

function cycleOnce(direction) {
	(carouselImages[currentImageIndex]).style.display = "none";

	if (direction === -1) {
		currentImageIndex = (2 - currentImageIndex - 1) % 2;
	} else {
		currentImageIndex = (currentImageIndex + 1) % 2;
	}

	(carouselImages[currentImageIndex]).style.display = "block";
}

function cycleRepeat(direction) {
	cycleOnce(direction);
	setTimeout(() => cycleRepeat(1), 5000);	
}

previousButton.addEventListener("click", () => cycleOnce(-1));
nextButton.addEventListener("click", () => cycleOnce(1));

cycleRepeat(1);	
