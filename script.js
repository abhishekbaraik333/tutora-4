
document.querySelector('.hamburger').addEventListener('click', function() {
    document.querySelector('.navbar-links').classList.toggle('active');
  });
  document.querySelectorAll('.faq-question h2').forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        const icon = question.querySelector('.fa-chevron-down');
        answer.classList.toggle('active');
        if (answer.classList.contains('active')) {
            answer.style.maxHeight = answer.scrollHeight + 'px';
            icon.style.transform = 'rotate(180deg)';
        } else {
            answer.style.maxHeight = '0';
            icon.style.transform = 'rotate(0deg)';
        }
    });
});




