

$(document).ready(function(){

  // sections animation
  $('[section-target]').on('click', function(){
    var getTargetValue = $(this).attr('section-target');
    var parentSection = $(this).parents('.section');
    parentSection.addClass('fadeOut');
    $(parentSection).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
      //alert(getTargetValue);
      parentSection.removeClass('show fadeOut');
      $(getTargetValue).addClass('show fadeIn');
    });
  });

  // radio selection
  $('.select-budget-radio input').on('change', function(){
    var getType = $(this).attr('type');
    if(getType == 'radio'){
      $('.raqtan-custom-checkbox').removeClass('budget-selected');
      $(this).parents('.raqtan-custom-checkbox').addClass('budget-selected');
    }else{
      if($(this). prop("checked") == true){
        $(this).parents('.raqtan-custom-checkbox').addClass('budget-selected');
      }else{
        $(this).parents('.raqtan-custom-checkbox').removeClass('budget-selected');
      }
    }	
  });

  // jquery UI counter spinner
  var spinner = $( ".spinner" ).spinner();
   
  $( "#getvalue" ).on( "click", function() {
    alert( spinner.spinner( "value" ) );
  });
  $( "#setvalue" ).on( "click", function() {
    spinner.spinner( "value", 5 );
  });

  $( "button" ).button();


});

