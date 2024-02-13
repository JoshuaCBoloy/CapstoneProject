/*=============== SERVICES MODAL ===============*/
const modals = document.querySelectorAll('.services__modal'),
    modalButtons = document.querySelectorAll('.services__button'),
    modalCloses = document.querySelectorAll('.services__modal-close');

let activeModal = (modalIndex) => {
    modals[modalIndex].style.opacity = '1';
    modals[modalIndex].style.visibility = 'visible';
};

let closeModal = (modalIndex) => {
    modals[modalIndex].style.opacity = '0';
    modals[modalIndex].style.visibility = 'hidden';
};

modalButtons.forEach((modalButton, i) => {
    modalButton.addEventListener('click', () => {
        activeModal(i);
    });
});

modalCloses.forEach((modalClose, i) => {
    modalClose.addEventListener('click', () => {
        closeModal(i);
    });
});

/*=============== SWIPER TESTIMONIAL ===============*/
const swiperTestimonial = new Swiper('.testimonial__swiper', {
    loop: true,
    spaceBetween: 32,
    grabCursor: true,
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
      clickable: true,
    },
  })



/*=============== SHOW SCROLL UP ===============*/ 
const scrollUp = () =>{
	const scrollUp = document.getElementById('scroll-up')
    // When the scroll is higher than 350 viewport height, add the show-scroll class to the a tag with the scrollup class
	this.scrollY >= 350 ? scrollUp.classList.add('show-scroll')
						: scrollUp.classList.remove('show-scroll')
}
window.addEventListener('scroll', scrollUp)