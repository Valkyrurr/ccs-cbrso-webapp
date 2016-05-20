/**
 * 
 */
$('#search').on('hidden.bs.collapse', function () {
    $(this).prev().find(".glyphicon.glyphicon-chevron-up").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
});

$('#search').on('shown.bs.collapse', function () {
    $(this).prev().find(".glyphicon.glyphicon-chevron-down").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");    
});

$('#register').on('hidden.bs.collapse', function () {
    $(this).prev().find(".glyphicon.glyphicon-chevron-up").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
});

$('#register').on('shown.bs.collapse', function () {
    $(this).prev().find(".glyphicon.glyphicon-chevron-down").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
});