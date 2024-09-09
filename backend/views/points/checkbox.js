/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

      $("#memberledger").click(function () {
        var keys = $('#griditems').yiiGridView('getSelectedRows');
        if(keys==''){
              alert('Please choose member(s)');
        }else{
          window.open('index.php?r=ac/all-member-details&m'+'='+keys);
        }  
    });
//    
//// for Others
//      $('button.search').hide();
//      $('button.search').click(function(){
//         $('#search-show').toggle();
//      });
});
