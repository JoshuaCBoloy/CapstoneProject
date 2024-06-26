let menu = document.querySelector("#menu-icon");
let navbar = document.querySelector(".navbar");

menu.onclick = () => {
  menu.classList.toggle("bx-x");
  navbar.classList.toggle("open");
};

window.onscroll = () => {
  navbar.classList.remove("active");
};

document.querySelector(".home").onmousemove = (e) => {
  let x = (window.innerWidth - e.pageX * 2) / 90;
  let y = (window.innerHeight - e.pageX * 2) / 90;

  document.querySelector(
    ".home .home-parallax-img"
  ).style.transform = `translateX(${y}px) translateY(${x}px)`;
};

document.querySelector(".home").onmouseleave = () => {
  document.querySelector(
    ".home .home-parallax-img"
  ).style.transform = `translateX(0px) translateY(0px)`;
};

// Select all elements with the "stars" class and store them in a NodeList called "starContainers"
const starContainers = document.querySelectorAll(".stars");

// Loop through the "starContainers" NodeList
starContainers.forEach((container) => {
  // Select stars within the current container
  const stars = container.querySelectorAll("i");

  // Loop through the stars NodeList
  stars.forEach((star, index1) => {
    // Add an event listener that runs a function when the "click" event is triggered
    star.addEventListener("click", () => {
      // Toggle the "active" class on the clicked star
      star.classList.toggle("active");

      // Loop through the stars NodeList again
      stars.forEach((star, index2) => {
        // Add the "active" class to the clicked star and any stars with a lower index
        if (index1 >= index2) {
          star.classList.add("active");
        } else {
          // Remove the "active" class from stars with a higher index
          star.classList.remove("active");
        }
      });
    });
  });
});
