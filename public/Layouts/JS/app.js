$(document).ready(function(){
    $('#SearchBar').hide();
});
$('#SearchButton').on('click', function(){
    $('#AllContent').hide();
    $('#SearchBar').show();
});
$('#SearchBack').on('click', function(){
    $('#SearchBar').hide();
    $('#AllContent').show();
});