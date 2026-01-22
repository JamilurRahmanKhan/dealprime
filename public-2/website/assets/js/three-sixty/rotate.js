// rotate = function(images){
//   $(function(){
//     $.each(images, function(i,v){
//       $('.rotatebox .images').append('<img src="' + v + '" data-nth="' + i + '" />');
//     });
//     $('.rotatebox .images img').css('z-index', '1');
//     $('.rotatebox .images img').first().css('z-index', '2');
//     $('.rotatebox .slider').slider({
//       min: 0,
//       max: (images.length * 2) - 1,
//       value: 0,
//       slide: function(evt, ui){
//         target = ui.value % images.length;
//         $('.rotatebox .images img').css('z-index', '1');
//         $('.rotatebox .images img[data-nth=' + target + ']').css('z-index', '2');
//       },
//     });
//   });
// };
//
// $(function(){
//     var pic_X=$('.rotate-list').offset().left;
//     var pic_Y=$('.rotate-list').offset().top;
//     var pic_W=$('.rotate-list').width()/10;
//     var pic_H=$('.rotate-list').height()/2;
//     var center_X=pic_X+pic_W;
//     var center_Y=pic_Y+pic_H;
//     // var movestop=pic_W/25;
//     var movestop=pic_W/$('.rotate-list li').length;

//     if (/Windows/i.test(navigator.userAgent)) {
//         $('.rotate-list').mousemove(function(event){
//             var mouse_X=event.pageX;

//             // $('.rotate-list').removeClass('.zoomContainer');
//             // $('.rotate-list').removeClass('.zoomWindow');
//             $('.zoomContainer').remove()
//             $('.zoomWindow').remove()
//             // console.log('Event:', event);
//             var mouse_Y=event.pageY;

//             if(mouse_X-center_X<=0){
//                 moveImg(mouse_X,mouse_Y,'left')
//             }else{
//                 moveImg(mouse_X,mouse_Y)
//             }
//         });
//     } else{
//         if (/Android/i.test(navigator.userAgent)) {
//             $('.rotate-list').on('touchmove', function(event) {

//                 // console.log('Event:', event.originalEvent.changedTouches[0]);
//                 // console.log('Touches:', event.touches);
//                 // console.log('ChangedTouches:', event.changedTouches);

//                 var touch=event.originalEvent.changedTouches[0];

//                 const mouse_X = touch.pageX;
//                 const mouse_Y = touch.pageY;
//                 if(mouse_X-center_X <= 0){
//                     moveImg(mouse_X,mouse_Y,'left')
//                 }else{
//                     moveImg(mouse_X,mouse_Y)
//                 }
//             });

//         }
//         if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
//             $('.rotate-list').on('touchmove', function(event) {
//                 // console.log('Event:', event.originalEvent.changedTouches[0]);
//                 console.log('Touches:', event.touches);
//                 // console.log('ChangedTouches:', event.changedTouches);

//                 // var touch=event.originalEvent.changedTouches[0];
//                 var touch= event.touches[0] || event.changedTouches[0];


//                 const mouse_X = touch.pageX;
//                 const mouse_Y = touch.pageY;
//                 if(mouse_X-center_X <= 0){
//                     moveImg(mouse_X,mouse_Y,'left')
//                 }else{
//                     moveImg(mouse_X,mouse_Y)
//                 }
//             });
//         }
//     }

//     function moveImg(m_X,m_Y,dir){
//         var index=Math.ceil(Math.abs(m_X-center_X)/movestop);
//         if(dir){
//             $('.rotate-list li').eq(index).show().siblings().hide();
//         }else{
//             $('.rotate-list li').eq(18-index).show().siblings().hide();
//         }
//     }
// })
