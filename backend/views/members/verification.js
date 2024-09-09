/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

$(document).ready(function(){
    $('#print-div').click(function(){ 
     var municipal_id =  $('#municipal_id').val();
     //console.log(municipal_id);
     
     $('#btn_submit').click(function(){
        var typed_pin = $('#typed_pin').val();
        if(municipal_id == typed_pin){
            
            printDiv();
        }else{
            alert("Please Enter Valid PIN No.");
        }
       
     });
    });
});
$(document).ready(function(){
    $('#test_print').click(function(){ 
     var pinfromdb =  $('#municipal_id').val();
     
     $('#btn_submit').click(function(){
        var enterpin = $('#typed_pin').val();
        if(pinfromdb == enterpin){
            
            printDiv();
        }else{
            alert("Please Enter Valid PIN No.");
        }
       
     });
    });
});
