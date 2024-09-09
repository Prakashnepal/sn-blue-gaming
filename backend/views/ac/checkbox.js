

$(document).ready(function () {

    $("#memberledger").click(function () {
        var keys = $('#griditems').yiiGridView('getSelectedRows');
        if (keys == '') {
            alert('Please choose member(s)');
        } else {
            window.open('index.php?r=ac/all-member-details&m' + '=' + keys);
        }
    });
//    $("#counterReport").click(function () {
//        var keys = $('#griditems').yiiGridView('getSelectedRows');
//        var counter = $('#clickedCounter').val()
//        if (keys == '') {
//            alert('Please choose member(s)');
//        } else {
//            window.open('index.php?r=ac/counter-report&id' + '=' + keys + '&c='+counter);
//        }
//    });
//    
//// for Others
//      $('button.search').hide();
//      $('button.search').click(function(){
//         $('#search-show').toggle();
//      });
});
