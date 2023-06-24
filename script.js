$(document).ready(function() {
    // Animação HTML
    $('.html .progress-bar-h').animate({ width: '100%' }, 2000, function() {
      $(this).siblings('.progress-text-h').text('100%');
    });

    // Animação CSS
    $('.css .progress-bar').animate({ width: '80%' }, 2000, function() {
      $(this).siblings('.progress-text').text('80%');
    });

    // Animação JavaScript
    $('.js .progress-bar').animate({ width: '90%' }, 2000, function() {
      $(this).siblings('.progress-text').text('90%');
    });
  });

  const progress = document.querySelector('.progress-done');

setTimeout(() => {
  progress.style.width = progress.getAttribute('data-done') + '%';
  progress.style.opacity = 1;
}, 100);
