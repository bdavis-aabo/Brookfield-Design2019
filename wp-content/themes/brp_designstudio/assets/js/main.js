$(document).ready(function(){
  //menu Functions
  $('.nav-btn').click(function(){
    $('.nav-btn').toggleClass('open');
    $('.sidebar-header').toggleClass('expanded');
    $('.legend').toggleClass('hidden');
  });

  $('.expand-portfolios').click(function(){
    $('.portfolio-container').toggleClass('closed');
  });
});
