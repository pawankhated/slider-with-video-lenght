jQuery(document).ready(function($) {

    const carousel = jQuery("#videos-full-slider");
    let currentItem=0  
    addClassBox();
    checkClasses();
    initOwlCarousel();

    carousel.on('translated.owl.carousel', function(event) {
      checkClasses();
      addClassBox();                
  });

    function checkClasses(){
        var total = jQuery('#videos-full-slider .owl-stage .owl-item.active').length;
        jQuery('#videos-full-slider .owl-stage .owl-item').removeClass('firstActiveItem lastActiveItem');

        jQuery('#videos-full-slider .owl-stage .owl-item.active').each(function(index){
            if (index === 0) {
                // this is the first one
                jQuery(this).addClass('firstActiveItem');
                jQuery(this).addClass('currnetSlideAnimation');
            }

            if (index === total - 1 && total>1) {
                // this is the last one
                jQuery(this).addClass('lastActiveItem');
            }

            if (jQuery(this).next().hasClass('video')) {
                      jQuery(this).find(".video video").play();


                  }

        });
    }




  let countItems=jQuery('#videos-full-slider .owl-item').length;
   jQuery('video').on('ended',function(){
        console.log('Video has ended!');       
        addClassBox();  
        currentItem=currentItem+1;
        this.currentTime = 0;
        this.pause();   
        goToNextCarouselPage(currentItem,countItems);   
    });

});

function addClassBox(){
  setTimeout(function(){ 
                  jQuery(".owl-item").removeClass('currnetSlideAnimation');
              }, 1000);
     
}


function goToNextCarouselPage(current,total) {  
      
           jQuery('.fadeInUp').attr('style','');
           if(total==current){
            jQuery(this).addClass('firstActiveItem');
            let video = document.getElementsByTagName("video");
            currentItem=0;
            for(let i=0;i<video.length;i++){
                // set video time to start from 0 
                video[i].currentTime=0;  
            }
            

            jQuery('#videos-full-slider').trigger('destroy.owl.carousel'); //these 3 lines kill the owl, and returns the markup to the initial state
            jQuery('#videos-full-slider').find('.owl-stage-outer').children().unwrap();
            jQuery('#videos-full-slider').removeClass("owl-center owl-loaded owl-text-select-on");
            initOwlCarousel();
            video[0].play();

            }else{              
              jQuery('.fadeInUp').attr('style','');
              carousel.trigger('next.owl.carousel');  
               if (jQuery('.owl-item.active').find('video').length !== 0) {
                    // play video in active slide
                    jQuery('.owl-item.active .item video').get(0).play();
                }
              
            }
            
            
            jQuery(".fadeInUp").css("animation","fadeInUp 6s ease backwards");
      
       
            
  
  }


  function initOwlCarousel(){
        jQuery("#videos-full-slider").owlCarousel({
        loop : false,
        items : 3,
        nav : false,
        dots : false,
        autoplay: false,
        autoplayTimeout:6000, 
        slideSpeed: 6000,
        autoPlay: 5500,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        touchDrag  : false,
        mouseDrag  : false,
        afterMove: function(el) { 
          jQuery('owl-item').removeClass('overlay');
          jQuery('.owl-item.active').eq(1).addClass('overlay');
      },
        responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
      }
    });

  }

