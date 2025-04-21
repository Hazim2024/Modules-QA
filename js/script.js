// 1) Hamburger menu (vanilla JS)
document.addEventListener("DOMContentLoaded", () => {
  const nav = document.querySelector(".navigation"),
        burger = document.querySelector(".hamburger");

  burger.addEventListener("click", () => {
    nav.classList.toggle("nav--open");
    burger.classList.toggle("hamburger--open");
  });
  nav.querySelectorAll(".nav_link").forEach(link =>
    link.addEventListener("click", () => {
      nav.classList.remove("nav--open");
      burger.classList.remove("hamburger--open");
    })
  );
});

// 2) Filters, live search & voting (jQuery)
$(function(){
  const $grid    = $('#questions-grid'),
        $search  = $('#search-input'),
        $filters = $('.filter-link');
  let searchTerm   = '',
      typingTimer;

  // --- Live Search (in-DOM) ---
  $search.on('keyup', function(){
    const term = this.value.toLowerCase();
    $('.question-column').each(function(){
      const txt = $(this).find('.question-title, .question-text')
                         .text().toLowerCase();
      $(this).toggle(txt.indexOf(term) > -1);
    });
  });

  // --- Vote toggle via AJAX ---
  $grid.on('click', '.vote-button', function(){
    const $btn = $(this),
          qid  = $btn.data('id');

    $btn.prop('disabled', true);

    $.post('app/api/vote_question.php', { id: qid }, resp => {
      if (resp.success) {
        $btn.text('▲ ' + resp.votes)
            .toggleClass('voted', resp.voted);
      } else {
        alert(resp.error || 'Something went wrong.');
      }
    }, 'json')
    .always(() => $btn.prop('disabled', false));
  });

  // --- Filter Pills (page reload) ---
  $filters.on('click', function(e){
    e.preventDefault();
    const f = $(this).data('filter');
    window.location.search = '?filter=' + f;
  });
});
