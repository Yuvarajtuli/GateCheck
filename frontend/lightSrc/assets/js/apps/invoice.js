$('.search > input').on('keyup', function() {
  var rex = new RegExp($(this).val(), 'i');
    $('.nav .nav-item').hide();
    $('.nav .nav-item').filter(function() {
        return rex.test($(this).text());
    }).show();
});

$('[data-toggle="tooltip"]').tooltip({
  'template': '<div class="tooltip actions-btn-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
})

$('.action-print').on('click', function(event) {
  event.preventDefault();
  /* Act on the event */
  window.print();
});

const ps = new PerfectScrollbar('.inv-list-container', {
  suppressScrollX : true
});


const inv_container = new PerfectScrollbar('.invoice-inbox', {
  suppressScrollX : true
});

if (window.innerWidth >= 768) {
  const inv_container = new PerfectScrollbar('.invoice-inbox', {
    suppressScrollX : true
  });
} else if (window.innerWidth < 768) {
  inv_container.destroy();
}


$('.hamburger, .inv-not-selected p').on('click', function(event) {
  $('.doc-container').find('.tab-title').toggleClass('open-inv-sidebar')
})