/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
//    $("#sms").click(function () {
//       
//        var keys = $('#griditems').yiiGridView('getSelectedRows');
//        var length=keys.length;
//       
//        if(length>1){
//            alert('select only one  member');
//        }else if (keys==''){
//      
//              alert('Please choose member(s)');
//            
//        }else{
//          window.open('index.php?r=liance/member/member-pdf&id'+'='+keys);
//        }
//       
//      
//       
//        
//    });
      $("#Email").click(function () {
        var keys = $('#griditems').yiiGridView('getSelectedRows');
        if(keys==''){
              alert('Please choose member(s)');
        }else{
          window.open('index.php?r=email/create&id'+'='+keys);
        }  
    });
//    for Address Print 
$("#addressprint").click(function(){
    var keys = $('#griditems').yiiGridView('getSelectedRows');
        if (keys == '') {
            alert('Please choose member(s) ');
        }else{
             window.open('index.php?r=members/address-print&id'+'='+keys);
        }
});
//    for sms 
$("#sms").click(function(){
    var keys = $('#griditems').yiiGridView('getSelectedRows');
        if (keys == '') {
            alert('Please choose member(s) ');
        }else{
             window.open('index.php?r=sms/create&id'+'='+keys);
        }
});
//// for Others
//      $('button.search').hide();
//      $('button.search').click(function(){
//         $('#search-show').toggle();
//      });
});
